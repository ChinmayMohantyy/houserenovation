@extends('admin.layouts.app')

@section('content')
<div class="content">
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">Organization<a class="heading-elements-toggle"></a></h5>
            <div class="heading-elements">
                @if(auth()->guard('admin')->user()->hasAnyPermission(['organization_create']) || auth()->guard('admin')->user()->hasRole(auth()->guard('admin')->user()->id.'_admin'))
                    <a href="{{url('admin/organization-create')}}" class="btn btn-primary btn-raised legitRipple">CREATE</a>
                @endif
            </div>
        </div>

        <div class="panel-body">


            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Details</th>
                            @if(auth()->guard('admin')->user()->hasAnyPermission(['organization_update']) || auth()->guard('admin')->user()->hasRole(auth()->guard('admin')->user()->id.'_admin'))
                                <th>Action</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            @foreach($organization_data as $organizationData)
                        <tr>
                            <td>{{$organizationData->name}}</td>
                            <td>{{$organizationData->details}}</td>
                            @if(auth()->guard('admin')->user()->hasAnyPermission(['organization_update']) || auth()->guard('admin')->user()->hasRole(auth()->guard('admin')->user()->id.'_admin'))
                                <td><a href="{{url('/admin/organization-edit', $organizationData->id)}}"><i class="icon-pencil"></i>Edit</a></td>
                            @endif
                        </tr>
                        @endforeach
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>




    @endsection