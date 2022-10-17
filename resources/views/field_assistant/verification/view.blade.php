@extends('admin.layouts.app')

@section('content')
<div class="content">



    <!-- Basic table -->
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">House Repair Requests Details</h5>
            <div class="heading-elements">
            </div>
        </div>


        <div class="panel-body">
            <div class="table-responsive">
                <table class="table">
                    <tbody>
                        <tr>
                            <td>
                                <small><b>Name</b></small><br>
                                {{$repair_request->name}}
                            </td>
                            <td>
                                <small><b>Address</b></small><br>
                                {{$repair_request->street ? $repair_request->street.',' : ''}} {{@$repair_request->city_details->name}},{{@$repair_request->state_details->name}},{{@$repair_request->zipcode}}
                            </td>
                            <td>
                                <small><b>Primary Phone</b></small><br>
                                {{$repair_request->primary_phone}}
                            </td>
                            <td>
                                <small><b>Secondary Phone</b></small><br>
                                {{$repair_request->secondary_phone ? $repair_request->secondary_phone : 'N/a'}}
                            </td>
                            <td>
                                <small><b>Marital Status</b></small><br>
                                {{$repair_request->marital_status == 'u' ? 'Unmarried' : 'Married'}}
                            </td>
                            <td>
                                <small><b>Age of Owner</b></small><br>
                                {{$repair_request->age_of_owner}} Year
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <small><b>Alternative Contact Name</b></small><br>
                                {{$repair_request->alternate_contact_name}}
                            </td>
                            <td>
                                <small><b>Alternative Contact Phone</b></small><br>
                                {{$repair_request->alternate_contact_phone }}
                            </td>
                            <td>
                                <small><b>Total Household Income</b></small><br>
                                {{$repair_request->primary_phone}}
                            </td>
                            <td>
                                <small><b>Year lived in this house</b></small><br>
                                {{$repair_request->years_lived_in_this_home }} Years
                            </td>
                            <td>
                                <small><b>Any physically disable member</b></small><br>
                                {{$repair_request->any_resident_disabled == 'y' ? 'Yes' : 'No'}}
                            </td>
                            <td>
                                <small><b>Received CIO Help</b></small><br>
                                {{$repair_request->received_cio_help == 'y' ? 'Yes ('.@$repair_request->received_cio_help_year.')' : 'No'}}
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table class="table">
                    <tbody>
                        <tr>
                            <td>
                                <h5>Qualifier Question</h5>
                                <p>Own only one residence (the home in which you currently live). {{$repair_request->only_one_residence == 'y' ? 'Yes' : 'No'}}</p>
                                <p>Lack the finances or resources to have the repairs completed. {{$repair_request->lack_the_finances_resources == 'y' ? 'Yes' : 'No'}}</p>
                                <p>Be age 62 or older. {{$repair_request->older_age == 'y' ? 'Yes' : 'No'}}</p>
                                <p>Have a physical disability. {{$repair_request->physical_disability == 'y' ? 'Yes' : 'No'}}</p>
                                <p>Be a veteran or have a veteran residing in your home. {{$repair_request->veteran == 'y' ? 'Yes' : 'No'}}</p>
                            </td>
                            <td>
                                <h5>House Information</h5>
                                <?php $house_information = json_decode($repair_request->house_information); ?>
                                <p>Stories : {{$house_information->stories}}</p>
                                <p>Bedrooms : {{$house_information->bedrooms}}</p>
                                <p>Bathrooms : {{$house_information->bathrooms}}</p>
                                <p>Have basements : {{@$house_information->have_basement == 'y' ? 'Yes' : 'No'}}</p>
                               
                            </td>
                        </tr>
                    </tbody>
                </table>
                @if($repair_request->user_status == "pending"||
                $repair_request->user_status == "rejected")
                @else
                <field-assistant-repair-request-verification :id="{{$repair_request->id}}"  verification-document="{{$repair_request->verification_document ? $repair_request->verification_document : null }}"></field-assistant-repair-request-verification>
                @endif
            </div>
            <div class="text-right">
            @if($repair_request->user_status == "accepted")
            <a href="#" style="color:green" class="btn btn-primary text-white">Approved</a>
            @elseif($repair_request->user_status == "pending"||
            $repair_request->user_status == "rejected")
            <a href="{{url('/admin/field-assistant/house-repair-request-accept',$repair_request->id)}}" style="color:green"  class="btn btn-primary text-white">Approve</a>@endif&nbsp;
            ||&nbsp;@if($repair_request->user_status == "rejected")
            <a href="#" style="color: red"  class="btn btn-danger text-white">Disapproved</a>
            @elseif($repair_request->user_status == "pending"||
            $repair_request->user_status == "accepted")<a href="{{url('/admin/field-assistant/house-repair-request-reject',$repair_request->id)}}" style="color: red" class="btn btn-danger text-white">Disapprove</a>
            @endif
        </div>
        </div>
        
    </div>
    <!-- /basic table -->
</div>
@endsection