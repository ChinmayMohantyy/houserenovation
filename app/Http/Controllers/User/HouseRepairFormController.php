<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\HouseRepairRequest;
use App\Models\State;
use Throwable;

class HouseRepairFormController extends Controller
{
    public function index(){
        $states = State::orderBy('name','ASC')->get();
        $cities = City::orderBy('name','ASC')->get();
        return view('user.house-repair-request-form',compact('states','cities'));
    }

    public function save(Request $request){
        // dd($request->all());
        try{
            $hrr = new HouseRepairRequest();
            $hrr->only_one_residence = $request->only_one_residence;
            $hrr->lack_the_finances_resources = $request->lack_the_finances_resources;
            $hrr->older_age = $request->older_age;
            $hrr->physical_disability = $request->physical_disability;
            $hrr->veteran = $request->veteran;
            $hrr->name = $request->name;
            $hrr->street = $request->street;
            $hrr->email = $request->email;
            $hrr->city = $request->city;
            $hrr->state = $request->state;
            $hrr->zipcode = $request->zipcode;
            $hrr->extended_zip = $request->extended_zip;
            $hrr->primary_phone = $request->primary_phone;
            $hrr->secondary_phone = $request->secondary_phone;
            $hrr->marital_status = $request->marital_status;
            $hrr->alternate_contact_name = $request->alternate_contact_name;
            $hrr->alternate_contact_phone = $request->alternate_contact_phone;
            $hrr->total_annual_household_income = $request->total_annual_household_income;
            $hrr->age_of_owner = $request->age_of_owner;
            $hrr->years_lived_in_this_home = $request->years_lived_in_this_home;
            $hrr->any_resident_disabled = $request->any_resident_disabled;
            $hrr->disabled_person_details = json_encode($request->disabled_person_details);
            $hrr->any_veteran_member = $request->any_veteran_member;
            // $hrr->residents_details = $request->residents_details;
   
             $hrr->house_information = json_encode($request->house_information);
            $hrr->received_cio_help = $request->received_cio_help;
            $hrr->received_cio_help_year = $request->received_cio_help_year;
            $hrr->basic_plumbing = json_encode($request->basic_plumbing);
            $hrr->heat_furnace = json_encode($request->heat_furnace);

            $hrr->basic_electrical = json_encode($request->basic_electrical);
            $hrr->doors_and_windows = json_encode($request->doors_and_windows);
            $hrr->painting = json_encode($request->painting);
            $hrr->wood_repair = json_encode($request->wood_repair);
            $hrr->roof_patching = json_encode($request->roof_patching);
            $hrr->gutters = json_encode($request->gutters);
            $hrr->insulation_weatherization = json_encode($request->insulation_weatherization);
            $hrr->wheelchair_ramp = json_encode($request->wheelchair_ramp);
            $hrr->concrete_patching = json_encode($request->concrete_patching);
            $hrr->other_repairs = json_encode($request->other_repairs);
            
            $hrr->tc_agreed = $request->tc_agreed;
            $hrr->save();
            return redirect(url('/Successfull'))->with('success','Thank you! Your house repair request submited, our team will contact you soon.');
        }catch(Throwable $e){
            dd($e->getMessage());
            return back()->with('failure','Your house repair request not submited, try again');
        }
    }

    public function successfull(){
        return view('user.successfull');
    }

    public function getstate()
    {
       $state= State::get();
       return (json_decode($state));
    }
    public function getCity(Request $request)
    {
        $city = City::where('state_id',$request->stateid)->get();
        return (json_decode($city));
    }

}
