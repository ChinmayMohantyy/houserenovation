@extends('admin.layouts.app')

@section('content')
<div class="content">



    <!-- Basic table -->
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">Warehouse</h5>
            <div class="heading-elements">
                @if(auth()->guard('admin')->user()->hasAnyPermission(['warehouse_create']) || auth()->guard('admin')->user()->hasRole(auth()->guard('admin')->user()->id.'_admin'))
                    <li>
                        <a href="{{url('/admin/warehouse-create')}}" class="btn btn-primary btn-raised">Create</a>
                    </li>
                @endif
            </div>
        </div>


        <div class="panel-body">

        </div>
        @if(count($warehouses) > 0)
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Details</th>
                        <th>Sreete</th>
                        <th>City</th>
                        <th>State</th>
                        <th>Zipcode</th>
                        <th>warehouse_manager_id</th>

                        @if(auth()->guard('admin')->user()->hasAnyPermission(['warehouse_update']) || auth()->guard('admin')->user()->hasRole(auth()->guard('admin')->user()->id.'_admin'))
                            <th>Action</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach($warehouses as $i => $wh)
                    <tr>
                        <td>{{++$i}}</td>
                        <td>{{@$wh->name}}</td>
                        <td>{{@$wh->details}}</td>
                        <td>{{@$wh->street}}</td>
                        <td>{{@$wh->city}}</td>
                        <td>{{@$wh->state}}</td>
                        <td>{{@$wh->zipcode}}</td>
                        <td>{{@$wh->warehouse_manager_id}}</td>

                        @if(auth()->guard('admin')->user()->hasAnyPermission(['warehouse_update']) || auth()->guard('admin')->user()->hasRole(auth()->guard('admin')->user()->id.'_admin'))
                            <td><a href="{{url('/admin/warehouse-edit',$wh->id)}}">Edit</a></td>
                        @endif

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