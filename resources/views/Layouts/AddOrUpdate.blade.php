<!DOCTYPE html>
<html lang="en">
<head>
	<title>@yield('title','Unknown')</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">	
	<link rel="stylesheet" type="text/css" href="{{url('vendor/bootstrap/css/bootstrap.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{url('fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{url('fonts/iconic/css/material-design-iconic-font.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{url('vendor/animate/animate.css')}}">	
	<link rel="stylesheet" type="text/css" href="{{url('vendor/css-hamburgers/hamburgers.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{url('vendor/animsition/css/animsition.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{url('vendor/select2/select2.min.css')}}">	
	<link rel="stylesheet" type="text/css" href="{{url('vendor/daterangepicker/daterangepicker.css')}}">
	<link rel="stylesheet" type="text/css" href="{{url('css1/util.css')}}">
	<link rel="stylesheet" type="text/css" href="{{url('css1/main.css')}}">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url('/images/bg-01.jpg');">
			<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
                @yield('content')		
	<script src="{{url('vendor/jquery/jquery-3.2.1.min.js')}}"></script>
	<script src="{{url('vendor/animsition/js/animsition.min.js')}}"></script>
	<script src="{{url('vendor/bootstrap/js/popper.js')}}"></script>
	<script src="{{url('vendor/bootstrap/js/bootstrap.min.js')}}"></script>
	<script src="{{url('vendor/select2/select2.min.js')}}"></script>
	<script src="{{url('vendor/daterangepicker/moment.min.js')}}"></script>
	<script src="{{url('vendor/daterangepicker/daterangepicker.js')}}"></script>
	<script src="{{url('vendor/countdowntime/countdowntime.js')}}"></script>
	<script src="{{url('js1/main.js')}}"></script>
</body>
</html>