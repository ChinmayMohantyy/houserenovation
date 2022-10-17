@extends('admin.layouts.app')

@section('content')
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <div class="panel panel-flat col-md-12">
                    <div class="panel-heading">
                        <div class="panel-body">
                            <h5>
                                <a href="{{url('/admin/cities')}}"><i class="icon-arrow-left52 position-left"></i></a>
                            </h5>

                            <form class="form-horizontal" action="{{url('/admin/city-update',$city->id)}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label class="control-label col-lg-2">State</label>
                                    <div class="col-lg-10">

                                        <select name="state_id" class="form-control">

                                            <option value="">Select....</option>
                                            @foreach($states as $state)
                                            <option value="{{ $state->id }}" @if($state->id == $city->state_id) selected
                                                @endif>{{ $state->name }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-lg-2">Name</label>
                                    <div class="col-lg-10">
                                        <input type="text" name="name" value="{{$city->name}}" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-lg-2">Details</label>
                                    <div class="col-lg-10">
                                        <input type="text" name="details" value="{{$city->details}}"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="text-right">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection