@extends('admin.layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">

        <!-- Basic layout-->
        <form action="{{url('/admin/warehouse-manager-save')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <a href="{{url('/admin/warehouse-managers')}}"><i class="fa fa-arrow-circle-left"></i> Back</a> <h5 class="panel-title">Create New Warehouse Manager</h5>
                    <div class="heading-elements">
                        <ul class="icons-list">

                        </ul>
                    </div>
                </div>

                <div class="panel-body">
                    @if(session('success'))
                    <div class="alert alert-success no-border">
                        <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
                        <span class="text-semibold">Well done!</span> {{session('success')}}.
                    </div>
                    @endif
                    @if(session('failure'))
                    <div class="alert alert-danger no-border">
                        <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
                        <span class="text-semibold">Oh snap!</span> {{session('failure')}}.
                    </div>
                    @endif
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Name:</label>
                                <input type="text" class="form-control" name="name" value="{{@$warehousemanager->name}}" placeholder="Name">
                                @error('name') <small class="text-danger">{{$message}}</small> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email:</label>
                                <input type="text" class="form-control" name="email" value="{{@$warehousemanager->email}}" placeholder="Email ID">
                                @error('email') <small class="text-danger">{{$message}}</small> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Mobile:</label>
                                <input type="text" class="form-control" name="mobile" value="{{@$warehousemanager->mobile}}" placeholder="Mobile no">
                                @error('mobile') <small class="text-danger">{{$message}}</small> @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="display-block">Your avatar:</label>
                                <input type="file" class="file-styled" name="avatar">
                                <span class="help-block">Accepted formats: gif, png, jpg. Max file size 2Mb</span>
                                @error('avatar') <small class="text-danger">{{$message}}</small> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <img src="{{asset('/images/warehousemanagers/avatars/'.$warehousemanager->avatar)}}" alt="avatar" style="height: 200px;width: 150px">
                        </div>
                        <div class="col-md-12">
                            <div class="text-right">
                                <button type="submit" class="btn btn-primary">Update <i class="icon-arrow-right14 position-right"></i></button>
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