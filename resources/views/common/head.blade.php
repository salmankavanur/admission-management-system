<head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta property="og:title" content="Admission Management System" >
     <meta property="og:description" content="Admission Management System">
	<meta property="og:image" content="social-image.html" >
	<meta name="format-detection" content="telephone=no">
	<meta name="csrf-token" content="{{ csrf_token() }}" />

	<!-- Mobile Specific -->
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Page Title Here -->
	<title>{{ config('app.name') }} | @yield('title')</title>

<!-- FAVICONS ICON -->
    <link rel="shortcut icon" type="image/png" href="images/favicon.png" >
	<link href="{{ asset('vendor/wow-master/css/libs/animate.css') }}" rel="stylesheet">
	<link href="{{ asset('vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('vendor/bootstrap-select-country/css/bootstrap-select-country.min.css') }}">
	<link rel="stylesheet" href="{{ asset('vendor/jquery-nice-select/css/nice-select.css') }}">
	<link href="{{ asset('vendor/datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet">


	{{-- <link href="{{ asset('vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet"> --}}
	<!--swiper-slider-->
	<link rel="stylesheet" href="{{ asset('vendor/swiper/css/swiper-bundle.min.css') }}">
	<!-- Style css -->
	<link href="{{ asset('https://fonts.googleapis.com/css2?family=Material+Icons') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.0/css/buttons.dataTables.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/2.0.1/css/dataTables.dataTables.css">
	
	

</head>

