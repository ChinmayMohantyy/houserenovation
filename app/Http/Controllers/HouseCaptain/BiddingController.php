<?php

namespace App\Http\Controllers\Housecaptain;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\HouseRepairRequest;
use App\Models\InventoryOrder;
use App\Models\RejectHousecaptain;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Throwable;

class BiddingController extends Controller
{
    public function index(){
        $my_works = HouseRepairRequest::with(['state_details','city_details'])->where(['housecaptain_id'=>Auth::guard('housecaptain')->user()->id])->orderBy('id','DESC')->get();
        return $my_works;
    }
    
    public function showInterest(Request $request,$id){
        try{
            // dd($request->all());
            $repair_request = HouseRepairRequest::find($id);
                    $fileNames = [];
                    foreach ($request->file('upload_image') as $imagefile) {
                        // dd($imagefile);
                        $file = $imagefile;
                        $fileName = time() . rand(100, 999) . "." . $file->getClientOriginalExtension();
                        $imageurl = url('./verification_documents/' . time() . "." . $file->getClientOriginalExtension());
                        $file->move('./verification_documents/', $fileName);
                        array_push($fileNames,$fileName);
                    }
                    $repair_request->housecaptain_image_verify = implode(',',$fileNames);
               
            $repair_request->housecaptain_feedback = $request->housecaptain_feedback;
            $repair_request->save();
            if($repair_request->save()){
                $notification = new Notification();
                $notification->recipient_id = Auth::guard('housecaptain')->user()->id;
                $notification->user_type = 'housecaptain';
                $notification->message = "Request Accepted";
                $notification->save();
            }
            return redirect(url('housecaptain/acceptnext',$repair_request->id))->with('success','Your interest for work submited for approval.');
        }catch(Throwable $e){
            dd($e->getMessage());
            return back()->with('failure','Your interest for work not submited. Try again');
        }
    }

    // public function showReject($id){
    //     try{
    //         $repair_request = HouseRepairRequest::find($id);
    //         $repair_request->rejected_house_captains = Auth::guard('housecaptain')->user()->id;
    //         $repair_request->save();
    //         return redirect(url('housecaptain/repair-requests'))->with('success','Your interest for work submited for approval.');
    //     }catch(Throwable $e){
    //         return back()->with('failure','Your interest for work not submited. Try again');
    //     }
    // }

    public function inspection($id){
        try{
            $repair_request = HouseRepairRequest::find($id);
            $repair_request->housecaptain_inspection_id = Auth::guard('housecaptain')->user()->id;
            $repair_request->save();
            if($repair_request->save()){
                $notification = new Notification();
                $notification->recipient_id = Auth::guard('housecaptain')->user()->id;
                $notification->user_type = 'housecaptain';
                $notification->message = "Go to Inspect";
                $notification->save();
            }
            return redirect(url('housecaptain/repair-request-data',$repair_request->id))->with('success','Inspection status success.');
        }catch(Throwable $e){
            return back()->with('failure','Your interest for work not submited. Try again');
        }
    }

    public function reject($id){
        $reject_request = HouseRepairRequest::find($id);
        return view('housecaptain.repair_request.reject_request',compact('reject_request'));
    }

    public function saveReject(Request $request,$id)
    {
        // dd($request->all());
        $save_reject = new RejectHousecaptain();
        $save_reject->request_id = $request->request_id;
        $save_reject->rejected_housecaptain_id = Auth::guard('housecaptain')->user()->id;
        $save_reject->reject_request_text = $request->reject_request;
        $save_reject->save();
        // dd($save_reject);
        if($save_reject->save()){
            $reject_data = HouseRepairRequest::find($request->request_id);
            $reject_data->housecaptain_inspection_id = NULL;
            $reject_data->save();
        }
        if($save_reject->save()){
            $notification = new Notification();
            $notification->recipient_id = Auth::guard('housecaptain')->user()->id;
            $notification->user_type = 'housecaptain';
            $notification->message = "rejected";
            $notification->save();
        }
        return redirect(url('/housecaptain/repair-requests'));
    }

    public function accept($id){
        $reject_request_data = HouseRepairRequest::with('inventory.inventory_item')->find($id);
        $reject_request_values = InventoryOrder::with('inventory_rent.inventory_data_rent','inventory_item.inventory')->where('house_repair_request_id',$reject_request_data->id)->where('house_captain_id',Auth::guard('housecaptain')->user()->id)->get();
        $reject_request_values_data = InventoryOrder::with('inventory_rent.inventory_data_rent','inventory_item.inventory')->where('house_repair_request_id',$reject_request_data->id)->where('house_captain_id',Auth::guard('housecaptain')->user()->id)->first();

        return view('housecaptain.repair_request.acceptOrder',compact('reject_request_data','reject_request_values','reject_request_values_data'));
    }

    public function acceptnext($id){
        $reject_request_data = HouseRepairRequest::find($id);
        return view('housecaptain.repair_request.acceptnextpage',compact('reject_request_data'));
    }

    public function saveNext(Request $request,$id){
        $savenext = HouseRepairRequest::find($id);
        $savenext->house_captain_id = Auth::guard('housecaptain')->user()->id;
        $savenext->house_captain_approved_at = Carbon::now()->format('d-m-Y');
        $savenext->house_captain_approved_by = Auth::guard('housecaptain')->user()->id;
        $savenext->status = "work_in_progress";
        $savenext->save();
        return redirect(url('housecaptain/accept',$savenext->id))->with('success','Your interest for work submited for approval.');

    }

    public function completed($id)
    {
        $complete_data = HouseRepairRequest::find($id);
        $complete_data->completed_date =  Carbon::now()->format('d-m-Y');
        $complete_data->save();
        return back();
    }
}
