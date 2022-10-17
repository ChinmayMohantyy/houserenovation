<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Organization;

class HomeController extends Controller
{
    public function index(){
        return view('admin.dashboard.index');
    }

    public function organizationIndex(){
        $organization = Organization::orderBy('id','DESC');
        if(Auth()->guard('admin')->user()->can('organization_global') || Auth()->guard('admin')->user()->hasrole(Auth()->guard('admin')->user()->id.'_admin')){ //View Global Permission
            $organization->get();
        } else { //View Own Permission
            $organization->where('creator_id', Auth()->guard('admin')->user()->id);
        }
        $organization_data = $organization->get();
        return view('admin.organization.index',compact('organization_data'));
    }

    public function organizationCreate(){
        return view('admin.organization.create');
    }

    public function organizationSave(Request $request)
    {
        $organization_save = new Organization();
        $organization_save->admin_id = auth()->guard('admin')->user()->parent_id;
        $organization_save->creator_id = auth()->guard('admin')->user()->id;
        $organization_save->name = $request->name;
        $organization_save->details = $request->details;
        $organization_save->save();
        return back()->with('success','Successfully Created !');
    }

    public function organizationEdit($id){
        $organization_edit = Organization::find($id);
        return view('admin.organization.edit',compact('organization_edit'));
    }

    public function organizationUpdate(Request $request,$id)
    {
        $organization_save = Organization::find($id);
        $organization_save->name = $request->name;
        $organization_save->details = $request->details;
        $organization_save->save();
        return back()->with('success','Successfully Updated !');
    }
}
