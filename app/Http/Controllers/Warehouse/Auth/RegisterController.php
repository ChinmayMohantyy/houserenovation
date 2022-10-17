<?php

namespace App\Http\Controllers\Warehouse\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\WarehouseManager;
use App\Models\Organization;

class RegisterController extends Controller
{
    public function Register(){
        $organization_data = Organization::get();
        return view('warehouse.auth.register',compact('organization_data'));
    }

    public function saveRegister(Request $request){
        // dd($request->all());
        // $request->validate([
        //     'name' => 'required',
        //     'avatar' => '',
        //     'email' => 'required|email|unique:warehouse_managers,email',
        //     'mobile' => 'required|max:15|unique:warehouse_managers,mobile',
        //     // 'password' => 'required|confirmed',
        // ]);
        $register_save_data = new WarehouseManager();
        $register_save_data->name = $request->name;
        $register_save_data->email = $request->email;
        $register_save_data->password = bcrypt($request->password);
        $register_save_data->mobile = $request->mobile;
        $register_save->organization = $request->organization;
        $register_save_data->save();
        return redirect(url('warehouse\login'));
    }
}
