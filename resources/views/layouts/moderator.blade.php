<!DOCTYPE html>
<html>
<head>
<title>@yield('title')</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="theme-color" content="#000084" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="{{asset('css/moderator.css')}}" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div class="container-fluid">
	    <div class="row">
            @yield('content')
            @include('layouts.footer')
        </div>
    </div> 
    @yield('modals')
    <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('js/moderator.js')}}"></script>
    
</body>
 </html>