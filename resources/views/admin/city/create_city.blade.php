@extends('admin.layouts.app')

@section('content')
<div class="content">
    <div class="row">
        <div class="col-lg-12">
           
                <div class="panel panel-flat col-md-12">
                    <div class="panel-heading">
                        <div class="panel-body">
                            <h5>
                                <a href="{{url('/admin/cities')}}"><i class="icon-arrow-left52 position-left"></i></a>
                            </h5>
                            <form class="form-horizontal" action="{{url('admin/city-save')}}" method="post">
                                @csrf

                                {{-- <div class="form-group">
                                    <label class="control-label col-lg-2">State_id</label>
                                    <div class="col-lg-10">

                                        <select name="state_id" class="form-control">
                                            <option value="">Select....</option>
                                            @foreach($states as $state)
                                            <option value="{{$state->id}}">{{$state->name}}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div> --}}

                                <div class="form-group">
                                    <label class="control-label col-lg-2">Name</label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" id="name" placeholder="Enter your  city name" name="city" required>
                                        @error('email') <small class="text-danger">{{$message}}</small> @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-lg-2">State</label>
                                    <div class="col-lg-10">
                                        <select name="state" id="" class="form-control">
                                            <option value="">Select State</option>
                                            <option value="1">Missouri</option>
                                            <option value="2">Kansas</option>
                                        </select>
                                        @error('email') <small class="text-danger">{{$message}}</small> @enderror
                                    </div>
                                </div>
                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary legitRipple">Submit <i
                                            class="icon-arrow-right14 position-right"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            @endsection