@extends('warehouse.layouts.auth')
@section('content')
@if (session()->has('message'))
        <div class="alert alert-danger">
            {{ session()->get('message') }}
        </div>
    @endif
<div class="container">
    <div class="row justify-content-center">

        <div class="col-xl-7 col-lg-8 col-md-12 col-sm-12">
            <form action="{{url('warehouse/login')}}" method="post">
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
                                <h4>Login Your Account</h4>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" class="form-control" name="email" placeholder="support@themezhub.com" />
                                @error('email') <small class="text-danger">{{$message}}</small> @enderror
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" name="password" placeholder="*******" />
                                @error('password') <small class="text-danger">{{$message}}</small> @enderror
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn full-width btn-md theme-bg text-white">Login</button>
                                <a href="{{url('/warehouse/register')}}">Register Here</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>
@endsection