<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\HouseRepairRequest;
use App\Models\InventoryOrder;
use App\Models\InventoryOrderRentableItem;
use App\Models\Warehouse;
use App\Models\Inventory;
use Carbon\Carbon;
use App\Models\City;
use App\Models\State;
use App\Exports\BarcodesExport;
use Exception;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Helpers\Helper;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Facades\PDF;

class HouseRepairRequestController extends Controller
{
    public function index(){
        $repair_requests = HouseRepairRequest::with(['state_details','city_details','accept_admin'])->orderBy('id','DESC')->get();
        return view('admin.repair_requests.index',compact('repair_requests'));
    }

    public function view($id){
        $field_assistants = Admin::where(['role'=>'field_assistant','status'=>1])->orderBy('name','DESC')->get();
        $repair_request = HouseRepairRequest::with(['state_details','city_details','field_assistant','house_captain'])->find($id);
        // dd($repair_request);
        $inventories_list_order = InventoryOrder::with('inventory_item.inventory','warehouse_data','inventory_rent.inventory_data_rent')->where('house_repair_request_id',$id)->get();
        // return $inventories_list_order;
        $warehouse_list = Warehouse::get();
        $generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
        return view('admin.repair_requests.view',compact('repair_request','field_assistants','inventories_list_order','warehouse_list','generator'));
    }

    public function saveCustomData(Request $request){
        // $validator = Validator::make($request->all(),[
        //     'field_list.*.name' => 'required',
        //     'field_list.*.value' => 'required'
        // ]);
        // if($validator->fails()){
        //     return response()->json(['status'=>false,'validation_errors'=>$validator->errors()]);
        // }
        $field_list = [];
        foreach($request->field_list as $fl){
            if($fl['name'] != '' && $fl['value'] != ''){
                array_push($field_list,[
                    'name' => $fl['name'],
                    'value' => $fl['value']
                ]);
            }
        }
        // dd(json_encode($field_list));
        // return response()->json(['status'=>true,'data'=>$request->field_list]);
        try{
            $repair_request = HouseRepairRequest::find($request->id);
            $custom_field = json_decode($repair_request->custom_field);
            if($custom_field){
                $custom_field = array_merge($custom_field,$field_list);
            }else{
                $custom_field = $field_list;
            }
            
            // dd($custom_field);
            $repair_request->custom_field = json_encode($custom_field);
            $repair_request->save();
            return response()->json(['status'=>true,'message'=>'Data saved successfully.']);
        }catch(Exception $e){
            return response()->json(['status'=>false,'message'=>'Data not saved, try again','error'=>$e->getMessage()]);
        }
    }

    public function assignFieldAssistant(Request $request){
        $validator = Validator::make($request->all(),[
            'id' => 'required|numeric',
            'field_assistant_id' => 'required|numeric'
        ],[
            'field_assistant_id.*' => 'Field Assistant required'
        ]);
        if($validator->fails()){
            return response()->json(['status'=>false,'validation_errors'=>$validator->errors()]);
        }
        try{
            $repair_request = HouseRepairRequest::find($request->id);
            $repair_request->field_assistant_id = $request->field_assistant_id;
            $repair_request->status = "verifying";
            $repair_request->save();
            return response()->json(['status'=>true,'message'=>'Field assistant added to repair request for verification.']);
        }catch(Exception $e){
            return response()->json(['status'=>false,'message'=>'Field assistant assignment failed.']);
        }
    }

    // public function verify(Request $request){
    //     try{
    //         $repair_request = HouseRepairRequest::find($request->id);
    //         $repair_request->verified_at = Carbon::now();
    //         $repair_request->verified_by = auth()->guard('admin')->user()->id;
    //         $repair_request->status = "verified";
    //         $repair_request->save();
    //         return response()->json(['status'=>true,'message'=>'Document verified successfully.']);
    //     }catch(Exception $e){
    //         return response()->json(['status'=>false,'message'=>'Document verification failed.']);
    //     }
    // }

    // public function acceptInterestedHouseCaptain(Request $request){
    //     try{
    //         $repair_request = HouseRepairRequest::find($request->id);
    //         $repair_request->house_captain_approved_at = Carbon::now();
    //         $repair_request->house_captain_approved_by = auth()->guard('admin')->user()->id;
    //         $repair_request->status = "work_in_progress";
    //         $repair_request->save();
    //         return response()->json(['status'=>true,'message'=>'Interested House captain accepted successfully.']);
    //     }catch(Exception $e){
    //         return response()->json(['status'=>false,'message'=>'Interested House captain not accepted, Try again.']);
    //     }
    // }

    public function rejectInterestedHouseCaptain(Request $request){
        try{
            $repair_request = HouseRepairRequest::find($request->id);

            $rejected_ids = explode(',',$repair_request->rejected_house_captains);
            array_push($rejected_ids,$repair_request->house_captain_id);
            $repair_request->rejected_house_captains = implode(',',$rejected_ids);

            $repair_request->house_captain_id = null;
            $repair_request->save();
            return response()->json(['status'=>true,'message'=>'Interested House captain rejected successfully.']);
        }catch(Exception $e){
            return response()->json(['status'=>false,'message'=>'Interested House captain not rejected, Try again']);
        }
    }

    
    public function addWarehouse(Request $request,$id)
    {
        $ware_house_add = InventoryOrder::find($id);
        $ware_house_add->warehouse_id = $request->warehouse_id;
        $ware_house_add->save();
        return response()->json(['status'=>"success"]);
    }

