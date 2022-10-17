@extends('warehouse.layouts.auth')
@section('content')

<div class="container">
    <div class="row justify-content-center">

        <div class="col-xl-7 col-lg-8 col-md-12 col-sm-12">
            <form action="{{url('warehouse/save-register')}}" method="post">
                @csrf
                <div class="crs_log_wrap">
                    <div class="crs_log__thumb">
                        <img src="https://via.placeholder.com/1920x1200" class="img-fluid" alt="" />
                    </div>
                    <div class="crs_log__caption">
                        <div class="rcs_log_123">
                            <div class="rcs_ico"><i class="fas fa-lock"></i></div>
                        </div>

                        <div class="rcs_log_124">
                            <div class="Lpo09">
                                <h4>Register Your Account</h4>
                            </div>
                            <div class="row col-md-12">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" class="form-control" name="name" placeholder="John" />
                                        @error('name') <small class="text-danger">{{$message}}</small> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" class="form-control" name="email" placeholder="support@themezhub.com" />
                                        @error('email') <small class="text-danger">{{$message}}</small> @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row col-md-12">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" class="form-control" name="password" placeholder="*******" />
                                        @error('password') <small class="text-danger">{{$message}}</small> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Confirm Password</label>
                                        <input type="password" class="form-control" name="confirm_password" placeholder="*******" />
                                        @error('confirm_password') <small class="text-danger">{{$message}}</small> @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row col-md-12">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Phone</label>
                                        <input type="text" class="form-control" name="mobile" />
                                        @error('phone') <small class="text-danger">{{$message}}</small> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Organization</label>
                                        <select name="organization" id="" class="form-control">
                                            <option value="">Choose...</option>
                                            @foreach($organization_data as $organizationData)
                                            <option value="{{$organizationData->id}}">{{$organizationData->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('organization') <small class="text-danger">{{$message}}</small> @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn full-width btn-md theme-bg text-white">Register</button><br>
                                <a href="{{url('warehouse/login')}}">Login Here</a>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>


@endsection