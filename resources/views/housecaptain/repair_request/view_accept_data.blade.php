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
                    {{-- @if($rr->rejectHousecaptain)
                    @else --}}
                    <div class="grousp_crs">
                        <div class="grousp_crs_left">
                            <div class="grousp_crs_thumb"><img src="{{asset('assets/admin/assets/images/man.jpg')}}" class="img-fluid" alt="" /></div>
                            <div class="grousp_crs_caption">
                                <div class="row">
                                    <div class="col-md-6" data-toggle="modal" data-target=".bd-example-modal-lg-{{$rr->id}}">
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
                            <div class="frt_but">
                                {{-- <a href="{{url('/housecaptain/repair-request',$rr->id)}}" class="btn text-white theme-bg">View</a> --}}
                                @if($rr->completed_date == "")
                                
                                    @if($rr->status == "work_completed")
                                    @else
                                    <a href="{{url('/housecaptain/accept',$rr->id)}}">Add Order</a>@endif
                                    &nbsp;  <a href="{{url('/housecaptain/completed',$rr->id)}}" class="btn text-white theme-bg">Mark As complete</a>
                                @else
                                <h2 style="color: red">completed</h2>
                                @endif
                            </div>
                        </div>
                    </div>   
                    {{-- @endif --}}


                    {{-- modal --}}
                    <div class="modal fade bd-example-modal-lg-{{$rr->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                          <div class="modal-content">
                            <div class="modal-body">
                              <div class="row">
                                <div class="col-md-4">
                                    <label for="">Only one residence:</label>
                                </div>
                                <div class="col-md-8">
                                    <p>{{$rr->name}}</p>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-4">
                                    <label for="">Only One Residency:</label>
                                </div>
                                <div class="col-md-8">
                                    {{-- <p>{{! $rr->only_one_residence!}}</p> --}}
                                    @if ($rr->only_one_residence == 'y')
                                    <span>Yes</span>
                                @else
                                    <span>No</span>
                                @endif
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-4">
                                    <label for="">Lack the Finance Resources:</label>
                                </div>
                                <div class="col-md-8">
                                    {{-- <p>{{$rr->lack_the_finances_resources}}</p> --}}
                                    @if ($rr->lack_the_finances_resources == 'y')
                                    <span>Yes</span>
                                @else
                                    <span>No</span>
                                @endif
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-4">
                                    <label for="">Older Age:</label>
                                </div>
                                <div class="col-md-8">
                                    {{-- <p>{{$rr->older_age}}</p> --}}
                                    @if ($rr->older_age == 'y')
                                    <span>Yes</span>
                                @else
                                    <span>No</span>
                                @endif
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-4">
                                    <label for="">Physical Desability:</label>
                                </div>
                                <div class="col-md-8">
                                    {{-- <p>{{$rr->physical_disability}}</p> --}}
                                    @if ($rr->older_age == 'y')
                                    <span>Yes</span>
                                @else
                                    <span>No</span>
                                @endif
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-4">
                                    <label for="">Veteran:</label>
                                </div>
                                <div class="col-md-8">
                                    {{-- <p>{{$rr->veteran}}</p> --}}
                                    @if ($rr->veteran == 'y')
                                    <span>Yes</span>
                                @else
                                    <span>No</span>
                                @endif
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-4">
                                    <label for="">Street:</label>
                                </div>
                                <div class="col-md-8">
                                    <p>{{$rr->street}}</p>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-4">
                                    <label for="">Email:</label>
                                </div>
                                <div class="col-md-8">
                                    <p>{{$rr->email}}</p>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-4">
                                    <label for="">City:</label>
                                </div>
                                <div class="col-md-8">
                                    <p>{{$rr->city}}</p>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-4">
                                    <label for="">State:</label>
                                </div>
                                <div class="col-md-8">
                                    <p>{{$rr->state}}</p>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-4">
                                    <label for="">Zip Code:</label>
                                </div>
                                <div class="col-md-8">
                                    <p>{{$rr->zipcode}}</p>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-4">
                                    <label for="">City:</label>
                                </div>
                                <div class="col-md-8">
                                    <p>{{$rr->city}}</p>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-4">
                                    <label for="">Extend Zip:</label>
                                </div>
                                <div class="col-md-8">
                                    <p>{{$rr->extended_zip}}</p>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-4">
                                    <label for="">Primery Phone:</label>
                                </div>
                                <div class="col-md-8">
                                    <p>{{$rr->primary_phone}}</p>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-4">
                                    <label for="">Secondary Phone:</label>
                                </div>
                                <div class="col-md-8">
                                    <p>{{$rr->secondary_phone}}</p>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-4">
                                    <label for="">Marital Status:</label>
                                </div>
                                <div class="col-md-8">
                                    <p>{{$rr->marital_status}}</p>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-4">
                                    <label for="">Alternate Contact Name:</label>
                                </div>
                                <div class="col-md-8">
                                    <p>{{$rr->alternate_contact_name}}</p>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-4">
                                    <label for="">Alternate Contact Phone:</label>
                                </div>
                                <div class="col-md-8">
                                    <p>{{$rr->alternate_contact_phone}}</p>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-4">
                                    <label for="">Total Annual Income:</label>
                                </div>
                                <div class="col-md-8">
                                    <p>{{$rr->total_annual_household_income}}</p>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-4">
                                    <label for="">Age of Owner:</label>
                                </div>
                                <div class="col-md-8">
                                    <p>{{$rr->age_of_owner}}</p>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-4">
                                    <label for="">Year Live In This Home:</label>
                                </div>
                                <div class="col-md-8">
                                    <p>{{$rr->years_lived_in_this_home}}</p>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-4">
                                    <label for="">Resident Disabled:</label>
                                </div>
                                <div class="col-md-8">
                                    <p>{{$rr->any_resident_disabled}}</p>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-4">
                                    <label for="">Disabled Person Details:</label>
                                </div>
                                <div class="col-md-8">
                                    <p>{{$rr->disabled_person_details}}</p>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-4">
                                    <label for="">Any Veteran Member:</label>
                                </div>
                                <div class="col-md-8">
                                    {{-- <p>{{$rr->any_veteran_member}}</p> --}}
                                    @if ($rr->veteran == 'y')
                                    <span>Yes</span>
                                @else
                                    <span>No</span>
                                @endif
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-4">
                                    <label for="">Residents Details:</label>
                                </div>
                                <div class="col-md-8">
                                    <p>{{$rr->residents_details}}</p>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-4">
                                    <label for="">House Information:</label>
                                </div>
                                <div class="col-md-8">
                                    <p>  <?php $rr_data = json_decode($rr->house_information, true); ?>
                                        Stories:{{ $rr_data['stories'] }}</p>
                                        bedrooms:{{ $rr_data['bedrooms'] }}</p>
                                        bathrooms:{{ $rr_data['bathrooms'] }}</p>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-4">
                                    <label for="">Received Cio Help:</label>
                                </div>
                                <div class="col-md-8">
                                    <p>{{$rr->received_cio_help}}</p>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-4">
                                    <label for="">Received cio Help Year:</label>
                                </div>
                                <div class="col-md-8">
                                    <p>{{$rr->received_cio_help_year}}</p>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-4">
                                    <label for="">Basic Plumbing:</label>
                                </div>
                                <div class="col-md-8">
                                    {{-- <p>{{$rr->basic_plumbing}}</p> --}}
                                    <p> <?php $plumbing_data = json_decode($rr->basic_plumbing, true); ?>
                                        checked:{{ @$plumbing_data['checked'] }}</p>
                                        explain:{{ @$plumbing_data['explain'] }}</p>
                                        Do you have running water:{{ @$plumbing_data['Do you have running water'] }}</p>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-4">
                                    <label for="">Heat Furnace :</label>
                                </div>
                                <div class="col-md-8">
                                    <p> <?php $heat_data = json_decode($rr->heat_furnace, true); ?>
                                        checked:{{ @$heat_data['checked'] }}</p>
                                        explain:{{ @$heat_data['explain'] }}</p>
                                        Is your gas shutoff:{{ @$heat_data['Is your gas shutoff'] }}</p>
                                        Do you currently have heat:{{ @$heat_data['Do you currently have heat'] }}</p>
                                </div>

                              </div>
                              <div class="row">
                                <div class="col-md-4">
                                    <label for="">Basic Electrical :</label>
                                </div>
                                <div class="col-md-8">
                                    {{-- <p>{{$rr->basic_electrical}}</p> --}}
                                    <p><?php $basic_electricals = json_decode($rr->basic_electrical, true); ?>
                                        @if ($basic_electricals == 'y')
                                    <span>Yes</span>
                                @else
                                    <span>No</span>
                                @endif
                                    </p>
                                 
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-4">
                                    <label for="">Doors And Windows :</label>
                                </div>
                                <div class="col-md-8">
                                    {{-- <p>{{$rr->doors_and_windows}}</p> --}}
                                    <p><?php $doors_and_window = json_decode($rr->doors_and_windows, true); ?>
                                        @if ($doors_and_window == 'y')
                                    <span>Yes</span>
                                @else
                                    <span>No</span>
                                @endif
                                    </p>
                                    
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-4">
                                    <label for="">Painting :</label>
                                </div>
                                <div class="col-md-8">
                                    {{-- <p>{{$rr->painting}}</p> --}}
                                    <p><?php $paintings = json_decode($rr->painting, true); ?>
                                        @if ($paintings == 'y')
                                    <span>Yes</span>
                                @else
                                    <span>No</span>
                                @endif
                                    </p>
                                   
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-4">
                                    <label for="">Wood Repair :</label>
                                </div>
                                <div class="col-md-8">
                                    {{-- <p>{{$rr->wood_repair}}</p> --}}
                                    <p><?php $wood_repairs = json_decode($rr->wood_repair, true); ?>
                                        @if ($wood_repairs == 'y')
                                    <span>Yes</span>
                                @else
                                    <span>No</span>
                                @endif
                                    </p>
                                   
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-4">
                                    <label for="">Roof Patching :</label>
                                </div>
                                <div class="col-md-8">
                                    {{-- <p>{{$rr->roof_patching}}</p> --}}
                                    <p><?php $roof_patchings = json_decode($rr->roof_patching, true); ?>
                                        @if ($roof_patchings == 'y')
                                    <span>Yes</span>
                                @else
                                    <span>No</span>
                                @endif
                                    </p>
                                  </div>
                              </div>
                              <div class="row">
                                <div class="col-md-4">
                                    <label for="">Gutters :</label>
                                </div>
                                <div class="col-md-8">
                                    {{-- <p>{{$rr->gutters}}</p> --}}
                                    <p><?php $gutter = json_decode($rr->gutters, true); ?>
                                        @if ($gutter == 'y')
                                    <span>Yes</span>
                                @else
                                    <span>No</span>
                                @endif
                                    </p>
                                  </div>
                              </div>
                              <div class="row">
                                <div class="col-md-4">
                                    <label for="">Insulation Weatherization :</label>
                                </div>
                                <div class="col-md-8">
                                    {{-- <p>{{$rr->insulation_weatherization}}</p> --}}
                                    <p><?php $insulation_weatherizations = json_decode($rr->insulation_weatherization, true); ?>
                                        @if ($insulation_weatherizations == 'y')
                                    <span>Yes</span>
                                @else
                                    <span>No</span>
                                @endif
                                    </p>
                                  
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-4">
                                    <label for="">Wheelchair Ramp :</label>
                                </div>
                                <div class="col-md-8">
                                    {{-- <p>{{$rr->wheelchair_ramp}}</p> --}}
                                    <p><?php $wheelchair_ramps = json_decode($rr->wheelchair_ramp, true); ?>
                                        @if ($wheelchair_ramps == 'y')
                                    <span>Yes</span>
                                @else
                                    <span>No</span>
                                @endif
                                    </p>
                                   
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-4">
                                    <label for="">Concrete Patching :</label>
                                </div>
                                <div class="col-md-8">
                                    {{-- <p>{{$rr->concrete_patching}}</p> --}}
                                    <p><?php $concrete_patchings = json_decode($rr->concrete_patching, true); ?>
                                        @if ($concrete_patchings == 'y')
                                    <span>Yes</span>
                                @else
                                    <span>No</span>
                                @endif
                                    </p>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-4">
                                    <label for="">Other Repairs :</label>
                                </div>
                                <div class="col-md-8">
                                    {{-- <p>{{$rr->other_repairs}}</p> --}}
                                    <p><?php $other_repair = json_decode($rr->other_repairs, true); ?>
                                        @if ($other_repair == 'y')
                                    <span>Yes</span>
                                @else
                                    <span>No</span>
                                @endif
                                    </p>
                                   
                                </div>
                              </div>
                              </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                          </div>
                        </div>
                      </div>
            @endforeach
    @else
        <div class="text-center mb-4">No Data Available.</div>
    @endif
    </div>
</div>
<!-- Button trigger modal -->
<!-- Button trigger modal -->
  
  <!-- Modal -->
 
@endsection