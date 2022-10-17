@extends('admin.layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-flat">
                <div class="panel-heading">

                    <h5 class="panel-title">City<a class="heading-elements-toggle"></a></h5>
                    <div class="heading-elements">
                        @if(auth()->guard('admin')->user()->hasAnyPermission(['city_create']) || auth()->guard('admin')->user()->hasRole(auth()->guard('admin')->user()->id.'_admin'))
                            <a href="{{url('admin/city-create')}}" class="btn btn-primary btn-raised legitRipple">CREATE</a>
                        @endif
                    </div>

                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>State_id</th>
                                <th>Name</th>
                                <th>Details</th>
                                @if(auth()->guard('admin')->user()->hasAnyPermission(['city_update']) || auth()->guard('admin')->user()->hasRole(auth()->guard('admin')->user()->id.'_admin'))
                                    <th>Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cities as $city)
                            <tr>
                                <td>{{$city->state_id}}</td>
                                <td>{{$city->name}}</td>
                                <td>{{$city->details}}</td>
                                @if(auth()->guard('admin')->user()->hasAnyPermission(['city_update']) || auth()->guard('admin')->user()->hasRole(auth()->guard('admin')->user()->id.'_admin'))
                                    <td><a href="{{url('/admin/city-edit', $city->id)}}">Edit</a></td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection