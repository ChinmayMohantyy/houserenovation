@extends('admin.layouts.auth')

@section('content')
<div class="page-content">
			<!-- Main content -->
			<div class="content-wrapper">

				<!-- Content area -->
				<div class="content">

					<!-- Simple login form -->
					<form action="{{url('/admin/register-save')}}" method="POST">
						@CSRF 
						<div class="panel panel-body login-form">
							<div class="text-center">
								<div class="icon-object border-slate-300 text-slate-300"><i class="icon-reading"></i></div>
								<h5 class="content-group">Create your account <small class="display-block">Enter your credentials below</small></h5>
								@if(session('failure')) <small class="text-danger">{{session('failure')}}</small> @endif
							</div>

                            <div class="form-group has-feedback has-feedback-left">
								<input type="text" class="form-control" name="name"  placeholder="someone">
								<div class="form-control-feedback">
									<i class="icon-user text-muted"></i>
								</div>
							</div>

							<div class="form-group has-feedback has-feedback-left">
								<input type="text" class="form-control" name="email" value="{{old('email')}}" placeholder="someone@example.com">
								<div class="form-control-feedback">
									<i class="icon-user text-muted"></i>
								</div>
								@error('email') <small class="text-danger">{{$message}}</small> @enderror
							</div>

							<div class="form-group has-feedback has-feedback-left">
								<input type="password" class="form-control" name="password" placeholder="Password">
								<div class="form-control-feedback">
									<i class="icon-lock2 text-muted"></i>
								</div>
								@error('password') <small class="text-danger">{{$message}}</small> @enderror
							</div>

							<div class="form-group">
								<button type="submit" class="btn bg-pink-400 btn-block">Sign in <i class="icon-circle-right2 position-right"></i></button>
							</div>

							<div class="text-center">
								<!-- <a href="login_password_recover.html">Forgot password?</a> -->
							</div>
						</div>
					</form>
					<!-- /simple login form -->


					<!-- Footer -->
					<div class="footer text-muted text-center">
						&copy; 2022 <a href="#">&copy All Rights reserved.</a> by <a href="#" target="_blank">Houserenovation</a>
					</div>
					<!-- /footer -->

				</div>
				<!-- /content area -->

			</div>
			<!-- /main content -->

		</div>
@endsection


