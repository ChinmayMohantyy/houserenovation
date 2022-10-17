<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\Helper;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    public function roleIndex()
    {
        $admin_id = Helper::getAdminId();
        $roles = Role::where('admin_id',$admin_id)->where('name', 'NOT LIKE', '%'.'admin'.'%')->get();

        return view('admin.role_permission.role_index',compact('roles'));
    }

    public function roleStore(Request $request)
    {
       
        $admin_id = Helper::getAdminId();
        if(strtolower($request->name) == 'admin'){
            return redirect()->back()->with('message', 'You can not create admin role');           
        }else{
            $role = new Role;
            $role->name = strtolower($request->name);
            $role->guard_name = 'admin';
            $role->admin_id = Auth::guard('admin')->user()->id;
            $role->save();
        }
        return back();
    }

    public function roleDelete($role_id)
    {
        $role = Role::find($role_id);
        $role->delete();
        return back();

    }
}
