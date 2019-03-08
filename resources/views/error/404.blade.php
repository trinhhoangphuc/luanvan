<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="icon" type="images/jpg" sizes="16x16" href="{{asset('public/images/layouts/logo3.png')}}">
	<title>error 404</title>

	

	<!-- JQuery -->
	<script src="{{asset('public/libs/vendor/jquery/jquery-3.3.1.min.js')}}"></script>

	<!-- Bootstrap 3 css -->
	<link rel="stylesheet" type="text/css" href="{{asset('public/libs/vendor/bootstrap/css/bootstrap.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('public/libs/vendor/bootstrap/css/bootstrap-theme.min.css')}}">
	<script src="{{asset('public/libs/vendor/bootstrap/js/bootstrap.min.js')}}"></script>

	<!-- Fontawesome -->
	<link rel="stylesheet" type="text/css" href="{{asset('public/libs/vendor/fontawesome/css/all.min.css')}}">

	<!-- font-awsome js -->
	<script src="{{asset('public/libs/vendor/fontawesome/js/all.min.js')}}"></script>
	<link href="https://fonts.googleapis.com/css?family=Sawarabi+Gothic" rel="stylesheet"> 

	<link rel="stylesheet" type="text/css" href="{{asset('public/css/style-customer.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('public/css/responsive.css')}}">


</head>
<body style="background-color: #fff;">

	<div class="container">
		<div class="row">
			<div class="col-sm-3"></div>
			<div class="col-sm-6">
				<img src="{{asset('public/images/layouts/404-page.gif')}}" class="responsive" width="100%">
				<div class="error_404">
					<h2>Oops! Something went wrong</h2>
					<p>We couldn't find the page you were looking for</p>
					<p>Why not try back to the <a href="{{route('homepage')}}">homepage.</a></p>
				</div>
			</div>
			<div class="col-sm-3"></div>
		</div>
	</div>

</body>
</html>