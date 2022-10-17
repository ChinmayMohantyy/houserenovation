@extends('admin.layouts.app')

@section('content')
<div class="content">



    <!-- Basic table -->
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">Field Assistant</h5>
            <div class="heading-elements">

                <li><a href="{{url('/admin/field-assistant-create')}}" class="btn btn-primary btn-raised">Create</a>
                </li>
            </div>
        </div>


        <div class="panel-body">

        </div>
        @if(count($fieldassitants) > 0)
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <!-- <th>Action</th> -->
                    </tr>
                </thead>
                <tbody>
                    @foreach($fieldassitants as $i => $fa)
                    <tr>
                        <td>{{++$i}}</td>
                        <td>{{@$fa->name}}</td>
                        <td>{{@$fa->email}}</td>
                        <td>{{@$fa->mobile}}</td>
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
@endsection