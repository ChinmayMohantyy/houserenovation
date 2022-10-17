@extends('admin.layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">

        <!-- Basic layout-->
        <form action="{{url('/admin/warehouse-save')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <a href="{{url('/admin/warehouses')}}"><i class="fa fa-arrow-circle-left"></i> Back</a>
                    <h5 class="panel-title">Create New Warehouse</h5>
                    <div class="heading-elements">
                        <ul class="icons-list">

                        </ul>
                    </div>
                </div>

                <div class="panel-body">
                    @if(session('success'))
                    <div class="alert alert-success no-border">
                        <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span
                                class="sr-only">Close</span></button>
                        <span class="text-semibold">Well done!</span> {{session('success')}}.
                    </div>
                    @endif
                    @if(session('failure'))
                    <div class="alert alert-danger no-border">
                        <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span
                                class="sr-only">Close</span></button>
                        <span class="text-semibold">Oh snap!</span> {{session('failure')}}.
                    </div>
                    @endif
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Name:</label>
                                <input type="text" class="form-control" name="name" value="{{old('name')}}"
                                    placeholder="Name">
                                @error('name') <small class="text-danger">{{$message}}</small> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Details:</label>
                                <input type="text" class="form-control" name="details" value="{{old('details')}}"
                                    placeholder="Details">
                                @error('details') <small class="text-danger">{{$message}}</small> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Street:</label>
                                <input type="text" class="form-control" name="street" value="{{old('street')}}"
                                    placeholder="Street">
                                @error('street') <small class="text-danger">{{$message}}</small> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>City:</label>
                                <select name="city" class="form-control" value="{{old('city')}}">
                                    <option value="">Choose....</option>
                                    @foreach($cities as $city)
                                    <option value="{{$city->id}}">{{$city->name}}</option>
                                    @endforeach
                                </select>
                                @error('city') <small class="text-danger">{{$message}}</small> @enderror
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group">
                                <label>State:</label>

                                <select name="state" id="" class="form-control" value="{{old('state')}}">
                                    <option value="">Choose...</option>
                                    @foreach($states as $state)
                                    <option value="{{$state->id}}">{{$state->name}}</option>
                                    @endforeach
                                </select>
                                @error('state') <small class="text-danger">{{$message}}</small> @enderror
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Zipcode:</label>
                                <input type="text" class="form-control" name="zipcode" value="{{old('zipcode')}}"
                                    placeholder="Zipcode">
                                @error('zipcode') <small class="text-danger">{{$message}}</small> @enderror
                            </div>

                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Warehouse Manager</label>

                                <select name="warehouse_manager_id" class="form-control">
                                    <option value="">Choose....</option>
                                    @foreach($warehousemanagers as $warehousemanager)
                                    <option value="{{$warehousemanager->id}}">{{$warehousemanager->name}}</option>
                                    @endforeach
                                </select>
                                @error('warehouse_manager_id') <small class="text-danger">{{$message}}</small> @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="text-right">
                                <button type="submit" class="btn btn-primary">Save <i
                                        class="icon-arrow-right14 position-right"></i></button>
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