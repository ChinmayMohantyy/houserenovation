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
    
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
    @if(count($repair_requests) > 0)
            @foreach($repair_requests as $i => $rr)
        {{-- {{@$rr->rejectHousecaptain->id}} --}}
                    @if($rr->rejectHousecaptain)
                    @else
                    <div class="grousp_crs">
                        <div class="grousp_crs_left">
                            <div class="grousp_crs_thumb"><img src="{{asset('assets/admin/assets/images/man.jpg')}}" class="img-fluid" alt="" /></div>
                            <div class="grousp_crs_caption">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4>{{@$rr->name}}</h4>
                                        <p><i class="fas fa-phone"></i> {{@$rr->primary_phone}}</p>
                                    </div>
                                    <div>
                                        <p>{{@$rr->street}},{{@$rr->city_details->name}},{{@$rr->state_details->name}},{{@$rr->zipcode}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="grousp_crs_right">
                            <!-- <div class="frt_125"><i class="fas fa-fire text-warning mr-1"></i>8.7</div> -->
                            <div class="frt_but"><a href="{{url('/housecaptain/repair-request',$rr->id)}}" class="btn text-white theme-bg">View</a></div>
                        </div>
                    </div>   
                    @endif
            @endforeach
    @else
        <div class="text-center mb-4">No Data Available.</div>
    @endif
    </div>
</div>

@endsection