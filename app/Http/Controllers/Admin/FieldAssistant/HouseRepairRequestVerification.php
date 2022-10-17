<?php

namespace App\Http\Controllers\Admin\FieldAssistant;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\HouseRepairRequest;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Carbon\Carbon;


class HouseRepairRequestVerification extends Controller
{
    public function __construct(){
        // if (! Gate::allows('field-assistant-access')) {
        //     abort(403);
        // }
    }
    public function index(){
        $repair_requests = HouseRepairRequest::with(['state_details','city_details'])
        ->where('user_accept_id', '=', Auth::guard('admin')->user()->id)
        ->orWhere('user_accept_id', null)
        ->orderBy('id','DESC')->get();
        // $repair_requests = HouseRepairRequest::with(['state_details','city_details'])->where(['field_assistant_id'=>Auth::guard('admin')->user()->id])->orderBy('id','DESC')->get();
        return view('field_assistant.verification.index',compact('repair_requests'));
    }

    public function view($id){
        $repair_request = HouseRepairRequest::with(['state_details','city_details','field_assistant','house_captain'])->find($id);
        // dd($repair_request);
        return view('field_assistant.verification.view',compact('repair_request'));
    }

    public function uploadDocument(Request $request){

        // dd($request->all());
        // $validator = Validator::make($request->all(),[
        //     // 'id' => 'required',
        //     'files' => 'required|file',
        // ]);
        // if($validator->fails()){
        //     return response()->json(['status'=>false,'validation_errors'=>$validator->errors()]);
        // }
        try{
            
            // $file = $request->file('file');
            // $file_name = strtolower(rand(1000,9999).time().'.'.$file->getClientOriginalExtension());
            // $file->move(public_path('/verification_documents'),$file_name);
            // $repair_request->verification_document = $file_name;
                $repair_request = HouseRepairRequest::find($request->id);
                $repair_request->verification_data = $request->verification_data;
                $fileNames = [];
                foreach ($request->file('files') as $imagefile) {
                    // dd($imagefile);
                    $file = $imagefile;
                    $fileName = time() . rand(100, 999) . "." . $file->getClientOriginalExtension();
                    $imageurl = url('/verification_documents', time() . "." . $file->getClientOriginalExtension());
                    $file->move('./verification_documents/', $fileName);
                    array_push($fileNames,$fileName);
                }
                $repair_request->verification_document = implode(',',$fileNames);
                $repair_request->verified_at = Carbon::now();
                $repair_request->verified_by = auth()->guard('admin')->user()->id;
                $repair_request->status = "verified";
                $repair_request->save();
            return response()->json(['status'=>true,'message'=>'Verification document uploaded successfully.']);
        }catch(Exception $e){
            return response()->json(['status'=>false,'message'=>'Verification document not updated, try again '.$e->getMessage()]);
        }
    }
}
