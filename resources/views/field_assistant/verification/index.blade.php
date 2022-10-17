@extends('admin.layouts.app')

@section('content')
<div class="content">



    <!-- Basic table -->
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">House Repair Requests</h5>
            <div class="heading-elements">
            </div>
        </div>


        <div class="panel-body">

        </div>
        @if(count($repair_requests) > 0)
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Address</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($repair_requests as $i => $rr)
                    {{-- @if($rr-> == Auth::guard('admin')->user()->id)
                    @else --}}
                    <tr>
                        <td>{{++$i}}</td>
                        <td>{{@$rr->name}}</td>
                        <td>{{@$rr->email}}</td>
                        <td>{{@$rr->primary_phone}}</td>
                        <td>{{@$rr->street}},{{@$rr->city_details->name}},{{@$rr->state_details->name}},{{@$rr->zipcode}}</td>
                       <td>
                        @if($rr->user_status == "rejected")
                        @else
                            <a href="{{url('/admin/field-assistant/verification-request',$rr->id)}}">View</a>
                        @endif
                            @if($rr->admin_accept_id == "")
                               
                            @else
                            <p>{{$rr->user_status}} by admin</p>
                            @endif

                        </td>
                    </tr>
                    {{-- @endif --}}
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