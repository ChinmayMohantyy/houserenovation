<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="utf-8" />
    <meta name="author" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Houserenovation - Housecaptain</title>

    <!-- Custom CSS -->
    <link href="{{asset('assets/warehouse/assets/css/styles.css')}}" rel="stylesheet">

</head>

<body>

    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">

        <!-- ============================================================== -->
        <!-- Top header  -->
        <!-- ============================================================== -->
        <!-- Start Navigation -->
        <div class="header header-light">
            @include('housecaptain.layouts.header')
        </div>
        <!-- End Navigation -->
        <div class="clearfix"></div>
        <!-- ============================================================== -->
        <!-- Top header  -->
        <!-- ============================================================== -->

        <!-- ============================ Dashboard: Dashboard Start ================================== -->
        <section class="gray pt-4">
            <div class="container-fluid">

                <div class="row">

                    <div class="col-lg-3 col-md-3">
                       
                        @include('housecaptain.layouts.sidebar')
                    </div>

                    <div class="col-lg-9 col-md-9 col-sm-12">

                        <!-- Row -->
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 pb-4">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                        <!-- /Row -->

                       @yield('content')

                        <!-- Row -->
                       
                

                    </div>

                </div>

            </div>
        </section>

        <!-- Log In Modal -->
        <div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="loginmodal" aria-hidden="true">
            <div class="modal-dialog modal-xl login-pop-form" role="document">
                <div class="modal-content overli" id="loginmodal">
                    <div class="modal-header">
                        <h5 class="modal-title">Login Your Account</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><i class="fas fa-times-circle"></i></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="login-form">
                            <form>

                                <div class="form-group">
                                    <label>User Name</label>
                                    <div class="input-with-icon">
                                        <input type="text" class="form-control" placeholder="User or email">
                                        <i class="ti-user"></i>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Password</label>
                                    <div class="input-with-icon">
                                        <input type="password" class="form-control" placeholder="*******">
                                        <i class="ti-unlock"></i>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-xl-4 col-lg-4 col-4">
                                        <input id="admin" class="checkbox-custom" name="admin" type="checkbox">
                                        <label for="admin" class="checkbox-custom-label">Admin</label>
                                    </div>
                                    <div class="col-xl-4 col-lg-4 col-4">
                                        <input id="student" class="checkbox-custom" name="student" type="checkbox"
                                            checked>
                                        <label for="student" class="checkbox-custom-label">Student</label>
                                    </div>
                                    <div class="col-xl-4 col-lg-4 col-4">
                                        <input id="instructor" class="checkbox-custom" name="instructor"
                                            type="checkbox">
                                        <label for="instructor" class="checkbox-custom-label">Tutors</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button type="submit"
                                        class="btn btn-md full-width theme-bg text-white">Login</button>
                                </div>

                                <div class="rcs_log_125 pt-2 pb-3">
                                    <span>Or Login with Social Info</span>
                                </div>
                                <div class="rcs_log_126 full">
                                    <ul class="social_log_45 row">
                                        <li class="col-xl-4 col-lg-4 col-md-4 col-4"><a href="javascript:void(0);"
                                                class="sl_btn"><i class="ti-facebook text-info"></i>Facebook</a></li>
                                        <li class="col-xl-4 col-lg-4 col-md-4 col-4"><a href="javascript:void(0);"
                                                class="sl_btn"><i class="ti-google text-danger"></i>Google</a></li>
                                        <li class="col-xl-4 col-lg-4 col-md-4 col-4"><a href="javascript:void(0);"
                                                class="sl_btn"><i class="ti-twitter theme-cl"></i>Twitter</a></li>
                                    </ul>
                                </div>

                            </form>
                        </div>
                    </div>
                    <div class="crs_log__footer d-flex justify-content-between mt-0">
                        <div class="fhg_45">
                            <p class="musrt">Don't have account? <a href="signup.html" class="theme-cl">SignUp</a></p>
                        </div>
                        <div class="fhg_45">
                            <p class="musrt"><a href="forgot.html" class="text-danger">Forgot Password?</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Modal -->

        <a id="back2Top" class="top-scroll" title="Back to top" href="#"><i class="ti-arrow-up"></i></a>


    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->

    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/popper.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/select2.min.js')}}"></script>
    <script src="{{asset('js/slick.js')}}"></script>
    <script src="{{asset('js/moment.min.js')}}"></script>
    <script src="{{asset('js/daterangepicker.js')}}"></script>
    <script src="{{asset('js/summernote.min.js')}}"></script>
    <script src="{{asset('js/metisMenu.min.js')}}"></script>
    <script src="{{asset('js/custom.js')}}"></script>

    <!-- Morris.js charts -->
    <script src="{{asset('js/raphael.min.js')}}"></script>
    <script src="{{asset('js/morris.min.js')}}"></script>

    <!-- Custom Morrisjs JavaScript -->
    <script src="{{asset('js/morris.js')}}"></script>
    <!-- ============================================================== -->
    <!-- This page plugins -->
    <!-- ============================================================== -->
    @yield('scripts')

</body>

</html>