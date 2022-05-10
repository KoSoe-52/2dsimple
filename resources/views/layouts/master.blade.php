<!DOCTYPE html>
<html lang="en">

<head>
    <title>@yield('title')</title>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="" />
    <meta name="keywords" content="">
    <meta name="author" content="itBrother" />
    <!-- Favicon icon -->
    <link rel="icon" href="{{asset('assets/images/logo.png')}}" type="image/x-icon">
    <!-- vendor css -->
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
</head>
<body class="bg-info">
	<div class="loader-bg ">
		<div class="loader-track">
			<div class="loader-fill"></div>
		</div>
	</div>
	<!-- [ Pre-loader ] End -->
	<!-- [ navigation menu ] start -->
	<nav class="pcoded-navbar menu-light ">
		<div class="navbar-wrapper  ">
			<div class="navbar-content scroll-div " >
				
				<div class="">
					<div class="main-menu-header">
						<img class="img-radius" src="{{asset('assets/images/logo.png')}}" alt="User-Profile-Image">
						<div class="user-details">
							<div id="more-details">2D/3D <i class="fa fa-caret-down"></i></div>
						</div>
					</div>
				</div>
				<ul class="nav pcoded-inner-navbar ">
					<li class="nav-item pcoded-menu-caption">
					    <label>Menu lists</label>
					</li>
					<li class="nav-item"><a href="{{url('/users')}}">Member List</a></li>
				</ul>
			</div>
		</div>
	</nav>
	<!-- [ navigation menu ] end -->
	<!-- [ Header ] start -->
	<header class="navbar pcoded-header navbar-expand-lg navbar-light header-blue ">

				<div class="m-header">
					<a class="mobile-menu" id="mobile-collapse" href="#!"><span></span></a>
					<a href="#!" class="mob-toggler offset-2">
						<i class="feather icon-more-vertical"></i>
					</a>
				</div>
				<div class="collapse navbar-collapse">
					<ul class="navbar-nav ml-auto">
						
						<li>
							<div class="dropdown drp-user">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									<i class="feather icon-user"></i>
								</a>
								<div class="dropdown-menu dropdown-menu-right profile-notification">
									<div class="pro-head">
										<img src="{{asset('assets/images/user/avatar-5.jpg')}}" class="img-radius" alt="User-Profile-Image">
										<span>{{Auth::user()->name}}( {{Auth::user()->roles->name}} )</span>
										<a href="{{ route('logout') }}" class="dud-logout" title="Logout">
											<i class="feather icon-log-out"></i>
										</a>
									</div>
									<ul class="pro-body">
										<!--<li><a href="user-profile.html" class="dropdown-item"><i class="feather icon-user"></i> Profile</a></li>
										<li><a href="email_inbox.html" class="dropdown-item"><i class="feather icon-mail"></i> My Messages</a></li>-->
										<li>
											<a href="{{ route('logout') }}" class="dropdown-item"
												onclick="event.preventDefault();
												document.getElementById('logout-form').submit();">
												
												<i class="feather icon-lock"></i> 
												LogOut
											</a>
											<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
												@csrf
											</form>
										</li>
									</ul>
								</div>
							</div>
						</li>
					</ul>
				</div>
				
			
	</header>
	<!-- [ Header ] end -->
	
	

<!-- [ Main Content ] start -->
<div class="pcoded-main-container ">
    <div class="pcoded-content ">
        <!-- [ breadcrumb ] start -->
        <div class="page-header ">
                <div class="row">
                    @yield('header')
                </div>
        </div>
        <!-- [ breadcrumb ] end -->

        <!-- [ Main Content ] start -->
        <div class="row">
        
            <div class="col-12 p-0">
                @yield('content')   
            </div>                     
                
        </div>
        <!-- [ Main Content ] end -->
    </div>
</div>
<!-- [ Main Content ] end -->
    

    <!-- Required Js -->
    <script src="{{asset('assets/js/vendor-all.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/bootstrap.min.js')}}"></script>
    <!-- <script src="assets/js/ripple.js"></script-->
    <script src="{{asset('assets/js/pcoded.min.js')}}"></script>

<!-- Apex Chart -->
<script src="{{asset('assets/js/plugins/apexcharts.min.js')}}"></script>


<!-- custom-chart js -->
<script src="{{asset('assets/js/pages/dashboard-main.js')}}"></script>
</body>

</html>
