<header>
	<div class="header">
		<div class="main-header">
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="logo text-center">
							<a href=""><img src="{{asset('public/images/layouts/logo.png')}}" class="img-responsive" /></a>
						</div>
					</div>
					<div class="col-sm-8">
						<div class="col-sm-4 ">
							<div class="cart hidden-xs">
								<div class="icon ">
									<a href=""><img src="{{asset('public/images/layouts/facebook1.png')}}"></a>
								</div>
								<div class="icon ">
									<a href=""><img src="{{asset('public/images/layouts/twitter.png')}}"></a>
								</div>
								<div class="icon ">
									<a href=""><img src="{{asset('public/images/layouts/google-plus.png')}}"></a>
								</div>
							</div>
						</div>
						<div class="col-sm-8 search-header">
							<form >
								<input type="hidden" name="_token" value="{{csrf_token()}}">
								<div class="input-group" >
									<input type="text" class="form-control border-search" placeholder="Nhập từ khóa..." name="id" id="search" autocomplete="off">
									<div id="box"></div>
									<span class="input-group-btn">
										<button  class="btn btn-default btn-color" type="button" ieyeSearch"><i class="fa fa-search" aria-hidden="true"></i></button>
									</span>

								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="header-bottom" data-spy="affix" data-offset-top="100">  <!-- data-spy="affix" data-offset-top="100" -->
			<nav class="navbar navbar-default">
				<div class="container">
					<!-- Brand and toggle get grouped for better mobile display -->
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" href=""></a>
					</div>

					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<ul class="nav navbar-nav">
							<li class=''><a href="index.html"><i class="fas fa-home"></i> Trang chủ</a></li>
							<li class=''><a href="products.html"><i class="fas fa-box-open"></i> Sản phẩm</a></li>
							<li class="dropdown ">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Danh mục<span class="caret"></span></a>
								<ul class="dropdown-menu">
									<li class=''><a href=""> Máy câu</a></li>
									<li class=''><a href=""> Cần câu</a></li>
									<li class=''><a href=""> Đồ câu</a></li>
									<li class=''><a href=""> Phụ kiện</a></li>
								</ul>
							</li>
							<li class="dropdown ">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Hãng sản xuất<span class="caret"></span></a>
								<ul class="dropdown-menu">
									<li class=''><a href=""> Máy câu</a></li>
									<li class=''><a href=""> Cần câu</a></li>
									<li class=''><a href=""> Đồ câu</a></li>
									<li class=''><a href=""> Phụ kiện</a></li>
								</ul>
							</li>
							
						</ul>
						<ul class="nav navbar-nav navbar-right">

							<li><a href="index.html"><i class="fa fa-shopping-basket" aria-hidden="true"></i> Giỏ hàng <span class="label bg-danger-2">1</span></a></li>

							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Xin chào! Hoàng Phúc<span class="caret"></span></a>
								<ul class="dropdown-menu">
									<li><a href="">Thông tin</a></li>
									<li><a href="">Đơn hàng</a></li>
									<li><a style="cursor: pointer;" id="logout">Đăng xuất</a></li>
								</ul>
							</li>

							<li><a href="" data-toggle="modal" data-target="#modalTest"><i class="fas fa-sign-in-alt" aria-hidden="true" ></i> Đăng nhập</a></li>
							<li><a href="" data-toggle="modal" data-target="#register"><i class="fas fa-user" aria-hidden="true"></i> Đăng ký</a></li>

						</ul>
					</div>
				</div>
			</nav>
		</div>
	</div>

	<div id="login" class="modal modal-2 fade" role="dialog">
		<div class="modal-dialog">				
			<div class="modal-content" style="width: 80%;">
				<div class="imgcontainer">
					<span class="close" data-dismiss="modal" title="Close Modal">&times;</span>
					<div class="logo-login-register"><img src="{{asset('public/images/layouts/logo.png')}}" class="img-responsive"></div>
				</div>
				<div class="modal-body">
					<form action="">
						<div class="form-group">
							<label for="email">Email:</label>
							<input id="email" type="text" class="form-control border-radis-none" name="email" placeholder="Email">
						</div>
						<div class="form-group">
							<label for="pwd">Mật Khẩu:</label>
							<input id="password" type="password" class="form-control border-radis-none" name="password" placeholder="Mật Khẩu">
						</div>
						<button type="submit" class="btn btn-hotel-2 btn-block">Đăng Nhập</button>
					</form> 
					<hr/>
					<p>Quên mật khẩu? <a href="">Khôi Phục.</a></p>
					<p>Chưa có tài khoản? <a href="">Đăng Ký</a></p>
				</div>
			</div>
		</div>
	</div>

	<div id="register" class="modal  fade" role="dialog">
		<div class="modal-dialog">				
			<div class="modal-content">
				<div class="imgcontainer">
					<span class="close" data-dismiss="modal" title="Close Modal">&times;</span>
					<div class="logo-login-register"><img src="{{asset('public/images/layouts/logo.png')}}" class="img-responsive"></div>
				</div>
				<div class="modal-body">
					<form action="">
						<div class="form-group">
							<label for="name">Họ & Tên:</label>
							<input id="name" type="text" class="form-control border-radis-none" name="name" placeholder="Họ & Tên">
						</div>
						<div class="form-group">
							<label for="email">Email:</label>
							<input id="email" type="text" class="form-control border-radis-none" name="email" placeholder="Email">
						</div>
						<div class="form-group">
							<label for="phone">Điện Thoại:</label>
							<input id="phone" type="text" class="form-control border-radis-none" name="phone" placeholder="0123456">
						</div>
						<div class="form-group">
							<label for="pwd">Mật Khẩu:</label>
							<input id="password" type="password" class="form-control border-radis-none" name="password" placeholder="Mật Khẩu">
						</div>
						<div class="form-group">
							<label for="pwd">Nhập Lại MK:</label>
							<input id="repassword" type="password" class="form-control border-radis-none" name="repassword" placeholder="Mật Khẩu">
						</div>
						<button type="submit" class="btn btn-hotel-2 btn-block">Đăng Ký</button>
					</form> 
					<hr/>
					<p>Đã có tài khoản? <a href="">Đăng Nhập</a></p>
				</div>
			</div>
		</div>
	</div>
</header>
</header>