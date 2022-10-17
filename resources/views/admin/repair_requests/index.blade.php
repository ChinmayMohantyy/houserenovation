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
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($repair_requests as $i => $rr)
                    <tr>
                        <td>{{++$i}}</td>
                        <td>{{@$rr->name}}</td>
                        <td>{{@$rr->email}}</td> 
                        <td>{{@$rr->primary_phone}}</td>
                        <td>{{@$rr->street}},{{@$rr->city_details->name}},{{@$rr->state_details->name}},{{@$rr->zipcode}}</td>
                       <td>
                        {{-- @if($rr->user_status == "rejected")
                        <a href="#">NotView</a>&nbsp;||&nbsp;
                            @else --}}
                            @if($rr->user_status == "rejected")
                            <p style="color: red">Rejected</p>
                            @else
                            <a href="{{url('/admin/house-repair-request-view',$rr->id)}}">View</a>
                            @endif
                            <p>
                                @if($rr->user_accept_id == "")
                                @else
                                {{$rr->user_status}} by <span style="color: brown">{{@$rr->accept_admin->name}}</span>
                                @endif
                                </p>
                            @if($rr->user_accept_id == "")
                                
                            @endif
                       </td>
                            {{-- @endif
                            @if($rr->user_status == "accepted")
                            <a href="#" style="color:green">Approved</a>
                            @elseif($rr->user_status == "pending"||
                            $rr->user_status == "rejected")
                            <a href="{{url('/admin/house-repair-request-accept',$rr->id)}}" style="color:green">Approve</a>@endif&nbsp;
                            ||&nbsp;
                            @if($rr->user_status == "rejected")
                            <a href="#" style="color: red">Disapproved</a>
                             @elseif($rr->user_status == "pending"||
                            $rr->user_status == "accepted")<a href="{{url('/admin/house-repair-request-reject',$rr->id)}}" style="color: red">Disapprove</a>@endif
                            ||<a href="{{url('/admin/house-repair-request-edit',$rr->id)}}" style="color: rgb(83, 20, 255)">Edit</a></td> --}}
                       <td><span style="color:deepskyblue">Process Start</span>
                        -{{$rr->house_captain_approved_at}}<br>
                        <span style="color:deepskyblue">Process End</span> - 
                        @if($rr->house_captain_approved_at == '' && $rr->completed_date == '')
                        @else
                        @if($rr->house_captain_approved_at !== '' && $rr->completed_date == '')
                        <p><span style="color:darkorange">Work in Progress</span>
                            </p>
                        @else
                        {{$rr->completed_date}}
                        @endif
                        @endif
                        </td>
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