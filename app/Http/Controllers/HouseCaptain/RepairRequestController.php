<?php

namespace App\Http\Controllers\Housecaptain;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\HouseRepairRequest;
use App\Models\InventoryOrder;
use Illuminate\Support\Facades\Auth;
class RepairRequestController extends Controller
{
    public function index(){
        // echo(Auth::guard('housecaptain')->user()->id);
        $repair_requests = HouseRepairRequest::with(['state_details','city_details','house_captains','rejectHousecaptain'=> function($q){
                                                return $q->where('rejected_housecaptain_id', Auth::guard('housecaptain')->user()->id); 
          },])
                ->where('verified_at','<>',null)
                ->where('house_captain_id',null)
                ->where('housecaptain_inspection_id', '=', Auth::guard('housecaptain')->user()->id)
                ->orWhere('housecaptain_inspection_id', null)
                ->orderBy('id','DESC')->get();
            //  dd($repair_requests);

        return view('housecaptain.repair_request.index',compact('repair_requests'));
    }

    public function view($id){
        $repair_request = HouseRepairRequest::with(['state_details','city_details','field_assistant','house_captain'])
                    ->where('verified_at','<>',null)
                    ->where('house_captain_id',null)
                    ->find($id);
        // return $repair_request;
        $allimage_housecaptain = HouseRepairRequest::get();
        // dd($allimage_housecaptain);
        $inventory_orders = InventoryOrder::where('house_captain_id',$id)->get();
        return view('housecaptain.repair_request.view',compact('repair_request','inventory_orders','allimage_housecaptain'));
    }

     public function viewhouserepairrequest()
    {
     return view('housecaptain.repair_request.request_index');
   }

    public function viewData($id){
        $repair_request = HouseRepairRequest::with(['state_details','city_details','field_assistant','house_captain'])
        ->where('verified_at','<>',null)
        ->where('house_captain_id',null)
        ->find($id);
    // return $repair_request;
    // dd($repair_request);
        $inventory_orders = InventoryOrder::where('house_captain_id',$id)->get();
        return view('housecaptain.repair_request.view-data',compact('repair_request','inventory_orders'));
    }

    public function viewacceptdata()
    {
        // $repair_requests = HouseRepairRequest::with(['state_details','city_details','house_captains','rejectHousecaptain'=> function($q){
        //     return $q->where('rejected_housecaptain_id', Auth::guard('housecaptain')->user()->id); 
        //     },])
        //     ->where('verified_at','<>',null)
        //     ->where('house_captain_id',null)
        //     ->where('housecaptain_inspection_id', '=', Auth::guard('housecaptain')->user()->id)
        //     ->orWhere('housecaptain_inspection_id', null)
        //     ->orderBy('id','DESC')->get();
        $repair_requests = HouseRepairRequest::where('house_captain_approved_by',Auth::guard('housecaptain')->user()->id)->get();
     return view('housecaptain.repair_request.view_accept_data',compact('repair_requests'));
   }
}
