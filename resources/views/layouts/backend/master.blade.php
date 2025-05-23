<!DOCTYPE html>
<html lang="en">



<head>
    <meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<title>Workmarket</title>
<link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon.ico') }}">

<!-- Google Material Icons -->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<!-- CSS Files -->
<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
@stack('styles')
    <!--[if lt IE 9]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
	<![endif]-->
</head>

<body>
    @yield('after-body')
    <div class="main-wrapper">
        
         @include('backend.header')
        
        @include('backend.sidebar')
        <div class="page-wrapper">
            <div class="content">
                @yield('page-content')
            </div>
            @include('backend.message')
        </div>
    </div>
    <div class="sidebar-overlay" data-reff=""></div>
   <!-- Core JS Libraries -->
<script src="{{ asset('assets/js/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('assets/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

<!-- Plugins -->
<script src="{{ asset('assets/js/jquery.slimscroll.js') }}"></script>
<script src="{{ asset('assets/js/Chart.bundle.js') }}"></script>
<script src="{{ asset('assets/js/chart.js') }}"></script>
@stack('scripts')
<!-- Custom App Script -->
<script src="{{ asset('assets/js/app.js') }}"></script>


</body>



</html>