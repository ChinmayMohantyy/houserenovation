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
                                <a href="{{url('/admin/states')}}"><i class="icon-arrow-left52 position-left"></i></a>
                            </h5>
                            <form class="form-horizontal" action="{{url('admin/state-update')}}" method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{$state->id}}">
                                <div class="form-group">
                                    <label class="control-label col-lg-2">Name</label>
                                    <div class="col-lg-10">
                                        <input type="text" name="name" value="{{$state->name}}" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-lg-2">Details</label>
                                    <div class="col-lg-10">
                                        <input type="text" name="details" value="{{$state->details}}"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary legitRipple">Update <i
                                            class="icon-arrow-right14 position-right"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @endsection