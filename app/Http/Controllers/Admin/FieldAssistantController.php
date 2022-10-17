<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Throwable;
use Auth;
use App\Helpers\Helper;

use Spatie\Permission\Models\Role;

class FieldAssistantController extends Controller
{
    public function index(){
        
        $fieldassitants = Admin::orderBy('id','DESC')->where('role','field_assistant')->get();
        return view('admin.fieldassistant.index',compact('fieldassitants'));
    }

    public function create(){
        $admin_id = Helper::getAdminId();

        $roles = Role::where('admin_id',$admin_id)->where('name', 'NOT LIKE', '%'.'admin'.'%')->get();

        return view('admin.fieldassistant.create',compact('roles'));
    }

    public function save(Request $request){
        $request->validate([
            'name' => 'required',
            'avatar' => '',
            'email' => 'required|email|unique:admins,email',
            'mobile' => 'required|max:15|unique:admins,mobile',
        ]);

        try{
            $fa = new Admin();
            $fa->name = $request->name;
            $fa->email = $request->email;
            $fa->mobile = $request->mobile;
            $fa->password = bcrypt('12345678');
            $fa->role = 'field_assistant';
            $fa->assignRole($request->role_id);
            $fa->parent_id = Auth::guard('admin')->user()->id;
            $fa->save();

            if($request->file('avatar')){
                $avatar = $request->file('avatar');
                $avatar_name = strtolower(Str::slug($fa->name, '_').'.'.$avatar->getClientOriginalExtension());
                $avatar->move(public_path('/images/field_assistant/avatars'),$avatar_name);
                $fa->avatar = $avatar_name;
                $fa->save();
            }
            return redirect(url('/admin/field-assistant-create'))->with('success','New Field assistant created successfully.');   
        }catch(Throwable $e){
            return back()->with('failure','Field assistant not created.');
        }
    }

    public function edit($id){
        return view('admin.field_assistant.edit');
    }

    public function update(Request $request){
        $request->validate([
            'id' => 'required',
            'name' => 'required',
            'avatar' => '',
            'email' => 'required|email|unique:admins,email',
            'mobile' => 'required|max:15|unique:admins,mobile',
        ]);

        try{
            $fa = Admin::find();
            $fa->name = $request->name;
            $fa->email = $request->email;
            $fa->mobile = $request->mobile;
            $fa->password = bcrypt('12345678');
            $fa->role = 'field_assistant';
            $fa->syncRoles([$request->role_id]);
            $fa->save();

            if($request->file('avatar')){
                $avatar = $request->file('avatar');
                $avatar_name = strtolower(Str::slug($fa->name, '_').'.'.$avatar->getClientOriginalExtension());
                $avatar->move(public_path('/images/field_assistant/avatars'),$avatar_name);
                $fa->avatar = $avatar_name;
                $fa->save();
            }
            return redirect('/house-captain-create')->with('success','New Field assistant created successfully.');   
        }catch(Throwable $e){
            return back()->with('failure','Field assistant not created.');
        }
    }
}
