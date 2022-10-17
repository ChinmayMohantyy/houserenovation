@extends('housecaptain.layouts.app')
@section('content')

<?php
// $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
// $product = str_pad(1, 5, 0, STR_PAD_LEFT) . time();
// echo $product;
?>
{{-- ---
<img src="data:image/png;base64,{{ base64_encode($generator->getBarcode($product, $generator::TYPE_CODE_128)) }}">
--- --}}
<div class="card p-2">
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
        </div>
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
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
        <div class="col-md-6">
            <form action="{{url('/housecaptain/save-order',$inventories)}}" method="post">
                @csrf
                <input type="hidden" value="{{Auth::guard('housecaptain')->user()->id}}" name="house_captain_id">
                <input type="hidden" value="{{$house_repaire}}" name="house_repair_request_id">
                <table class="table">
                    <h5>New Order</h5>
                   
                    @foreach ($inventories as $invenory)
                    @if($invenory->update_quantity !== '0')
                    <tr>
                        <td>{{$invenory->name}}</td>
                        <td>@if ($invenory->inventory_type ==='s')
                            sellable 
                            @else
                            rentable   
                            {{-- <input type="hidden" value="{{$product}}" name="barcode_number"> --}}
                            @endif
                        </td>
                        <td><label for="">Required Quantity</label><br><input type="number" name="required_quantity[]" ></td>
                       
                        <td>
                            <input type="checkbox" name="inventories[]" value="{{$invenory->id}}">
                        </td>
                    </tr>
                    @endif
                    @endforeach
                </table>
                <button type="submit" class="btn btn-primary">Save Order</button>
            </form>
        </div>

        <div class="col-md-6">
            <h3>Available Inventory</h3>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        @foreach ($inventories as $inventorie_data)
                            <div class="col-md-6" style="color: darkblue">{{$inventorie_data->name}}</div>
                            <div class="col-md-6" style="color: rgb(214, 87, 13)">{{$inventorie_data->update_quantity}}</div>
                        @endforeach
                    </div>
                </div>
              </div>
           
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>

const key = "Codez"

const obj = {
    'hello': 'guys',
}

obj[key] = "Up"

.console.log(obj);
</script>
@endsection