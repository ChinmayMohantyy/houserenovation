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
                                <a href="{{url('/admin/organization')}}"><i class="icon-arrow-left52 position-left"></i></a>
                            </h5>
                            <form class="form-horizontal" action="{{url('admin/organization-update',$organization_edit->id)}}" method="post">
                                @csrf

                                <div class="form-group">
                                    <label class="control-label col-lg-2">Organization Name</label>
                                    <div class="col-lg-10">
                                        <input type="text" name="name" value="{{$organization_edit->name}}" class="form-control" required>
                                        {{-- @error('email') <small class="text-danger">{{$message}}</small> @enderror --}}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-lg-2">Details</label>
                                    <div class="col-lg-10">
                                        <input type="text" name="details" value="{{$organization_edit->details}}" class="form-control" required>
                                        {{-- @error('email') <small class="text-danger">{{$message}}</small> @enderror --}}
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
        </div>
    </div>
</div>


@endsection