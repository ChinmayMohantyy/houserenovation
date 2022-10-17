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
                                    {{ $repair_request->name }}
                                </td>
                                <td>
                                    <small><b>Address</b></small><br>
                                    {{ $repair_request->street ? $repair_request->street . ',' : '' }}
                                    {{ @$repair_request->city_details->name }},{{ @$repair_request->state_details->name }},{{ @$repair_request->zipcode }}
                                </td>
                                <td>
                                    <small><b>Primary Phone</b></small><br>
                                    {{ $repair_request->primary_phone }}
                                </td>
                                <td>
                                    <small><b>Secondary Phone</b></small><br>
                                    {{ $repair_request->secondary_phone ? $repair_request->secondary_phone : 'N/a' }}
                                </td>
                                <td>
                                    <small><b>Marital Status</b></small><br>
                                    {{ $repair_request->marital_status == 'u' ? 'Unmarried' : 'Married' }}
                                </td>
                                <td>
                                    <small><b>Age of Owner</b></small><br>
                                    {{ $repair_request->age_of_owner }} Year
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <small><b>Alternative Contact Name</b></small><br>
                                    {{ $repair_request->alternate_contact_name }}
                                </td>
                                <td>
                                    <small><b>Alternative Contact Phone</b></small><br>
                                    {{ $repair_request->alternate_contact_phone }}
                                </td>
                                <td>
                                    <small><b>Total Household Income</b></small><br>
                                    {{ $repair_request->total_annual_household_income}}$
                                </td>
                                <td>
                                    <small><b>Year lived in this house</b></small><br>
                                    {{ $repair_request->years_lived_in_this_home }} Years
                                </td>
                                <td>
                                    <small><b>Any physically disable member</b></small><br>
                                    {{ $repair_request->any_resident_disabled == 'y' ? 'Yes' : 'No' }}
                                </td>
                                <td>
                                    <small><b>Received CIO Help</b></small><br>
                                    {{ $repair_request->received_cio_help == 'y' ? 'Yes (' . @$repair_request->received_cio_help_year . ')' : 'No' }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>
                                    <h5>Qualifier Question</h5>
                                    <p>Own only one residence (the home in which you currently live).
                                        {{ $repair_request->only_one_residence == 'y' ? 'Yes' : 'No' }}</p>
                                    <p>Lack the finances or resources to have the repairs completed.
                                        {{ $repair_request->lack_the_finances_resources == 'y' ? 'Yes' : 'No' }}</p>
                                    <p>Be age 62 or older. {{ $repair_request->older_age == 'y' ? 'Yes' : 'No' }}</p>
                                    <p>Have a physical disability.
                                        {{ $repair_request->physical_disability == 'y' ? 'Yes' : 'No' }}</p>
                                    <p>Be a veteran or have a veteran residing in your home.
                                        {{ $repair_request->veteran == 'y' ? 'Yes' : 'No' }}</p>
                                </td>
                                <td>
                                    <h5>House Information</h5>
                                    <?php $house_information = json_decode($repair_request->house_information); ?>
                                    <p>Stories : {{ @$house_information->stories }}</p>
                                    <p>Bedrooms : {{ @$house_information->bedrooms }}</p>
                                    <p>Bathrooms : {{ @$house_information->bathrooms }}</p>
                                    <p>Have basements : {{ @$house_information->have_basement == 'y' ? 'Yes' : 'No' }}</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table">
                        <tr>
                            <td>
                                <?php
                                $custom_field = json_decode($repair_request->custom_field);
                                ?>
                                @if ($custom_field)
                                    <h5>Data Added By Admin</h5>
                                    @foreach ($custom_field as $cf)
                                        <p>{{ $cf->name }} : {{ $cf->value }}</p>
                                    @endforeach
                                @endif
                            </td>
                        </tr>
                    </table>
                    <div class="row">
                        <div class="col-lg-12">
                            <admin-house-repair-request-custom-field :id="{{ $repair_request->id }}">
                            </admin-house-repair-request-custom-field><br>
                        </div>
                        <div class="col-md-6">

                        </div>
                        <div class="col-md-6">

                        </div>
                    </div>
                </div>


                <house-repair-view-action :id="{{ $repair_request->id }}" :field-assitants="{{ $field_assistants }}"
                    :field-assistant-details="{{ $repair_request->field_assistant ? $repair_request->field_assistant : 'null' }}"
                    verification-document="{{ $repair_request->verification_document ? $repair_request->verification_document : '' }}"
                    verification-data="{{ $repair_request->verification_data ? $repair_request->verification_data : '' }}"
                    verification-image="{{ $repair_request->housecaptain_image_verify ? $repair_request->housecaptain_image_verify : '' }}"
                    verified-at="{{ $repair_request->verified_at ? \Carbon\Carbon::parse($repair_request->verified_at)->format('d-m-Y') : '' }}"
                    :house-captain-details="{{ $repair_request->house_captain ? $repair_request->house_captain : 'null' }}"
                    house-captain-approved-at="{{ $repair_request->house_captain_approved_at ? \Carbon\Carbon::parse($repair_request->house_captain_approved_at)->format('d-m-Y') : '' }}">
                </house-repair-view-action>

                @if ($repair_request->house_captain_approved_at == '')
                @else
                <div class="table-responsive">
                    <table class="table">
                        <h5>Inventories List</h5>
                        <thead>
                            <tr>
                                <td>
                                    <div>
                                        <small><b>Order List Id</b></small>
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <small><b>Assign Warehouse</b></small>
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <small><b>Verify Orders</b></small>
                                    </div>
                                </td>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($inventories_list_order as $inventories_list)
                                <tr>
                                    <td>
                                        <a href="" data-toggle="modal"
                                        data-target="#inventories4-{{ $inventories_list->id }}"
                                        onclick="showUpdateModal({{ $inventories_list }})"><b>Order&nbsp;{{ $inventories_list->id }}</b></a>
                                    </td>
                                    <td>
                                        <div class="form-group col-md-6">
                                            <!-- <label for="">Choose</label> -->
                                            <select name="warehouse_id" class="form-control">
                                                <option value="">Choose...</option>
                                                @foreach ($warehouse_list as $warehouse)
                                                    <option value="{{ $warehouse->id }}" id="warehouse_id" @if($warehouse->name) selected @endif>{{ $warehouse->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </td>

                                    @if ($inventories_list->warehouse_id == '')
                                    <td><button id ="submitid" value="{{ $inventories_list->id}}" onclick="myFunction(this.value)" class="btn btn-success btn-sm">Assign</button></td>
                                        {{-- <td><button type="button" value="{{$inventories_list->id}}" id="submitid" class="btn btn-success btn-sm assignData">Assign</button></td> --}}
                                    @else
                                        <td>Assigned to <b>{{$inventories_list->warehouse_data->name}}</b></td>
                                    @endif

                                </tr>
                                <div id="inventories4-{{ $inventories_list->id }}" class="modal fade">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h5 class="modal-title">Inventories Lists</h5>
                                            </div>

                                            <div class="modal-body">
                                                <input type="hidden" value="{{ $inventories_list->id }}">
                                                <div>
                                                    
                                                        
                                                            @if ( @$inventories_list->inventory_item->count() > 0)
                                                                @foreach ( @$inventories_list->inventory_item as $data)
                                                                <h3> {{ @$data->inventory->name }}</h3><br>
                                                                @endforeach
                                                            @endif
                                                            @if ( @$inventories_list->inventory_rent->count() > 0)
                                                                @foreach ( @$inventories_list->inventory_rent as $data)
                                                                <h3> {{ @$data->inventory_data_rent->name }}</h3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                    @if ($data->barcode_number)
                                                                    <img src="data:image/png;base64,{{ base64_encode($generator->getBarcode($data->barcode_number, $generator::TYPE_CODE_128)) }}">
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <a class="btn btn-warning" href="{{ url('admin/export-barcode') }}">Export Barcode</a>
                                                <button type="button" class="btn btn-link"
                                                    data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
                <div class="text-right">
                    @if($repair_request->user_status == "accepted")
                    @else
                        @if($repair_request->user_status == "accepted")
                        <a href="#" style="color:green" class="btn btn-primary text-white">Approved</a>
                        @elseif($repair_request->user_status == "pending"||
                        $repair_request->user_status == "rejected")
                            <a href="{{url('/admin/house-repair-request-accepted',$repair_request->id)}}" style="color:green" class="btn btn-primary text-white">Approve</a>
                        @endif
                        
                        @if($repair_request->user_status == "rejected")
                            <a href="#" style="color:red" class="btn btn-danger text-white">Disapproved</a>
                            @elseif($repair_request->user_status == "pending"||
                            $repair_request->user_status == "accepted")
                            <a href="{{url('/admin/house-repair-request-rejected',$repair_request->id)}}" style="color: red" class="btn btn-danger text-white">Disapprove</a>
                        @endif
                    @endif
                </div>
               
            </div>

        </div>
        <!-- /basic table -->
        
    </div>


@endsection
@section('scripts')
    <script type="text/javascript">
        function showUpdateModal(data) {
            console.log('data');
            $('#id').val(data.id);
            $('#updateModal').modal('show');
        }

        // $(document).ready(function() {
        //     $(".assignData").click(function() {
        //         // alert('hii')

                
        //     });
        // });

        function myFunction(i){
        //  alert(i);
        var invent_id = i;
         event.preventDefault();
                var warehouse_id = $("#warehouse_id").val();
                var submitid = $("#submitid").val();
                $.ajax({
                    // console.log('hii');
                    url: "{{ url('/admin/save-Warehouse') }}/"+submitid,
                    type: 'post',
                    data: {
                        _token: '{{ csrf_token() }}',
                        warehouse_id: warehouse_id,
                        submitid:submitid,

                    },
                    success: function(response) {
                        console.log(response);

                        if (response.status = 'success') { //assuming data contains success and message
                            window.location.reload();
                        } else {
                            alert(
                            'failed'); // assuming data contains error  and message
                        }
                    },
                    error: function(response) { // executes only if ajax fails
                        alert('failed');
                    }
                });
        }
    </script>
@endsection