    public function return(Request $request){
        $search_text  =$request->data;
        $invenory_rentables = InventoryOrderRentableItem::with('inventory_data_rent')->where('barcode_number','LIKE','%'.$search_text.'%')->where('is_returned','n')->get();
        return view('admin.repair_requests.returnproduct',compact('invenory_rentables','search_text'));
    }
     public function returninventory($id)
     {
        $return_inventory = InventoryOrderRentableItem::find($id);
        $return_inventory->is_returned ='y';
        $return_inventory->save();
        if($return_inventory->save()){
                $update_inventory = Inventory::find($return_inventory->inventory_id);
                $update_inventory->update_quantity = $update_inventory->update_quantity + $return_inventory->required_quantity;
                $update_inventory->save();
        }
        return redirect(url('admin/inventories'));
     }

     public function acceptUser($id)
     {
        $accept_user = HouseRepairRequest::find($id);
        $accept_user->user_status = "accepted";
        $accept_user->field_assistant_id = Auth::guard('admin')->user()->id;
        $accept_user->user_accept_id = Auth::guard('admin')->user()->id;
        $accept_user->save();
        // mail
        if($accept_user->save()){
        $house_data = HouseRepairRequest::find($id);
        // return ($house_data->email);
        $subject = 'Admin Status';
        $data = [
                'user' => $house_data->user_status,
                'name' =>$house_data->name,
        ];
        //dd($data['user']);
        $template = "userStatusaccept";
        $to_email = $house_data->email;
        $to_name = $house_data->name;
        // return $to_name;
        try {
            // return $to_email;
        Helper::sendMailBySendgrid($template, $data, $subject, $to_email, $to_name);

                // dd(111);
                return back();
            } catch (\Exception $e) {
                dd($e->getMessage());
                return false;
            }
        }
        return back();
     }

     public function rejectUser($id)
     {
        $reject_user = HouseRepairRequest::find($id);
        $reject_user->user_status = "rejected";
        $reject_user->user_accept_id = Auth::guard('admin')->user()->id;
        $reject_user->save();
        if($reject_user->save()){
            $house_data = HouseRepairRequest::find($id);
            // return ($house_data->email);
            $subject = 'Admin Status';
            $data = [
                    'user' => $house_data->user_status,
                    'name' =>$house_data->name,
            ];
            //dd($data['user']);
            $template = "userStatus";
            $to_email = $house_data->email;
            $to_name = $house_data->name;
            // return $to_name;
            try {
                // return $to_email;
            Helper::sendMailBySendgrid($template, $data, $subject, $to_email, $to_name);
    
                    // dd(111);
                    return back();
                } catch (\Exception $e) {
                    dd($e->getMessage());
                    return false;
                }
            }
            return back();
     }


    //  edit user
    public function edituser($id)
    {
        $states = State::orderBy('name','ASC')->get();
        $cities = City::orderBy('name','ASC')->get();
        $edituser = HouseRepairRequest::find($id);
        return view('admin.repair_requests.edituser',compact('states','cities','edituser'));
    }

    // admin accept
    public function acceptUserbyadmin($id)
    {
       $accept_user_admin = HouseRepairRequest::find($id);
       $accept_user_admin->user_status = "accepted";
       $accept_user_admin->admin_accept_id = Auth::guard('admin')->user()->id;
       $accept_user_admin->save();
       // mail
       if($accept_user_admin->save()){
       $house_data = HouseRepairRequest::find($id);
       // return ($house_data->email);
       $subject = 'Admin Status';
       $data = [
               'user' => $house_data->user_status,
               'name' =>$house_data->name,
       ];
       //dd($data['user']);
       $template = "userStatusaccept";
       $to_email = $house_data->email;
       $to_name = $house_data->name;
       // return $to_name;
       try {
           // return $to_email;
       Helper::sendMailBySendgrid($template, $data, $subject, $to_email, $to_name);

               // dd(111);
               return back();
           } catch (\Exception $e) {
               dd($e->getMessage());
               return false;
           }
       }
       return back();
    }

    public function rejectUserbyadmin($id)
    {
       $reject_user_admin = HouseRepairRequest::find($id);
       $reject_user_admin->user_status = "rejected";
       $reject_user_admin->admin_accept_id = Auth::guard('admin')->user()->id;
       $reject_user_admin->save();
       if($reject_user_admin->save()){
           $house_data = HouseRepairRequest::find($id);
           // return ($house_data->email);
           $subject = 'Admin Status';
           $data = [
                   'user' => $house_data->user_status,
                   'name' =>$house_data->name,
           ];
           //dd($data['user']);
           $template = "userStatus";
           $to_email = $house_data->email;
           $to_name = $house_data->name;
           // return $to_name;
           try {
               // return $to_email;
           Helper::sendMailBySendgrid($template, $data, $subject, $to_email, $to_name);
   
                   // dd(111);
                   return back();
               } catch (\Exception $e) {
                   dd($e->getMessage());
                   return false;
               }
           }
           return back();
    }

    public function exportBarcode(Request $request)   
    {  
        return Excel::download(new BarcodesExport, 'Barcode.xlsx');  
    }  

    public function generatePDF()
    {
        $data = ['title' => 'Welcome to HDTuto.com'];
        $pdf = PDF::loadView('myPDF', $data);
  
        return $pdf->download('Barcode.pdf');
    }
}
