@extends('admin.layouts.app')

@section('content')
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Permissions Groups</span></h4>
        <a class="heading-elements-toggle"><i class="icon-more"></i></a></div>
    </div>
    <div class="content">
        <div class="panel panel-flat">
            <div class="panel-heading">
                    <a href="/admin/permissions-groups/add" class="btn btn-primary shadow-md mr-2">New Permission Group</a> 
                <div class="heading-elements"></div>
            </div>
            <table class="table datatable-responsive-column-controlled">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($permissiongroups as $permissiongroup)
                    <tr>
                        <td>{{@$permissiongroup->name}}</td>
                        <td>
                            <a href="/admin/permissions-groups/{{@$permissiongroup->id}}/edit"><i class="fa fa-edit"></i> Edit </a>

                            <a href="/admin/permissions-groups/{{@$permissiongroup->id}}/delete" style="color: red"
                            ><i class="fa fa-trash"></i> Delete</a
                            ></td>
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
@endsection
