@extends('admin.layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">

        <!-- Basic layout-->
        <form action="{{url('/admin/house-captain-save')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <a href="{{url('/admin/house-captains')}}"><i class="fa fa-arrow-circle-left"></i> Back</a>
                    <h5 class="panel-title">Create House Captain</h5>
                    <div class="heading-elements">
                        <ul class="icons-list">

                        </ul>
                    </div>
                </div>

                <div class="panel-body">
                    @if(session('success'))
                    <div class="alert alert-success no-border">
                        <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
                        <span class="text-semibold"></span> {{session('success')}}.
                    </div>
                    @endif
                    @if(session('failure'))
                    <div class="alert alert-danger no-border">
                        <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
                        <span class="text-semibold"></span> {{session('failure')}}.
                    </div>
                    @endif
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Name<span style="color: red">*</span></label>
                                <input type="text" class="form-control" name="name" value="{{old('name')}}" placeholder="Name">
                                @error('name') <small class="text-danger">{{$message}}</small> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email<span style="color: red">*</span></label>
                                <input type="text" class="form-control" name="email" value="{{old('email')}}" placeholder="Email ID">
                                @error('email') <small class="text-danger">{{$message}}</small> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Mobile<span style="color: red">*</span></label>
                                <input type="text" class="form-control" name="mobile" value="{{old('mobile')}}" placeholder="Mobile no">
                                @error('mobile') <small class="text-danger">{{$message}}</small> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Organization:</label>
                                <select name="organization" id="" class="form-control">
                                    <option value="">Choose...</option>
                                    @foreach($organization_data as $organizationdata)
                                    <option value="{{$organizationdata->id}}">{{$organizationdata->name}}</option>
                                    @endforeach
                                </select>
                                @error('city') <small class="text-danger">{{$message}}</small> @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="text-right">
                                <button type="submit" class="btn btn-primary">Save <i class="icon-arrow-right14 position-right"></i></button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </form>
        <!-- /basic layout -->
    </div>
</div>
@endsection