<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\WarehouseManager;
use Illuminate\Support\Facades\Gate;
use Throwable;
use App\Helpers\Helper;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Admin;
use App\Models\Organization;

class WarehouseManagerController extends Controller
{
    public function index(){
        $admin_id = Auth()->guard('admin')->user()->parent_id;
        $warehousemanager = WarehouseManager::orderBy('id','DESC');
        if(Auth()->guard('admin')->user()->can('warehouse-manager_global') || Auth()->guard('admin')->user()->hasrole(Auth()->guard('admin')->user()->id.'_admin')){ //View Global Permission
            $warehousemanager->get();
        } else { //View Own Permission
            $warehousemanager->where('creator_id', Auth()->guard('admin')->user()->id);
        }
        $warehousemanagers = $warehousemanager->get();
        return view('admin.warehousemanager.index',compact('warehousemanagers'));
    }
    public function create(){
        
        $organization_data = Organization::get();
        return view('admin.warehousemanager.create',compact('organization_data'));
    }
    public function save(Request $request){
        $request->validate([
            'name' => 'required',
            'avatar' => '',
            'email' => 'required|email|unique:warehouse_managers,email',
            'mobile' => 'required|max:15|unique:warehouse_managers,mobile',
            'password' => 'required|min:8|confirmed'
        ]);

        $admin_id = Auth()->guard('admin')->user()->parent_id;
        try{
            $warehousemanager = new WarehouseManager();
            $warehousemanager->admin_id = $admin_id;
            $warehousemanager->creator_id = Auth()->guard('admin')->user()->id;
            $warehousemanager->name = $request->name;
            $warehousemanager->email = $request->email;
            $warehousemanager->mobile = $request->mobile;
            $warehousemanager->password = bcrypt($request->password);
            $warehousemanager->organization = $request->organization;
            $warehousemanager->admin_approved = '1';
            $warehousemanager->save();
            return redirect('/admin/warehouse-manager-create')->with('success','Warehouse manager created successfully.');   
        }catch(Throwable $e){
            dd($e->getMessage());
            return back()->with('failure','Warehouse manager not created.');
        }
    }
    public function edit($id){
        $warehousemanager = WarehouseManager::find($id);
        return view('admin.warehousemanager.edit',compact('warehousemanager'));
    }
    public function update(Request $request,WarehouseManager $wm){
        $request->validate([
            'id' => 'required',
            'email' => ['required','email',Rule::unique('warehouse_managers','email')->ignore($request->id)],
            'mobile' => 'required|max:15|unique:warehouse_managers,mobile,'.$wm->id,
        ]);
        return "Ture";
        try{
            $warehousemanager = WarehouseManager::find($request->id);
            $warehousemanager->name = $request->name;
            $warehousemanager->email = $request->email;
            $warehousemanager->mobile = $request->mobile;
            $warehousemanager->admin_approved = '1';
            $warehousemanager->save();
            if($request->file('avatar')){
                $avatar = $request->file('avatar');
                $avatar_name = strtolower(Str::slug($warehousemanager->name, '_').'.'.$avatar->getClientOriginalExtension());
                $avatar->move(public_path('/images/warehousemanagers/avatars'),$avatar_name);
                $warehousemanager->avatar = $avatar_name;
                $warehousemanager->save();
            }
            return redirect(url('/admin/warehouse-manager-edit',$request->id))->with('success','Warehouse manager details updated successfully.');   
        }catch(Throwable $e){
            return back()->with('failure','Warehouse manager details not updated.');
        }
    }

    public function notapproved($id)
    {
        // return $id;
        $users = WarehouseManager::find($id);
        $users->admin_approved = '0';
        $users->save();
        return redirect(url('/admin/warehouse-managers'));
    }
    public function approved($id)
    {
        // dd($id);
        $users = WarehouseManager::find($id);
        $users->admin_approved = '1';
        $users->save();
        return redirect(url('/admin/warehouse-managers'));
    }
}
