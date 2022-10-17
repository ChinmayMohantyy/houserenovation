@extends('admin.layouts.app')

@section('content')
    <div class="content">



        <!-- Basic table -->
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h5 class="panel-title">House Captains</h5>
                <div class="heading-elements">

                    @if (auth()->guard('admin')->user()->hasAnyPermission(['house-captain_create']) ||
                        auth()->guard('admin')->user()->hasRole(
                                auth()->guard('admin')->user()->id . '_admin'))
                        <li>
                            {{-- <button class="btn btn-primary px-3" type="button" data-toggle="modal" data-target="#invite">
                                Reject</button> --}}
                                <a href="#" data-toggle="modal" data-target="#invite"><i class="icon-bell2"></i> </a>
                            <a href="{{ url('/admin/house-captain-create') }}" class="btn btn-primary btn-raised">Create</a>
                        </li>
                    @endif
                </div>
            </div>
            


            <div class="panel-body">

            </div>
            @if (count($housecaptains) > 0)
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>Organization</th>
                                <th>Approval Check</th>
                                <!-- <th>Action</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($housecaptains as $i => $hc)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ @$hc->name }}</td>
                                    <td>{{ @$hc->email }}</td>
                                    <td>{{ @$hc->mobile }}</td>
                                    <td>{{ @$hc->organization }}</td>
                                    <td>
                                        @if ($hc->admin_approved == '0')
                                            <a href="{{ url('/admin/adminapproved', $hc->id) }}" class="btn btn-success"
                                                onclick="return confirm ('Approved ')">Approved</a>
                                        @else
                                            <a href="#" class="btn btn-success">Already Approved</a>
                                        @endif
                                        @if ($hc->admin_approved == '1')
                                            <a href="{{ url('/admin/adminnotapproved', $hc->id) }}"
                                                class="btn btn-danger">Not approve</a>
                                        @else
                                            <a href="#" class="btn btn-danger">Not approve</a>
                                        @endif
                                    </td>
                                    {{-- <td><a href="{{url('/admin/warehouse-manager-edit',$wm->id)}}">Edit</a></td> --}}
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


    <div class="modal fade " tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true"
                id="invite">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content card">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Rejected</h5>
                            <button type="button" class="close text-primary" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true"></span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="invite-employee-form" action="" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <p>:-&nbsp;<span style="color: red">
                                            @foreach($housecaptionname as $housecaptionnam)
                                            {{ @$housecaptionnam->house_captains->name }}
                                            @endforeach
                                        </span> housecaptain reject <span style="color: red">{{ @$hc->name }} </span>response</p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
@endsection
