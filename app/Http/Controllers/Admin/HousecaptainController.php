<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\HouseCaptain;
use App\Models\HouseRepairRequest;
use App\Models\State;
use Illuminate\Support\Facades\Gate;
use Throwable;
use Illuminate\Support\Str;
use App\Models\Organization;
class HousecaptainController extends Controller
{
    public function index(){
        
        $housecaptain = HouseCaptain::with(['state_details','city_details']);
        if(Auth()->guard('admin')->user()->can('house-captain_global') || Auth()->guard('admin')->user()->hasrole(Auth()->guard('admin')->user()->id.'_admin')){ //View Global Permission
            $housecaptain->get();
        } else { //View Own Permission
            $housecaptain->where('creator_id', Auth()->guard('admin')->user()->id);
        }
        $housecaptains = $housecaptain->orderBy('id','DESC')->get();
        $housecaptionname = HouseRepairRequest::with('house_captains')->get();
        // dd($housecaptionname);
        return view('admin.housecaptain.index',compact('housecaptains','housecaptionname'));
    }
    public function create(){
        $organization_data = Organization::get();
        return view('admin.housecaptain.create',compact('organization_data'));
    }
    public function save(Request $request){
        // dd($request->all());
        // $request->validate([
        //     'name' => 'required',
        //     'avatar' => '',
        //     'email' => 'required|email|unique:house_captains,email',
        //     'mobile' => 'required|max:15|unique:house_captains,mobile',

        //     'street' => '',
        //     'city' => 'required',
        //     'state' => 'required',
        //     'zipcode' => 'required',
        // ]);
        $admin_id = Auth()->guard('admin')->user()->parent_id;
        //     'street' => '',
        //     'city' => 'required',
        //     'state' => 'required',
        //     'zipcode' => 'required',
        // ]);

        try{
            $housecaptain = new HouseCaptain();
            $housecaptain->admin_id = $admin_id;
            $housecaptain->creator_id = Auth()->guard('admin')->user()->id;
            $housecaptain->name = $request->name;
            $housecaptain->email = $request->email;
            $housecaptain->mobile = $request->mobile;
            $housecaptain->password = bcrypt('12345678');
            $housecaptain->organization = $request->organization;
            $housecaptain->admin_approved = '1';
            $housecaptain->save();
            return redirect(url('/admin/house-captain-create'))->with('success','House captain created successfully.');   
        }catch(Throwable $e){
            dd($e->getMessage());
            return back()->with('failure','House captain not created.');
        }
    }
    public function edit($id){
        return view('admin.housecaptain.edit');
    }
    public function update(Request $request){
        // $request->validate([
        //     'id' => 'required',
        //     'name' => 'required',
        //     'avatar' => '',
        //     'email' => 'required|email|unique:house_captains,email',
        //     'mobile' => 'required|max:15|unique:house_captains,mobile',
        //     'password' => 'required|min:8|confirmed',

        //     'street' => '',
        //     'city' => 'required',
        //     'state' => 'required',
        //     'zipcode' => 'required',
        // ]);

        try{
            $housecaptain = new HouseCaptain();
            $housecaptain->name = $request->name;
            $housecaptain->email = $request->email;
            $housecaptain->mobile = $request->mobile;
            $housecaptain->password = bcrypt('12345678');
            $housecaptain->organization = $request->organization;
            $housecaptain->admin_approved = '1';
            $housecaptain->save();
            return redirect('/house-captain-edit',$request->id)->with('success','House captain created successfully.');   
        }catch(Throwable $e){
            return back()->with('failure','House captain not created.');
        }
    }

    public function notapproved($id)
    {
        // return $id;
        $users = HouseCaptain::find($id);
        $users->admin_approved = '0';
        $users->save();
        return redirect(url('/admin/house-captains'));
    }
    public function approved($id)
    {
        // dd($id);
        $users = HouseCaptain::find($id);
        $users->admin_approved = '1';
        $users->save();
        return redirect(url('/admin/house-captains'));
    }
}
