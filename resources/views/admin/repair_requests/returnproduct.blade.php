@extends('admin.layouts.app')

@section('content')
    <div class="content">
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h5 class="panel-title">Return Product Check<a class="heading-elements-toggle"></a></h5>
                <form class="form-inline my-2 my-lg-0" action="{{ url('/admin/return') }}" method="get">
                    <input class="form-control mr-sm-2" type="search" name="data"
                        placeholder="search your product">
                    <button type="submit" class="btn btn-outline-light my-2 my-sm-0">Search</button>
                </form>
            </div>

            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Rentable Products Name</th>
                                <th>Total Price</th>
                                <th>Barcode Number</th>
                                <th>Required Inventory</th> 
                                <th>Return Product</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($invenory_rentables as $invenory_rentable)
                                <tr>
                                    <th>{{ $invenory_rentable->inventory_data_rent->name }}</th>
                                    <th>{{ $invenory_rentable->total_price }}</th>
                                    <th>{{ $invenory_rentable->barcode_number }}</th>
                                    <th>{{ $invenory_rentable->required_quantity }}</th>
                                    <th><a href="{{url('/admin/return_requiredinventory',$invenory_rentable->id)}}">returned</a></th>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
