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
	<link rel="stylesheet" href="{{asset('public/libs2/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="{{asset('public/libs2/bower_components/font-awesome/css/font-awesome.min.css')}}">

	<!-- jQuery 3 -->
	<script src="{{asset('public/libs2/bower_components/jquery/dist/jquery.min.js')}}"></script>

	<!-- Bootstrap 3.3.7 -->
	<script src="{{asset('public/libs2/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>

	<!--jquery validate-->
	<script src="{{asset('public/libs/jquery-validate/jquery.validate.min.js')}}"></script>

	<link href="{{asset('public/css/login-admin-2.css')}}" rel="stylesheet">
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
	<div class="container">
		<div class="row">
			<div class="col-sm-3"></div>
			<div class="col-sm-6">
				<div class="login-form">
					<div class="title">Đăng nhập</div>
					<p class="title-2">
						Vui lòng sử dụng tài khoản, mật khẩu mà chúng tôi đã cung cấp cho bạn để đăng nhập vào hệ thống.
					</p>
					<hr class="custom-hr" />
					<form name="login-admin" id="login-admin" method="POST">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="form-group">
							<label for="email"><b>Email:</b></label>
							<input type="email" class="form-control none-border-radius" id="email" name="email" placeholder="Nhập địa chỉ email">
						</div>
						<div class="form-group">
							<label for="pwd"><b>Mật khẩu:</b></label>
							<input type="password" class="form-control none-border-radius" id="pwd" name="pwd" placeholder="Nhập mật khẩu">
						</div>
						<div class="form-group">
							<span id="errorLogin" class="error"></span>
						</div>
						<hr class="custom-hr" />
						<button type="submit" class="btn none-border-radius btn-block btn-login">Đăng nhập</button>
					</form>
				</div>
			</div>
			<div class="col-sm-3"></div>
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