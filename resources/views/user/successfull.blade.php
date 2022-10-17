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
<div class="container-fluid mt-5">
    <div class="row">
        <div class="col-lg-8 offset-2">
            <div class="card shadow">
                <div class="card-body">
                        <div class="box">                                                                                                                                                                          
                            <div class="container">

                        <center><img src="{{asset('images/field_assistant/submit.png')}}" alt="" style="height: 102px;"></center>
                        <h1><center>Thank you! Your house repair request submited, our team will contact you soon.</center></h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>
@endsection