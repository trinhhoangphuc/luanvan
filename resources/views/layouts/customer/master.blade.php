<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token()}}"/>

	<link rel="icon" type="images/jpg" sizes="16x16" href="{{asset('public/images/layouts/logo2.png')}}">
	<title>RedShop.vn</title>

	<!-- Bootstrap 3 css -->
	<link rel="stylesheet" type="text/css" href="{{asset('public/libs/vendor/bootstrap/css/bootstrap.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('public/libs/vendor/bootstrap/css/bootstrap-theme.min.css')}}">

	<!-- font-awsome css -->
	<link rel="stylesheet" type="text/css" href="{{asset('public/libs/vendor/fontawesome/css/all.min.css')}}">

	<!-- Jquery -->
	<script src="{{asset('public/libs/vendor/jquery/jquery-3.3.1.min.js')}}"></script>


	<link rel="stylesheet" href="{{asset('public/libs/vendor/Product-Gallery-Image-Zoom/css/main.css')}}">
   	<link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
	<!-- Bootstrap 3 js -->
	<script src="{{asset('public/libs/vendor/bootstrap/js/bootstrap.min.js')}}"></script>

	<!-- font-awsome js -->
	<script src="{{asset('public/libs/vendor/fontawesome/js/all.min.js')}}"></script>

	<link href="https://fonts.googleapis.com/css?family=Sawarabi+Gothic" rel="stylesheet"> 

	<!--zoom img -->
	<script src="{{asset('public/libs/vendor/Product-Gallery-Image-Zoom/scripts/zoom-image.js')}}"></script>
	

	<!-- Custom css -->
	<link rel="stylesheet" type="text/css" href="{{asset('public/css/style-customer.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('public/css/responsive.css')}}">


</head>
<body>
	@include("layouts.customer.header")

	<section>
		<br/>
		<div class="container ">
			@yield('content')
		</div>

	</section>

	@include("layouts.customer.footer")
</body>
</html>
<script type="text/javascript">
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
<script src="{{asset('public/libs/vendor/Product-Gallery-Image-Zoom/scripts/main.js')}}"></script>