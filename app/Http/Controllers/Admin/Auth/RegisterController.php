<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Spatie\Permission\Models\Role;
use App\Helpers\Helper;
use Validator;

class RegisterController extends Controller
{

    public function showRegistrationForm()
    {
        return view('admin.auth.register');
    }

    public function register(Request $request){
      
        $admin = new Admin();
        $admin->name = $request->name;
        $admin->email   = $request->email;
        $admin->password  = bcrypt($request->password);
        $admin->status = 1;
        $admin->slug  = 'admin';
        $admin->save();

        if($admin->save()){
            $role = new Role;
            $role->admin_id = $admin->id;
            $role->name = $admin->id . '_admin';
            $role->guard_name='admin';
            $role->save();
            $admin->assignRole($role->id);
            $admin->save();
        }
            return redirect('/admin');

    }

}
