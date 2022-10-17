<?php

namespace App\Http\Controllers\Housecaptain\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\HouseCaptain;


class LoginController extends Controller
{
    public function loginPage(){
        return view('housecaptain.auth.login');
    }

    public function login(Request $request){

        $request->validate([
            'email' => 'required|email|exists:house_captains,email',
            'password' => 'required'
        ]);
        $user_check = HouseCaptain::where('email',$request->email)->first();
        if ($user_check->admin_approved == '1') {
            $credentials = $request->only('email', 'password');
            if (Auth::guard('housecaptain')->attempt($credentials)) {
                return redirect(url('/housecaptain'));
            }
           
        }else{
            return redirect()->back()->with('message', 'You dont have permission to login'); 
        }


        if(Auth::guard('housecaptain')->attempt(['email'=>$request->email,'password'=>$request->password,'status'=>1])){
            return redirect()->intended('housecaptain')->with('success','Welcome');
        }else{
            return back()->with('failure','Your login attempt failed. Try again later');
        }

       
    }

    public function logout(){
        Auth::guard('housecaptain')->logout();
        return redirect('/housecaptain/login')->with('success','Logout successfull.');
    }
}
