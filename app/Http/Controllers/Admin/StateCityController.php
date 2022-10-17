<?php

namespace App\Http\Controllers\Admin;
use App\Models\State;
use App\Models\City;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class StateCityController extends Controller
{
    #====== State =================
    public function statePage(){
        $state = State::orderBy('id','DESC');
        if(Auth()->guard('admin')->user()->can('state_global') || Auth()->guard('admin')->user()->hasrole(Auth()->guard('admin')->user()->id.'_admin')){ //View Global Permission
            $state->get();
        } else { //View Own Permission
            $state->where('creator_id', Auth()->guard('admin')->user()->id);
        }
        $states = $state->get();
        return view('admin.state.index',compact('states'));
    
    }
    public function createStatePage(){
     return view('admin.state.create');
        
    }
    public function saveState(Request $request){
        // dd($request->all());
       
        $state= new State;
        $state->admin_id = Auth::guard('admin')->user()->id;
        $state->country_id =  "101";
        $state->name =  $request->state;
        $state->status =  '1';
        $state->save();
        return back();
    
    }

    public function editStatePage($id){
       
     $state = State::find($id);
     return view('admin.state.editstate',compact('state'));
    }

    public function updateState(Request $request){
        $state = State::find($request->id);
        $state->name= $request->name;
        $state->save();
        return redirect(url('/admin/states'))->with('success','Successfully Created !');
        
    }

    #====== City =================

    public function cityPage(){
        $city = City::orderBy('id','DESC');
        if(Auth()->guard('admin')->user()->can('city_global') || Auth()->guard('admin')->user()->hasrole(Auth()->guard('admin')->user()->id.'_admin')){ //View Global Permission
            $city->get();
        } else { //View Own Permission
            $city->where('creator_id', Auth()->guard('admin')->user()->id);
        }
        $cities = $city->get();
        return view('admin.city.index_city',compact('cities'));
        
    }
    public function createCityPage(){
         $states= State::orderBy('name','ASC')->get();
        return view('admin.city.create_city',compact('states'));

    }
    public function saveCity(Request $request){
      
        $city= new City;
        $city->admin_id = Auth::guard('admin')->user()->id;
        $city->name =  $request->city;
        $city->state_id =  $request->state;
        $city->status =  '1';
        $city->save();
        return back();

    }
    public function editCityPage($id){
        $city = City::find($id);
        $states= State::orderBy('name','ASC')->get();
       return view('admin.city.edit',compact('city','states'));


    }

    public function updateCity(Request $request,$id){
        $city = City::find($id);
        $city->state_id=$request->state_id;
        $city->name= $request->name;
        $city->save();
        return redirect('/admin/cities')->with('success','city updated successfully.');
        return back()->with('failure','city not updated.');

    }

}