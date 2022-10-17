@extends('admin.layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">

        <!-- Basic layout-->
        <form action="{{url('/admin/inventory-save')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <a href="{{url('/admin/inventories')}}"><i class="fa fa-arrow-circle-left"></i> Back</a>
                    <h5 class="panel-title">Inventory</h5>
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
                                <label>Inventory_type:</label>
                                <select name="inventory_type" id="" class="form-control" value="{{old('inventory_type')}}">
                               
                                    <option value="s">Sellable</option>
                                    <option value="r">Rentable</option>

                                </select>
                                @error('inventory_type') <small class="text-danger">{{$message}}</small> @enderror
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Available_quantity:</label>
                             <input type="number" class="form-control" name="available_quantity" value="{{old('available_quantity')}}" placeholder="Available_quantity">
                                @error('available_quantity') <small class="text-danger">{{$message}}</small> @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>unit_price:</label>
                                <input type="number" class="form-control" name="unit_price"  step="0.01" id="unit_price" value="{{old('Unit_price')}}"
                                    placeholder="Unit_price">
                                @error('unit_price') <small class="text-danger">{{$message}}</small> @enderror
                            </div>
                        </div>
                       

                        <div class="col-md-6">
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
