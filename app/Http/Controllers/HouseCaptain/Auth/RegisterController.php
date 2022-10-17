<?php

namespace App\Http\Controllers\Housecaptain\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\HouseCaptain;
use App\Models\City;
use App\Models\State;
use App\Models\Organization;


class RegisterController extends Controller
{
    public function Register(){
        $organization_data = Organization::get();
        return view('housecaptain.auth.register',compact('organization_data'));
    }

    public function saveRegister(Request $request){
        // dd($request->all());
        // $request->validate([
        //     'name' => 'required',
        //     'avatar' => '',
        //     'email' => 'required|email|unique:house_captains,email',
        //     'mobile' => 'required|max:15|unique:house_captains,mobile',
        //     'password' => 'required|confirmed',
        //     'street' => '',
        //     'city' => 'required',
        //     'state' => 'required',
        //     'zipcode' => 'required',
        // ]);
        $register_save = new HouseCaptain();
        $register_save->name = $request->name;
        $register_save->email = $request->email;
        $register_save->password = bcrypt($request->password);
        $register_save->mobile = $request->mobile;
        $register_save->organization = $request->organization;
        $register_save->save();
        return redirect(url('housecaptain\login'));
    }
}
