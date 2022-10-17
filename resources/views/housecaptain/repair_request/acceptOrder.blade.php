@extends('housecaptain.layouts.app')
@section('content')
<div class="card p-2">
    <div class="row">
        <div class="col-md-12">
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
        </div>
        <form action="{{url('/housecaptain/show-interest',@$reject_request_data->id)}}" method="post" enctype="multipart/form-data">

            @csrf
            @if(@$reject_request_values_data->id == '')
            <div class="col-md-12">
                <table class="table table-borderless">
                    <td>Add Order</td>
                    <td><a href="{{url('/housecaptain/add-order',@$reject_request_data->id)}}" class="text-primary">Add Order</a><br>
                    <small style="color: rgba(64, 64, 58, 0.345)">If you are intrested add your order</small>
                    </td>
                </table>
            </div>
            @else
            <div class="col-md-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Order Name</th>
                            <th>Product details</th>
                            <th>Product Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reject_request_values as $reject_request_value)
                           
                        @foreach($reject_request_value->inventory_rent as $data)
                       <tr>
                       
                                <td>{{$data->inventory_data_rent->name}}</td>
                                <td>@if($data->inventory_data_rent->inventory_type == 'r')
                                    Rentable
                                    @elseif($data->inventory_data_rent->inventory_type == 's')
                                    Sellable
                                    @endif
                                    
                                </td>
                            <td>{{$data->required_quantity}}</td>
                           
                       </tr>
                       @endforeach
                       @endforeach

                       @foreach($reject_request_values as $reject_request_value)
                           
                       @foreach($reject_request_value->inventory_item as $data_value)
                       <tr>
                       
                                <td>{{$data_value->inventory->name}}</td>
                                <td>
                                    Sellable
                                </td>
                       <td>{{$data_value->required_quantity}}</td>
                           
                       </tr>
                       @endforeach
                   @endforeach
                    </tbody>
                </table>
            </div>
            @endif
            <div class="col-md-12 text-center my-3">
                {{-- <a href="{{url('/housecaptain/repair-request-data',@$reject_request_data->id)}}" class="btn btn-primary">cancel</a> --}}
                {{-- <button type="submit" class="btn btn-danger">Save</button> --}}
                <a href="{{url('/housecaptain/repair-requests')}}" class="btn btn-success" style="float:right"> SUBMIT</a>
            </div>
        </form>
    </div>
</div>
{{-- modal --}}
 
@endsection