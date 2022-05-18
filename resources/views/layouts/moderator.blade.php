<!DOCTYPE html>
<html>
<head>
<title>@yield('title')</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="theme-color" content="#000084" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="description" content="" />
<meta name="keywords" content="">
<meta name="author" content="itBrother" />
<!-- Favicon icon -->
<link rel="icon" href="{{asset('assets/images/logo.png')}}" type="image/x-icon">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="{{asset('css/moderator.css')}}" rel="stylesheet">
<link rel="stylesheet" href="{{asset('css/load.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 @yield('style')
</head>
<body>
    <div class="loader-bg">
		<div class="loader-track">
			<div class="loader-fill"></div>
		</div>
	</div>
    <div class="container-fluid">
	    <div class="row">
            @yield('content')
            @include('layouts.footer')
        </div>
    </div> 
    @yield('modals')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('js/moderator.js')}}"></script>
    <script src="{{asset('assets/js/pcoded.min.js')}}"></script>

    @yield('script')
</body>
 </html>