<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Inventory;
use Illuminate\Support\Facades\Gate;
use Throwable;
use App\Imports\ImportInventory;  
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;

class InventoriesController extends Controller
{
    public function index(){
        $inventory=Inventory::orderBy('id','DESC'); 
        if(Auth()->guard('admin')->user()->can('inventory_global') || Auth()->guard('admin')->user()->hasrole(Auth()->guard('admin')->user()->id.'_admin')){ //View Global Permission
            $inventory->get();
        } else { //View Own Permission
            $inventory->where('creator_id', Auth()->guard('admin')->user()->id);
        }
        $inventories = $inventory->get(); 

        return view('admin.inventory.index',compact('inventories'));
    }
    public function create(){
        $inventories= inventory::orderBy('name','ASC')->get();
        return view('admin.inventory.create',compact('inventories'));
    }
    public function save(Request $request){
        // $request->validate([
        //     'name' => 'required',
        //     'details' => 'max:200',
        //     'inventory_type' => 'required|in:s,r',
        //     'available_quantity' => 'required|numeric',
        //     'unit_price' => 'required|numeric'
        // ],[
        //     'inventory_type.in' => 'Inventory type either Sellable or Rentable'
        // ]);

        $admin_id = Auth()->guard('admin')->user()->parent_id;
        try{
            $inventory = new Inventory();
            // dd($request->all());
            $inventory->admin_id = $admin_id;
            $inventory->creator_id = Auth()->guard('admin')->user()->id;
            $inventory->name = $request->name;
            $inventory->details = $request->details;
            $inventory->inventory_type = $request->inventory_type;
            $inventory->available_quantity = $request->available_quantity;
            $inventory->update_quantity = $request->available_quantity;
            $inventory->unit_price = $request->unit_price;
            $inventory->save();
            
            return redirect('/admin/inventory-create')->with('success','Inventory created successfully.');   
        }catch(Throwable $e){
            dd($e->getMessage());
            return back()->with('failure','Inventory not created.');
        }
    }
    public function edit($id){
        $inventory= Inventory::find($id);
        return view('admin.inventory.edit',compact('inventory'));
    }
    public function update(Request $request){
        // $request->validate([
        //     'id' => 'required',
        //     'name' => 'required',
        //     'details' => 'max:200',
        //     'inventory_type' => 'required|in:s,r',
        //     'available_quantity' => 'required|numeric',
        //     'unit_price' => 'required|numeric'
        // ],[
        //     'inventory_type.in' => 'Inventory type either Sellable or Rentable'
        // ]);

        try{
            $inventory = Inventory::find($request->id);
            $inventory->name = $request->name;
            $inventory->details = $request->details;
            $inventory->inventory_type = $request->inventory_type;
            $inventory->available_quantity = $request->available_quantity;
            $inventory->unit_price = $request->unit_price;
            $inventory->save();
            
            return redirect(url('/admin/inventory-edit',$request->id))->with('success','Inventory updated successfully.');   
        }catch(Throwable $e){
            return back()->with('failure','Inventory not updated.');
        }
    }

    // import export
    // public function importView()  
    // {  
    //    return view('superadmin.settings.vin.index');  
    // }  

    public function import(Request $request)   
    {         
        if( $request->file == ''){
            return back()->with('failure','Please Upload A File');
        } 
            $file=$request->file('file')->store('import');
            Excel::import(new ImportInventory, $file);
            return back()->withStatus('Excel file upload successfully');
         
    }  
    public function export(Request $request)   
    {  
        return Excel::download(new UsersExport, 'Inventory_Details.xlsx');  
    }  
}
