@extends('admin.layouts.app')

@section('content')
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Roles</span></h4>
        <a class="heading-elements-toggle"><i class="icon-more"></i></a></div>
    </div>

    <div class="content">
        <div class="panel panel-flat">
                    @if(session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

            <div class="panel-heading">
                <form action="/admin/roles/add" method="POST" class="form-horizontal">
                    @method('POST')
                    @csrf
                    <div class="tab-content">
                        <div id="basic-tab1" class="tab-pane active">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label><span style="color: red;">*</span> Role Name</label>
                                        <input type="text" name="name" required="required" class="form-control">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="text-right">
                                <button type="submit" class="btn btn-primary">SAVE<i class="icon-arrow-right14 position-right"></i></button>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="heading-elements"></div>
            </div>
            <div>
                <table class="table datatable-responsive-column-controlled">
                    <thead>
                        <tr>
                            <th>Role Name</th>
                            <th>Permission</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                                @foreach ($roles as $role)
                            <tr>
                                <td>{{@$role->name}}</td>
                                <td><a href="/admin/role/{{@$role->id}}/assign-permission"><i class="fa fa-user-plus"></i> Manage Permissions</a></td>
                                <td><a href="/admin/roles/{{@$role->id}}/delete" style="color: red"><i class="fa fa-trash"></i> Delete </a></td>
                            </tr>  
                        @endforeach
                       
                    </tbody>
                </table>
                <div class="row">
                    <div class="col-md-12 text-right">
                        <!---->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
