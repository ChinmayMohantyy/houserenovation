<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function loginPage(){
        return view('admin.auth.login');
    }

    public function login(Request $request){
        $request->validate([
            'email' => 'required|email|exists:admins,email',
            'password' => 'required'
        ]);
        if(Auth::guard('admin')->attempt(['email'=>$request->email,'password'=>$request->password,'status'=>1])){
            return redirect()->intended('admin')->with('success','Welcome');
        }else{
            return back()->with('failure','Your login attempt failed. Try again later');
        }
    }

    public function logout(){
        Auth::guard('admin')->logout();
        return redirect('/admin/login')->with('success','Logout successfull.');
    }
}
