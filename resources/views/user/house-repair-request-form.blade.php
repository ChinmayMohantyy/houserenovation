@extends('user.layouts.app')
@section('content')
<style>
    .box .form-control{
        padding: 9px !important;
    }
    .box h2{
        font-size: 20px;
    }
    .box h4{
        font-size: 16px;
    }
    .headline{
        background: #fff;
        z-index: 1;
        position: absolute;
        left: 46%;
        top: -14px;
    }
    .main-head{
        position: relative;
    }
</style>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8 offset-2">
                <h3 class="text-center my-3">House Repair Request Form</h3>
                <div class="card shadow">
                    <div class="card-body">
                        <form action="{{ url('house-repair-form-save') }}" method="POST">
                            @CSRF
                            
                            <div class="box">                                                                                                                                                                          
                                <div class="container">
                                    <div class="main-head">
                                        <h2 >To qualify for the Christmas in October program, you must:</h2>                                                                      </div>
                                    <div class="border p-3 mt-3" style="border-radius: 10px;">
                                        <div class="row">
                                            <div class="form-group smalls">
                                                <label>(1) Own only one residence (the home in which you currently live).</label>
                                                <input type="radio" name="only_one_residence" value="y"
                                                     placeholder="">Yes
                                                <input type="radio" name="only_one_residence" value="n"
                                                     placeholder="">No
                                            </div>
                                            <div class="form-group smalls">
                                                <label>(2) Lack the finances or resources to have the repairs completed.</label>
                                                <input type="radio" name="lack_the_finances_resources" value="y"
                                                    placeholder="">Yes
                                                <input type="radio" name="lack_the_finances_resources" value="n"
                                                    placeholder="">No
                                            </div>
                                        </div>
                                    </div>
                                    {{--  --}}
                                    <div class="main-head mt-3">
                                        <h2 >In addition, you must meet ONE of the following criteria:</h2>                                                                      </div>
                                    <div class="border p-3 mt-3" style="border-radius: 10px;">
                                        <div class="row">
                                            <div class="form-group smalls">
                                                <label>(1) Be age 62 or older.</label>
                                                <input type="radio" name="older_age" value="y" 
                                                    placeholder="">Yes
                                                <input type="radio" name="older_age" value="n" 
                                                    placeholder="">No
                                            </div>
                                            <div class="form-group smalls">
                                                <label>(2) Have a physical disability.</label>
                                                <input type="radio" name="physical_disability" value="y"
                                                    placeholder="">Yes
                                                <input type="radio" name="physical_disability" value="n"
                                                     placeholder="">No
                                            </div>
                                            <div class="form-group smalls">
                                                <label>(3) Be a veteran or have a veteran residing in your home.</label>
                                                <input type="radio" name="veteran" value="y" 
                                                    placeholder="">Yes
                                                <input type="radio" name="veteran" value="n" 
                                                    placeholder="">No
                                            </div>
                                        </div>
                                    </div>
                                    {{--  --}}
                    
                                    <div class="main-head mt-5">
                                        <h2 class="text-center headline">Houseowner Information</h2>                                                                      </div>
                                    <div class="border p-3 mt-5" style="border-radius: 10px;">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="bg-light pl-2 pr-2 mb-3" style="border-radius: 10px;">
                                                    <h4>Name</h4>
                                                    <div class="row">
                                                        <div class="col-md-12 form-group">     
                                                            <input type="text" name="name" class="form-control form-control-sm">
                                                        </div>
                    
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="bg-light pl-2 pr-2 mb-3" style="border-radius: 10px;">
                                                    <h4>Street Address</h4>
                                                    <div class="row">
                                                        <div class="col-md-12 form-group">
                                                <textarea name="street" id="" cols="10" rows="5" class="form-control form-control-sm"></textarea>

                                                        </div>
                    
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="bg-light pl-2 pr-2 mb-3" style="border-radius: 10px;">
                                                    <h4>Email</h4>
                                                    <div class="row">
                                                        <div class="col-md-12 form-group">
                                                            <input type="text" name="email" class="form-control form-control-sm">
                                                        </div>
                    
                                                    </div>
                                                </div>
                                            </div>
                                             <div class="col-md-6">
                                                <div class="bg-light pl-2 pr-2 mb-3" style="border-radius: 10px;">
                                                    <div class="row">
                                                        <div class="col-12 form-group">
                                                            <h4>State</h4>
                                                            <select name="state" id="state" onchange="getcity(this.value)"
                                                            class="form-control" required>
                                                            <option value="">Choose State...</option>
                                                        </select>
                                                        </div>
                                                    </div>
                    
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="bg-light pl-2 pr-2 mb-3" style="border-radius: 10px;">
                                                    <div class="row">
                                                        <div class="col-12 form-group">
                                                            <h4> City</h4>
                                                            <select name="city" id="city" class="form-control">
                                                                <option value="">Choose City...</option>
                                                            </select>
                                                        </div>
                                                    </div>
                    
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="bg-light pl-2 pr-2 mb-3" style="border-radius: 10px;">
                                                    <h4>Zipcode</h4>
                                                    <div class="row">
                                                        <div class="col-md-12 form-group">
                                                            <input type="text" name="zipcode" class="form-control form-control-sm">
                                                        </div>
                    
                                                    </div>
                                                </div>
                                            </div> 
                                            <div class="col-md-6">
                                                <div class="bg-light pl-2 pr-2 mb-3" style="border-radius: 10px;">
                                                    <h4>Extended Zip</h4>
                                                    <div class="row">
                                                        <div class="col-md-12 form-group">
                                                            <input type="text" name="extended_zip"
                                                            class="form-control form-control-sm">
                                                        </div>
                    
                                                    </div>
                                                </div>
                                            </div> 
                                            <div class="col-md-6">
                                                <div class="bg-light pl-2 pr-2 mb-3" style="border-radius: 10px;">
                                                    <h4>Primary Phone</h4>
                                                    <div class="row">
                                                        <div class="col-md-12 form-group">
                                                            <input type="text" name="primary_phone"
                                                                class="form-control form-control-sm">
                                                        </div>
                    
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="bg-light pl-2 pr-2 mb-3" style="border-radius: 10px;">
                                                    <h4>Secondary Phone</h4>
                                                    <div class="row">
                                                        <div class="col-md-12 form-group">
                                                            <input type="text" name="secondary_phone"
                                                                class="form-control form-control-sm">
                                                        </div>
                    
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="bg-light pl-2 pr-2 mb-3" style="border-radius: 10px;">
                                                    <h4>Name of Alternate Contact</h4>
                                                    <div class="row">
                                                        <div class="col-md-12 form-group">
                                                            <input type="text" name="alternate_contact_name"
                                                                class="form-control form-control-sm">
                                                        </div>
                    
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="bg-light pl-2 pr-2 mb-3" style="border-radius: 10px;">
                                                    <h4>Alternate Contact's Phone</h4>
                                                    <div class="row">
                                                        <div class="col-md-12 form-group">
                                                            <input type="text" name="alternate_contact_phone"
                                                            class="form-control form-control-sm">
                                                        </div>
                    
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="bg-light pl-2 pr-2 mb-3" style="border-radius: 10px;">
                                                    <h4>Total Annual Household Income $</h4>
                                                    <div class="row">
                                                        <div class="col-md-12 form-group">
                                                            <input type="text" name="total_annual_household_income"
                                                            class="form-control form-control-sm" placeholder="$0.00">
                                                        </div>
                    
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="bg-light pl-2 pr-2 mb-3" style="border-radius: 10px;">
                                                    <h4>Age of Owner</h4>
                                                    <div class="row">
                                                        <div class="col-md-12 form-group">
                                                            <input type="text" name="age_of_owner"
                                                                class="form-control form-control-sm">
                                                        </div>
                    
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="bg-light pl-2 pr-2 mb-3" style="border-radius: 10px;">
                                                    <h4>How many years have you lived in your home?</h4>
                                                    <div class="row">
                                                        <div class="col-md-12 form-group">
                                                            <input type="text" name="years_lived_in_this_home"
                                                            class="form-control form-control-sm">
                                                        </div>
                    
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="bg-light pl-2 pr-2 mb-3 mt-3" style="border-radius: 10px;">
                                                    <h4 for="">Is any resident disabled?</h4>
                                                    <input type="radio" name="any_resident_disabled" value="y"
                                                         placeholder="">&nbsp;&nbsp;Yes
                                                    <input type="radio" name="any_resident_disabled" value="n"
                                                         placeholder="">&nbsp;&nbsp;No
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="bg-light pl-2 pr-2 mb-3 mt-3" style="border-radius: 10px;">
                                                        <h4>Explain disability:</h4>
                                                    <div class="row">
                                                        <div class="col-md-12 form-group">
                                                            <textarea name="disabled_person_details" id="" cols="10" rows="5"
                                                        class="form-control form-control-sm"></textarea>
                                                        </div>
                    
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="bg-light pl-2 pr-2 mb-3 mt-3" style="border-radius: 10px;">
                                                    <h4 for="">Are you married?</h4>
                                                    <input type="radio" name="marital_status" value="m"
                                                         placeholder="">&nbsp;&nbsp;Yes
                                                    <input type="radio" name="marital_status" value="u"
                                                         placeholder="">&nbsp;&nbsp;No
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="bg-light pl-2 pr-2 mb-3 mt-3" style="border-radius: 10px;">
                                                    <h4 for="">Does a veteran live in the home?</h4>
                                                    <input type="radio" name="any_veteran_member" value="y"
                                                    placeholder="">&nbsp;&nbsp;Yes
                                                    <input type="radio" name="any_veteran_member" value="n"
                                                         placeholder="">&nbsp;&nbsp;No
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="main-head mt-5">
                                        <h2 class="text-center headline">General Information on House:</h2>                                                                      </div>
                                    <div class="border p-3 mt-5" style="border-radius: 10px;">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="bg-light pl-2 pr-2 mb-3" style="border-radius: 10px;">
                                                    <div class="row">
                                                        <div class="col-12 form-group">
                                                            <h4>Number of stories</h4>
                                                            <select name="house_information[stories]" id="" class="form-control" required>
                                                                <option value="">Choose...</option>
                                        
                                        
                                                                <?php
                                                                for ($x = 1; $x <= 10; $x++) {
                                                                ?>
                                                                <option value="{{ $x }}">{{ $x }}</option>
                                                                <?php
                                                                 }
                                                                ?>
                                                               </select>
                                                        </div>
                                                    </div>
                    
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="bg-light pl-2 pr-2 mb-3" style="border-radius: 10px;">
                                                    <div class="row">
                                                        <div class="col-12 form-group">
                                                            <h4>Number of bedrooms</h4>
                                                            <select name="house_information[bedrooms]" id="" class="form-control" required>
                                                                <option value="">Choose State...</option>
                                                                <?php
                                                                for ($x = 1; $x <= 10; $x++) {
                                                                ?>
                                                                <option value="{{ $x }}">{{ $x }}</option>
                                                                <?php
                                                                 }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                    
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="bg-light pl-2 pr-2 mb-3" style="border-radius: 10px;">
                                                    <div class="row">
                                                        <div class="col-12 form-group">
                                                            <h4>Number of bathrooms</h4>
                                                            <select name="house_information[bathrooms]" id="" class="form-control" required>
                                                                <option value="">Choose State...</option>
                                                                <?php
                                                                for ($x = 1; $x <= 10; $x++) {
                                                                ?>
                                                                <option value="{{ $x }}">{{ $x }}</option>
                                                                <?php
                                                                 }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                    
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="bg-light pl-2 pr-2 mb-3 mt-3" style="border-radius: 10px;">
                                                    <h4 for="">Does house have basement?</h4>
                                                    <input type="radio" name="house_information[have_basement]"
                                                        value="y" >&nbsp;&nbsp;Yes
                                                        <input type="radio" name="house_information[have_basement]"
                                                        value="n" >&nbsp;&nbsp;No
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="bg-light pl-2 pr-2 mb-3 mt-3" style="border-radius: 10px;">
                                                    <h4 for="">Have you received help from Christmas in October before?</h4>
                                                    <input type="radio" name="received_cio_help"
                                                        value="y" >&nbsp;&nbsp;Yes
                                                        <input type="radio" name="received_cio_help"
                                                        value="n" >&nbsp;&nbsp;No
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="bg-light pl-2 pr-2 mb-3" style="border-radius: 10px;">
                                                    <h4>What year?(If you've been helped before?)</h4>
                                                    <div class="row">
                                                        <div class="col-md-12 form-group">
                                                            <input type="text" name="received_cio_help_year"
                                                                 class="form-control form-control-sm" placeholder="please enter year">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                    
                                    <div class="main-head mt-5">
                                        <h2 class="text-center headline">Information on House Repairs needed:</h2>                                                                      </div>
                    
                                    <div class="border p-3 mt-5" style="border-radius: 10px;">
                                        <div class="row">
                                            {{-- <div class="col-md-6">
                                                <div class="bg-light pl-2 pr-2 mb-3" style="border-radius: 10px;">
                                                    <label class="pl-3">Basic Plumbing &nbsp;&nbsp;<input type="checkbox" name="basic_plumbing[checked]"></label>

                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="bg-light pl-2 pr-2 mb-3" style="border-radius: 10px;">
                                                    <label class="pl-3">Heat/Furnace &nbsp;&nbsp;<input type="checkbox" name="basic_plumbing[checked]"></label>

                                                </div>
                                            </div> --}}
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Basic Plumbing</label>
                                                    <input type="checkbox" name="basic_plumbing[checked]"
                                                         value="y" placeholder="">
                                                    <div>
                                                        <h4 for="">Explain</h4>
                                                        <input type="text" name="basic_plumbing[explain]"
                                                            class="form-control form-control-sm">
                                
                                                        <h4 for="">Do you have running water?</h4>
                                                        <input type="radio" name="basic_plumbing[Do you have running water]"
                                                            value="y" placeholder="">Yes
                                                        <input type="radio" name="basic_plumbing[Do you have running water]"
                                                            value="n" placeholder="">No
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Heat/Furnace</label>
                                                    <input type="checkbox" name="heat_furnace[checked]"
                                                         value="y" placeholder="">
                                                    <div>
                                                        <h4 for="">Explain</h4>
                                                        <input type="text" name="heat_furnace[explain]"
                                                            class="form-control form-control-sm">
                                
                                                        <div>
                                                            <h4 for="">Do you currently have heat?</h4>
                                                            <input type="radio"
                                                                name="heat_furnace[Do you currently have heat]"
                                                                value="y" placeholder="">Yes
                                                            <input type="radio"
                                                                name="heat_furnace[Do you currently have heat]"
                                                                value="n" placeholder="">No
                                                        </div>
                                
                                                        <div>
                                                            <h4 for="">Is your gas shutoff?</h4>
                                                            <input type="radio" name="heat_furnace[Is your gas shutoff]"
                                                                 value="y" placeholder="">Yes
                                                            <input type="radio" name="heat_furnace[Is your gas shutoff]"
                                                                value="n" placeholder="">No
                                                        </div>
                                
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">Electical</label>
                                                    <input type="checkbox" name="basic_electrical"
                                                         value="y" placeholder="">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">Door Windows</label>
                                                    <input type="checkbox" name="doors_and_windows"
                                                         value="y" placeholder="">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">Painting</label>
                                                    <input type="checkbox" name="painting"
                                                         value="y" placeholder="">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">Carpentry</label>
                                                    <input type="checkbox" name="wood_repair"
                                                         value="y" placeholder="">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">Roof /Roofing</label>
                                                    <input type="checkbox" name="roof_patching"
                                                         value="y" placeholder="">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">Gutters</label>
                                                    <input type="checkbox" name="gutters"
                                                         value="y" placeholder="">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">Insulation Weatheriz</label>
                                                    <input type="checkbox" name="insulation_weatherization"
                                                         value="y" placeholder="">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">Wheelch Ramp</label>
                                                    <input type="checkbox" name="wheelchair_ramp"
                                                         value="y" placeholder="">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">Concrete</label>
                                                    <input type="checkbox" name="concrete_patching"
                                                         value="y" placeholder="">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">Other Repairs</label>
                                                    <input type="checkbox" name="other_repairs"
                                                         value="y" placeholder="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-12">
                                            <input type="checkbox" value="y" name="tc_agreed" class="form-check-input"
                                            required> The undersigned fully understands the meaning of the terms of this release
                                        and the undersigned has
                                        freely agreed to be bound by its terms.
                                        </div>
                                    </div>
                                        <div class="row mt-2">
                                            <div class="col-md-4"></div>
                                            <div class="col-md-4">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                            <div class="col-md-4"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script>
        $(document).ready(function() {
            $.ajax({
                type: 'GET',
                url: '{{ url('/getstate') }}',
                dataType: "json",
                contentType: "application/json",
                success: function(res) {
                    $('#state').html('');
                    $('#state').append("<option value=''>Choose State...</option>");
                    $.each(res, function(key, val) {
                        $('#state').append("<option value='" + val['id'] + "'>" + val[
                            'name'] + "</option>");
                    });
                }
            });
        });

        function getcity(obj) {
            $.ajax({
                type: "POST",
                url: '{{ url('/getcity') }}',
                data: JSON.stringify({
                    "_token": "{{ csrf_token() }}",
                    stateid: obj,
                }),
                dataType: "json",
                contentType: "application/json",
                success: function(res) {
                    $('#city').html('');
                    $('#city').append("<option value=''>Choose City...</option>");
                    $.each(res, function(key, val) {
                        $('#city').append("<option value='" + val.id + "'>" + val.name + "</option>");
                    });
                }
            });
        }
    </script>
@endsection
