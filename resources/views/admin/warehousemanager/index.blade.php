@extends('admin.layouts.app')

@section('content')
<div class="content">



    <!-- Basic table -->
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">Warehouse Managers</h5>
            <div class="heading-elements">

                @if(auth()->guard('admin')->user()->hasAnyPermission(['warehouse-manager_create']) || auth()->guard('admin')->user()->hasRole(auth()->guard('admin')->user()->id.'_admin'))
                    <li>
                        <a href="{{url('/admin/warehouse-manager-create')}}" class="btn btn-primary btn-raised">Create</a>
                    </li>
                @endif

            </div>
        </div>


        <div class="panel-body">

        </div>
        @if(count($warehousemanagers) > 0)
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
                       <th>Admin Approval</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($warehousemanagers as $i => $wm)
                    <tr>
                        <td>{{++$i}}</td>
                        <td>{{@$wm->name}}</td>
                        <td>{{@$wm->email}}</td>
                        <td>{{@$wm->mobile}}</td>
                        <td> 
                             {{-- @if ($wm->admin_approved == '1')
                            <a href="{{url('/admin/warehousenotapproved',$wm->id)}}"
                                class="btn btn-danger">Notapproved</a>
                        @else
                            <a href="{{url('/admin/warehouseapproved',$wm->id)}}" class="btn btn-success"
                                onclick="return confirm ('Approved ')">Approved</a>
                        @endif</td> --}}
                        @if ($wm->admin_approved == '0')
                        <a href="{{url('/admin/warehouseapproved',$wm->id)}}" class="btn btn-success"
                            onclick="return confirm ('Approved ')">Approved</a>
                            @else
                            <a href="#" class="btn btn-success">Already Approved</a>
                            @endif
                            @if ($wm->admin_approved == '1')
                                <a href="{{url('/admin/warehousenotapproved',$wm->id)}}"
                                    class="btn btn-danger">Not approve</a>
                            @else
                            <a href="#"
                                class="btn btn-danger">Not approve</a>
                            @endif
                        <!-- <td><a href="{{url('/admin/warehouse-manager-edit',$wm->id)}}">Edit</a></td> -->
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="text-center mb-4">No Data Available.</div>
        @endif
    </div>
    <!-- /basic table -->
</div>
@endsection