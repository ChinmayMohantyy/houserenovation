<?php

namespace App\Http\Controllers\Warehouse\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\WarehouseManager;

class LoginController extends Controller
{
    public function loginPage(){
        return view('warehouse.auth.login');
    }

    public function login(Request $request){
        $request->validate([
            'email' => 'required|email|exists:warehouse_managers,email',
            'password' => 'required'
        ]);
        $user_check = WarehouseManager::where('email',$request->email)->first();
        if ($user_check->admin_approved == '1') {
            $credentials = $request->only('email', 'password');
            if (Auth::guard('warehousemanager')->attempt($credentials)) {
            $this->redirectTo = '/warehouse';
            }
           
        }else{
            return redirect()->back()->with('message', 'You dont have permission to login'); 
        }
        if(Auth::guard('warehousemanager')->attempt(['email'=>$request->email,'password'=>$request->password,'status'=>1])){
            return redirect()->intended('warehouse')->with('success','Welcome');
        }else{
            return back()->with('failure','Your login attempt failed. Try again later');
        }
    }

    public function logout(){
        Auth::guard('warehousemanager')->logout();
        return redirect('/warehouse/login')->with('success','Logout successfull.');
    }
}
