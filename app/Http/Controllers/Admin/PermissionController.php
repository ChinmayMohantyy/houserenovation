<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\AdminPermissionGroup;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Model\Customer;
use App\Http\Controllers\Controller;
use App\Helpers\Helper;

class PermissionController extends Controller
{

    public function getCleanSlug($string, $delimiter = '-'){
        // Remove special characters
        $string = preg_replace("/[~`{}.'\"\!\@\#\$\%\^\&\*\(\)\_\=\+\/\?\>\<\,\[\]\:\;\|\\\]/", "", $string);
        // Replace blank space with delimeter
        $string = preg_replace("/[\/_|+ -]+/", $delimiter, $string);
        // Remove the last -, if there is one
        if (substr($string, -1) === '-') {
            $string = substr($string, 0, -1); // Remove last char
        }
        return mb_strtolower($string);
        
    }
    
    public function permissionGroupIndex()
    {
        $permissiongroups = AdminPermissionGroup::get();
        return view('admin.role_permission.permissions-groups.index',compact('permissiongroups'));
    }

    public function permissionGroupCreate()
    {
        return view('admin.role_permission.permissions-groups.create');
    }

    public function permissionGroupStore(Request $request)
    {
        $slug= $this->getCleanSlug($request->name);
        $permissiongroup = new AdminPermissionGroup;
        $permissiongroup->name = strtolower($request->name);
        $permissiongroup->slug = $slug;
        $permissiongroup->save();
            
        if($permissiongroup->save()){
        $permission = new Permission;
        $permission->permission_group_id = $permissiongroup->id;
        $permission->name =$slug."_own";
        $permission->slug = "View Own";
        $permission->guard_name = 'admin';
        $permission->save();

        $permission = new Permission;
        $permission->permission_group_id = $permissiongroup->id;
        $permission->name = $slug."_global";
        $permission->slug = "View Global";
        $permission->guard_name = 'admin';
        $permission->save();
            
        $permission = new Permission;
        $permission->permission_group_id = $permissiongroup->id;
        $permission->name = $slug."_create";
        $permission->slug = "Create";
        $permission->guard_name = 'admin';
        $permission->save();

        $permission = new Permission;
        $permission->permission_group_id = $permissiongroup->id;
        $permission->name = $slug."_update";
        $permission->slug = "Update";
        $permission->guard_name = 'admin';
        $permission->save();

        $permission = new Permission;
        $permission->permission_group_id = $permissiongroup->id;
        $permission->name = $slug."_delete";
        $permission->slug = "Delete";
        $permission->guard_name = 'admin';
        $permission->save();
        
        }
        return redirect('/admin/permissions-groups');
    }

    public function permissionGroupEdit($permissiongroup_id)
    {
        $permissiongroup = AdminPermissionGroup::find($permissiongroup_id);
        return view('admin.role_permission.permissions-groups.edit',compact('permissiongroup'));
    }

    public function permissionGroupUpdate(Request $request,$permissiongroup_id)
    {
        $permissiongroup = AdminPermissionGroup::find($permissiongroup_id);
        $permissiongroup->name = strtolower($request->name);

        $permissiongroup->save();
        return redirect('/admin/permissions-groups');
    }

    public function assignPermission($role_id)
    {
        $role =Role::find($role_id);
        $permissions = AdminPermissionGroup::with('permission')->get();
        return view('admin.role_permission.assign-permission',compact('role','permissions'));
    }

    public function assignPermissionStore(Request $request,$role_id)
    {
        $role = Role::find($role_id);
        $role->syncPermissions($request->permission);
        return redirect('/admin/roles');
    }

    public function deletePermission($permissiongroup_id)
    {
        $permissiongroup= AdminPermissionGroup::find($permissiongroup_id);
        $permission = Permission::where('permission_group_id',$permissiongroup_id)->get();
        $permission->each->delete();
        $permissiongroup->delete();
        return redirect('/admin/permissions-groups');
    }
    

}