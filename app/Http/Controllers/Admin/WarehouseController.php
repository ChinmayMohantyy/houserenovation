<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Warehouse;
use App\Models\City;
use App\Models\State;
use App\Models\WarehouseManager;
use Illuminate\Support\Facades\Gate;
use Throwable;

class WarehouseController extends Controller
{
    public function index(){
        $warehouse = Warehouse::orderBy('id','DESC');
        if(Auth()->guard('admin')->user()->can('warehouse_global') || Auth()->guard('admin')->user()->hasrole(Auth()->guard('admin')->user()->id.'_admin')){ //View Global Permission
            $warehouse->get();
        } else { //View Own Permission
            $warehouse->where('creator_id', Auth()->guard('admin')->user()->id);
        }
        $warehouses = $warehouse->get();
        return view('admin.warehouse.index',compact('warehouses'));
    }
    public function create(){
        $warehousemanagers= WarehouseManager::orderBy('name','ASC')->get();
        $states = State::orderBy('name','ASC')->get();
        $cities = City::orderBy('name','ASC')->get();
        return view('admin.warehouse.create',compact('warehousemanagers','states','cities'));
    }
    public function save(Request $request){
        $request->validate([
            'name' => 'required',
            'details' => 'max:200',
            'street' => 'max:100',
            'city' => 'required|max:100',
            'state' => 'required|numeric',
            'zipcode' => 'required|numeric',
            'warehouse_manager_id' => 'required|numeric'
        ]);
        try{
            $warehouse = new Warehouse();
            $warehouse->creator_id = auth()->guard('admin')->user()->id;
            $warehouse->name = $request->name;
            $warehouse->details = $request->details;
            $warehouse->street = $request->street;
            $warehouse->city = $request->city;
            $warehouse->state = $request->state;
            $warehouse->zipcode = $request->zipcode;
            $warehouse->warehouse_manager_id = $request->warehouse_manager_id;
            $warehouse->admin_id = auth()->guard('admin')->user()->parent_id;

            $warehouse->save();
            return redirect('/admin/warehouse-create')->with('success','Warehouse created successfully.');   
        }catch(Throwable $e){
            return back()->with('failure','Warehouse not created.');
        }
    }
    public function edit($id){
        $warehouse = Warehouse::find($id);
        $states = State::orderBy('name','ASC')->get();
        $cities = City::orderBy('name','ASC')->get();
        $warehousemanagers= Warehousemanager::orderBy('name','ASC')->get();
        return view('admin.warehouse.edit',compact('warehouse','warehousemanagers','states','cities'));
    }
    public function update(Request $request){
        $request->validate([
            'id' => 'required',
            'name' => 'required',
            'details' => 'max:200',
            'street' => 'max:100',
            'city' => 'required|max:100',
            'state' => 'required|numeric',
            'zipcode' => 'required|numeric',
            'warehouse_manager_id' => 'required|numeric'
        ]);

        try{
            $warehouse = Warehouse::find($request->id);
            $warehouse->name = $request->name;
            $warehouse->details = $request->details;
            $warehouse->street = $request->street;
            $warehouse->city = $request->city;
            $warehouse->state = $request->state;
            $warehouse->zipcode = $request->zipcode;
            $warehouse->warehouse_manager_id = $request->warehouse_manager_id;
            $warehouse->admin_id = auth()->guard('admin')->user()->id;
            $warehouse->save();

            return redirect(url('/admin/warehouse-edit',$request->id))->with('success','Warehouse updated successfully.');
        }catch(Throwable $e){
            return back()->with('failure','Warehouse not updated.');
        }
    }
}
