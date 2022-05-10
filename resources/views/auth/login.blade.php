<!DOCTYPE html>
<html lang="en">

<head>

	<title>Signin</title>
	
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="description" content="" />
	<meta name="keywords" content="">
	<meta name="author" content="itBrother" />
	<!-- Favicon icon -->
	<link rel="icon" href="{{asset('assets/images/favicon.ico')}}" type="image/x-icon">

	<!-- vendor css -->
	<link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
</head>

<!-- [ auth-signin ] start -->
<div class="auth-wrapper">
	<div class="auth-content">
		<div class="card">
			<div class="row align-items-center text-center">
				<div class="col-md-12">
					<div class="card-body">
					<p style="color:green;">{{Auth::logout()}} </p>
                                @error('error')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        <form method="POST" action="{{ route('login') }}">
							@csrf
							<img src="{{asset('assets/images/adlogo.png')}}" alt="" class="img-fluid mb-4">
							<h3 class="mb-3 f-w-400 text-c-green">SignIn</h3>
							<div class="form-group mb-3">
								<label class="floating-label text-dark" for="login">Username</label>
								<input id="login" type="text"
									class="form-control{{ $errors->has('name') || $errors->has('email') ? ' is-invalid' : '' }}"
									name="login" value="{{ old('name') ?: old('email') }}"  required>
									@if ($errors->has('name') || $errors->has('email'))
										<span class="invalid-feedback" role="alert">
											<strong>{{ $errors->first('name') ?: $errors->first('email') }}</strong>
										</span>
									@endif
							</div>
							<div class="form-group mb-4">
								<label class="floating-label text-dark" for="Password">Password</label>
								<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="off">
									@error('password')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
							</div>
							<div class="custom-control custom-checkbox text-left mb-4 mt-2">
								<input type="checkbox" class="custom-control-input" id="customCheck1">
								<!-- <label class="custom-control-label" for="customCheck1">Save credentials.</label> -->
							</div>
							
							<div><button type="submit" class="btn btn-block btn-primary mb-4">Signin</button></div>
							</form>
							<!-- <p class="mb-2 text-muted">Forgot password? <a href="{{url('/login')}}" class="f-w-400">Reset</a></p>
							<p class="mb-0 text-muted">Don’t have an account? <a href="{{url('/logout')}}" class="f-w-400">Signup</a></p>
                         -->
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- [ auth-signin ] end -->

<!-- Required Js -->
<script src="{{asset('assets/js/vendor-all.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/bootstrap.min.js')}}"></script>
<!--<script src="{{asset('assets/js/ripple.js')}}"></script> -->
<script src="{{asset('assets/js/pcoded.min.js')}}"></script> 



</body>

</html>
