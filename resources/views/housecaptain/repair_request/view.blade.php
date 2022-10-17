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
        @if($repair_request)
        <div class="col-md-6">
            <table class="table table-borderless">
                <tr>
                    <td>Qualifier Question</td>
                    <td>
                        Own only one residence (the home in which you currently live) ? <b>{{$repair_request->only_one_residence == 'y' ? 'Yes' : 'No'}}</b><br>
                        Lack the finances or resources to have the repairs completed ? <b>{{$repair_request->lack_the_finances_resources == 'y' ? 'Yes' : 'No'}}</b><br>
                        Be age 62 or older ? <b>{{$repair_request->older_age == 'y' ? 'Yes' : 'No'}}</b><br>
                        Have a physical disability ? <b>{{$repair_request->physical_disability == 'y' ? 'Yes' : 'No'}}</b><br>
                        Be a veteran or have a veteran residing in your home ? <b>{{$repair_request->veteran == 'y' ? 'Yes' : 'No'}}</b><br>
                    </td>
                </tr>
                <tr>
                    <td>Name :</td>
                    <td>{{$repair_request->name}}</td>
                </tr>
                <tr>
                    <td>Address :</td>
                    <td>{{$repair_request->street ? $repair_request->street.',' : ''}} {{@$repair_request->city_details->name}},{{@$repair_request->state_details->name}},{{@$repair_request->zipcode}}</td>
                </tr>
                <tr>
                    <td>Primary Phone :</td>
                    <td>{{$repair_request->primary_phone}}</td>
                </tr>
                <tr>
                    <td>Secondary Phone :</td>
                    <td>{{$repair_request->secondary_phone ? $repair_request->secondary_phone : 'N/a'}}</td>
                </tr>
                <tr>
                    <td>Marital status :</td>
                    <td>{{$repair_request->marital_status == 'u' ? 'Unmarried' : 'Married'}}</td>
                </tr>
                <tr>
                    <td>Alternative Contact :</td>
                    <td>{{$repair_request->alternate_contact_name}}<br>
                        <i class="fas fa-phone"></i>{{$repair_request->alternate_contact_phone }}</td>
                </tr>
                <tr>
                    <td>Annual Household Income :</td>
                    <td>{{$repair_request->total_annual_household_income}}</td>
                </tr>
                <tr>
                    <td>Age of Owner :</td>
                    <td>{{$repair_request->age_of_owner}} Year</td>
                </tr>
                <tr>
                    <td>Year Lived In this home :</td>
                    {{-- <td>{{$repair_request->any_resident_disabled == 'y' ? 'Yes' : 'No'}}</td> --}}
                    <td>{{($repair_request->years_lived_in_this_home)}}</td>
                </tr>
                <tr>
                    <td>Any Resident Disabled :</td>
                    <td>{{$repair_request->any_resident_disabled == 'y' ? 'Yes' : 'No'}}</td>
                </tr>
                <tr>
                    <td>Any Veteran Member :</td>
                    <td>{{$repair_request->any_veteran_member == 'y' ? 'Yes' : 'No'}}</td>
                </tr>
            </table>
        </div>
        <div class="col-md-6">
            <table class="table table-borderless">
                <tr>
                    <td>Received CIO Help :</td>
                    <td>{{$repair_request->received_cio_help == 'y' ? 'Yes ('.@$repair_request->received_cio_help_year.')' : 'No'}}</td>
                </tr>
                <tr>
                    <td>House Information</td>
                    <td>
                        <?php $house_information = json_decode($repair_request->house_information); ?>
                        Stories : {{$house_information->stories}}<br>
                        Bedrooms : {{$house_information->bedrooms}}<br>
                        Bathrooms : {{$house_information->bathrooms}}<br>
                        Have basements : {{@$house_information->have_basement == 'y' ? 'Yes' : 'No'}}<br>
                    </td>
                </tr>
                {{-- <tr>
                    <td>Document</td>
                    <td><a href="{{asset('/verification_documents/'.$repair_request->verification_document)}}" target="_blank" class="text-success">Click Here</a></td>
                </tr>
                <tr>
                    <td>Verification Data</td>
                    <td>{{$repair_request->verification_data}}</td>
                </tr>
                <tr>
                    <td>Add Order</td>
                    <td><a href="{{url('/housecaptain/add-order',$repair_request->id)}}" class="text-primary">Add Order</a></td>
                </tr> --}}
                <tr>
                    <td>All Reviews</td>
                @foreach($allimage_housecaptain as $allimage_housecaptain_image)
                    <td>@foreach(explode(',', $allimage_housecaptain_image->housecaptain_image_verify) as $data)
                        @if($data == '')
                        @else
                            <img src="{{asset('uploads/product_images'.'/'.$data)}}"style="height: 100px;width:100px"alt="">
                        @endif
                    @endforeach</td>
                @endforeach
                    
                </tr>
                <tr>
                    <td>Message Reviews</td>
                @foreach($allimage_housecaptain as $allimage_housecaptain_image_data)
                        @if($allimage_housecaptain_image_data->housecaptain_feedback == '')
                        @else
                    <td>{{$allimage_housecaptain_image_data->housecaptain_feedback}}</td>
                    @endif
                @endforeach
                </tr>
            </table>
        </div>
        <div class="col-md-12 text-center my-3">
            {{-- @if ($repair_request->rejected_house_captains == '')
            <a href="{{url('/housecaptain/show-interest',$repair_request->id)}}" class="btn btn-success">Interested</a>
            <a href="{{url('/housecaptain/show-reject',$repair_request->id)}}" class="btn btn-danger">Reject</a>
            @else
            <a href="#" class="btn btn-danger">Already Rejected</a>
            @endif --}}
            <a href="{{url('/housecaptain/repair-request-data',$repair_request->id)}}" class="btn btn-success">Next</a>
        </div>
        @else 
        <div class="col-md-12 text-center my-3">
            <a href="{{url('/housecaptain/repair-requests')}}" class="text-success">Back To Repair Request</a>
        </div>   
        @endif
    </div>
</div>
@endsection