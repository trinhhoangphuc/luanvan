<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token()}}"/>

	<link rel="icon" type="images/jpg" sizes="16x16" href="{{asset('public/images/layouts/logo2.png')}}">
	<title>@yield("tieude")</title>

	<!-- Bootstrap 3 css -->
	<link rel="stylesheet" type="text/css" href="{{asset('public/libs/vendor/bootstrap/css/bootstrap.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('public/libs/vendor/bootstrap/css/bootstrap-theme.min.css')}}">

	<!-- font-awsome css -->
	<link rel="stylesheet" type="text/css" href="{{asset('public/libs/vendor/fontawesome/css/all.min.css')}}">

	<!-- Jquery -->
	<script src="{{asset('public/libs/vendor/jquery/jquery-3.3.1.min.js')}}"></script>


	<link rel="stylesheet" href="{{asset('public/libs/vendor/Product-Gallery-Image-Zoom/css/main.css')}}">
   	<!-- <link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css"> -->
	<!-- Bootstrap 3 js -->
	<script src="{{asset('public/libs/vendor/bootstrap/js/bootstrap.min.js')}}"></script>

	<!-- font-awsome js -->
	<script src="{{asset('public/libs/vendor/fontawesome/js/all.min.js')}}"></script>

	<link href="https://fonts.googleapis.com/css?family=Sawarabi+Gothic" rel="stylesheet"> 

	<!--zoom img -->
	<script src="{{asset('public/libs/vendor/Product-Gallery-Image-Zoom/scripts/zoom-image.js')}}"></script>
	
	<link rel="stylesheet" type="text/css" href="{{asset('public/libs/vendor/bootstrap-rating/bootstrap-rating.css')}}">
	
	<script src="{{asset('public/libs/vendor/bootstrap-rating/bootstrap-rating.js')}}"></script>

	<!-- angularjs -->
	<script src="{{asset('public/libs/angular-1.6.10/angular.min.js')}}"></script>
     
    <link rel="stylesheet" href="{{asset('public/libs/angular-1.6.10/docs/css/angular-material.min.css')}}">
    <script src="{{asset('public/libs/angular-1.6.10/angular-animate.min.js')}}"></script>
    <script src="{{asset('public/libs/angular-1.6.10/angular-aria.min.js')}}"></script>
    <script src="{{asset('public/libs/angular-1.6.10/angular-messages.min.js')}}"></script>
    <script src="{{asset('public/libs/angular-1.6.10/angular-material.min.js')}}"></script>

    <link href="{{asset('public/css/lib/toastr/toastr.min.css')}}" rel="stylesheet">
	<script src="{{asset('public/js/lib/toastr/toastr.min.js')}}"></script>
    <script src="{{asset('public/js/lib/toastr/toastr.init.js')}}"></script>

	<script src="{{asset('public/libs/jquery-validate/jquery.validate.min.js')}}"></script>

    <script src="{{asset('public/App/app.js')}}"></script>
    <script src="{{asset('public/App/HomepageController.js')}}"></script>

	<!-- Custom css -->
	<link rel="stylesheet" type="text/css" href="{{asset('public/css/style-customer.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('public/css/responsive.css')}}">


</head>
<body ng-app="homepageredshop" ng-controller="HomepageController">
	@include("layouts.customer.header")

	<section>
		@yield('banner')
		<br/>
		<div class="container ">
			@yield('content')
		</div>

	</section>

	@include("layouts.customer.footer")
</body>
</html>
<script type="text/javascript">
	$(document).ready(function () {
		$('.rating').rating();
	});

	$(window).scroll(function () {
		if ($(this).scrollTop() > 50) {
			$('#back-to-top').fadeIn();
		} else {
			$('#back-to-top').fadeOut();
		}
	});

	$('#back-to-top').click(function () {
		$('#back-to-top').tooltip('hide');
		$('body,html').animate({
			scrollTop: 0
		}, 800);
		return false;
	});

	$('#back-to-top').tooltip('show');

	$(function(){
		$('.box-hidden').slice(0, 4).show();

		$('#loadmore').on('click', function(e){

			e.preventDefault();

			$('.box-hidden:hidden').slice(0, 4).slideDown();

			if( $('.box-hidden:hidden').length == 0 ){
				$("#loadmore").fadeOut('slow');
			}

		});
	});
</script>
<script>
	window.onscroll = function() {myFunction()};

	var navbar = document.getElementById("header-bottom");
	var sticky = navbar.offsetTop;

	function myFunction() {
		if (window.pageYOffset >= sticky) {
			navbar.classList.add("sticky")
		} else {
			navbar.classList.remove("sticky");
		}
	}

	
</script>
<script src="{{asset('public/libs/vendor/Product-Gallery-Image-Zoom/scripts/main.js')}}"></script>