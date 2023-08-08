<!DOCTYPE html>
<html lang="en">
<head>
  <title>Manajemen Cuti - Forgot</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
  <link rel="icon" href="{{ asset('img/logo_new.png') }}" type="image/x-icon" />
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('login/vendor/bootstrap/css/bootstrap.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('login/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('login/fonts/Linearicons-Free-v1.0.0/icon-font.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('login/vendor/animate/animate.css')}}">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{asset('login/vendor/css-hamburgers/hamburgers.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('login/vendor/animsition/css/animsition.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('login/vendor/select2/select2.min.css')}}">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{asset('login/vendor/daterangepicker/daterangepicker.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('login/css/util.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('login/css/main.css')}}">
<!--===============================================================================================-->
</head>
<body style="background-color: #666666;">
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form" action="{{route('forgot.updatepass')}}" method="post">
					{{ csrf_field() }}
					<div class="row justify-content-center">
						<div class="col-md-8">
							<center>
								<img src="{{ asset('img/logo_new.png') }}" width="40%" alt="">
								<span class="login100-form-title p-b-43">
									Forgot Password
								</span>
							</center>
						</div>
					</div>
					
					
					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="email" name="email" autofocus required>
						<span class="focus-input100"></span>
						<span class="label-input100">Email</span>
					</div>
					
					
					<div class="wrap-input100 validate-input" data-validate="Password is required">
						<input class="input100" type="password" name="password" id="password" required>
						<span class="focus-input100"></span>
						<span class="label-input100">Password</span>
					</div>


					<div class="wrap-input100 validate-input" data-validate="Password is required">
						<input class="input100" type="password" name="repassword" id="repassword" required>
						<span class="focus-input100"></span>
						<span class="label-input100">Re Password</span>
					</div>

					<div class="flex-sb-m w-full p-t-3 p-b-32">

						<div>
							<a href="{{route('login.index')}}" class="txt1">
								<i>Back To Login</i>
							</a>
						</div>
					</div>
			

					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Change Password
						</button>
					</div>

					
				</form>

				<div class="login100-more">
				</div>
			</div>
		</div>
	</div>
	@include('layouts.js')
<!--===============================================================================================-->
	<script src="{{asset('login/vendor/jquery/jquery-3.2.1.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('login/vendor/animsition/js/animsition.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('login/vendor/bootstrap/js/popper.js')}}"></script>
	<script src="{{asset('login/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('login/vendor/select2/select2.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('login/vendor/daterangepicker/moment.min.js')}}"></script>
	<script src="{{asset('login/vendor/daterangepicker/daterangepicker.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('login/vendor/countdowntime/countdowntime.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('js/main.js')}}"></script>
</body>
@if(Session::has('success'))
    <script type="text/javascript">
    swal({
        icon: 'success',
        text: '{{Session::get("success")}}',
        button: false,
        timer: 1500
    });
    </script>
    <?php
        Session::forget('success');
    ?>
    @endif
    @if(Session::has('gagal'))
    <script type="text/javascript">
    swal({
        icon: 'error',
        title: 'Change Password Failed!',
        button: false,
        text: '{{Session::get("gagal")}}',
        timer: 1500
    });
    </script>
    <?php
        Session::forget('gagal');
    ?>
@endif
</html>