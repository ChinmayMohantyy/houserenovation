@extends('admin.layouts.app')

@section('content')
<div class="content">



    <!-- Basic table -->
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">inventory</h5>
            <div class="heading-elements">
                        
                @if(auth()->guard('admin')->user()->hasAnyPermission(['inventory_create']) || auth()->guard('admin')->user()->hasRole(auth()->guard('admin')->user()->id.'_admin'))
                    <a href="{{url('/admin/return')}}" class="btn btn-primary" ><i class="icon-home"></i>&nbsp;Return inventory</a>
                        <a href="{{url('/admin/inventory-create')}}" class="btn btn-primary btn-raised">Create</a>
                @endif

            </div>
        </div>


        <div class="panel-body">
            <form action="{{ url('admin/import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="file" class="form-control">
                @if (session('failure'))
                    <div class="alert alert-danger no-border">
                        <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span
                                class="sr-only">Close</span></button>
                        <span class="text-semibold"></span> {{ session('failure') }}.
                    </div>
                @endif
                <br>
                <button type="submit" class="btn btn-success">Import Data</button>
                <a class="btn btn-warning" href="{{ url('admin/export') }}">Export User Data</a>
                <a class="btn btn-primary" href="{{ asset('manualcsv/Inventory_Details.xlsx') }}"
                    download="Inventory_Details.xlsx">Download sample</a>
            </form>
        </div>
        @if(count($inventories) > 0)
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Details</th>
                        <th>Inventory Type</th>
                        <th>Total Quantity</th>
                        <th>Required Quantity</th>
                        <th>Unit Price</th>
                        @if(auth()->guard('admin')->user()->hasAnyPermission(['inventory_update']) || auth()->guard('admin')->user()->hasRole(auth()->guard('admin')->user()->id.'_admin'))
                            <th>Action</th>
                        @endif

                    </tr>
                </thead>
                <tbody>
                    @foreach($inventories as $i => $inventory)
                    <tr>
                        <td>{{++$i}}</td>
                        <td>{{@$inventory->name}}</td>
                        <td>{{@$inventory->details}}</td>
                        <td>{{@$inventory->inventory_type}}</td>
                        <td>{{@$inventory->available_quantity}}</td>
                        <td><span style="color: red">@if($inventory->update_quantity == NULL) 00 @else{{@$inventory->update_quantity}}@endif</span></td>
                        <td>{{@$inventory->unit_price}}</td>
                        @if(auth()->guard('admin')->user()->hasAnyPermission(['inventory_update']) || auth()->guard('admin')->user()->hasRole(auth()->guard('admin')->user()->id.'_admin'))
                            <td><a href="{{url('/admin/inventory-edit',$inventory->id)}}">Edit</a></td>
                        @endif
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