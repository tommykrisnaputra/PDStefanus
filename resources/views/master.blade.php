<!DOCTYPE html>
<html>

	<head>
		<title>PD Stefanus</title>
		<meta property="og:title" content="PD Stefanus Grogol" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta charset="utf-8" />
		<meta property="twitter:card" content="summary_large_image" />
		<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
		<meta name="csrf-token" content="{{ csrf_token() }}">

		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
			integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
		<link type="icon/png" href="images/logo.png" rel="shortcut icon" sizes="32x32" />
		<link data-tag="font"
			href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
			rel="stylesheet" />

		<link href="{{ asset('css/style.css') }}" rel="stylesheet">
		<link href="{{ asset('css/index.css') }}" rel="stylesheet">
		<link href="{{ asset('css/toast.css') }}" rel="stylesheet">
		<link href="{{ asset('css/alert.css') }}" rel="stylesheet">

		@section('css')
		@show
	</head>

	<body>
		<div class="home-top-container">
			@include('navbar')
			@include('toast')
			@yield('home-message')
		</div>

		<div class="home-container">
			@yield('content')
		</div>

		@section('js')
			<script src="https://kit.fontawesome.com/d548bf050f.js" crossorigin="anonymous"></script>
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
			<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
				integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
			</script>
		@show
	</body>

</html>
