<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="csrf-token" content="{{ csrf_token()}}"/>

	<link rel="icon" type="image/png" sizes="16x16" href="{{asset('public/images/layouts/logo2.png')}}">
	<title>Đăng nhập - Quản trị Redshop.vn</title>

	<!--bootstrap-->
	<link href="{{asset('public/css/lib/bootstrap/bootstrap.min.css')}}" rel="stylesheet">

	<!--jquery-->
	<script src="{{asset('public/js/lib/jquery/jquery.min.js')}}"></script>

	<!-- Bootstrap tether Core JavaScript -->
	<script src="{{asset('public/js/lib/bootstrap/js/popper.min.js')}}"></script>
	<script src="{{asset('public/js/lib/bootstrap/js/bootstrap.min.js')}}"></script>

	<!--jquery validate-->
	<script src="{{asset('public/libs/jquery-validate/jquery.validate.min.js')}}"></script>

	<link href="{{asset('public/css/login_admin.css')}}" rel="stylesheet">
	<style type="text/css" media="screen">
		html, body{
			width: 100%;
			height: 100%;
		}
		.error{
			color: red;
		}
	</style>
</head>
<body>

	<div class="container h-100">
		<div class="d-flex justify-content-center h-100">
			<div class="user_card">
				<div class="d-flex justify-content-center">
					<div class="brand_logo_container">
						<img src="{{asset('public/images/layouts/logo.jpg')}}" class="brand_logo" alt="Logo">
					</div>
				</div>
				<br/><br/>
				<div class="login-content">
					<form name="login-admin" id="login-admin" method="POST">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<div class="form-group">
								<label for="email"><b>Email:</b></label>
								<input type="email" class="form-control" id="email" name="email" placeholder="Nhập địa chỉ email">
							</div>
							<div class="form-group">
								<label for="pwd"><b>Mật khẩu:</b></label>
								<input type="password" class="form-control" id="pwd" name="pwd" placeholder="Nhập mật khẩu">
							</div>
							<div class="form-group">
								<span id="errorLogin" class="error"></span>
							</div>
							<button type="submit" class="btn login_btn border-radis-none btn-block">Đăng nhập</button>
						</form>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
<script type="text/javascript">
	$(document).ready(function(){

		$("#login-admin").validate({ 
			rules: {
				email: {   
					required: true,
					email:true,
				},
				pwd:{
					required: true,
				}
			}, 
			messages: {
				email: {
					required: "Xin vui lòng nhập email!",
					email: "email không đúng định dạng!"
				},
				pwd: {
					required: "Xin vui lòng nhập mật khẩu!",
				}
			},
			submitHandler: function(form) {
				$.ajax({
					type: "POST", 
					url: "{{ route('postlogin') }}", 
					data: {
						'email' : $('#email').val(),
						'pwd'   : $('#pwd').val(),
					},
					headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
					success: function(data){ 
						if(data.message == true)
							location.reload();
						else 
							$("#errorLogin").text("Email hoặc mật khẩu không chính xác").show().fadeOut( 7000 );
					}
				});
			}
		});
	})
</script>