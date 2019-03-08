<header>
	<div class="header">
		<div class="main-header">
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="logo text-center">
							<a href="{{route('homepage')}}"><img src="{{asset('public/images/layouts/logo.png')}}" class="img-responsive" /></a>
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

		<div class="header-bottom" id="header-bottom">  <!-- data-spy="affix" data-offset-top="100" -->
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
							<li class='@yield("trangchu")'><a href="{{ route('homepage') }}"><i class="fas fa-home"></i> Trang chủ</a></li>
							<li class='@yield("tatcasp")'><a href="{{ route('getAllProducts') }}"><i class="fas fa-box-open"></i> Sản phẩm</a></li>
							<li class="dropdown @yield('danhmuc')">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Danh mục<span class="caret"></span></a>
								<ul class="dropdown-menu">
									@foreach($loaiList as $loai)
									<li class=''><a href="{{route('Category', $loai->l_ma)}}"> {{ $loai->l_ten }}</a></li>
									@endforeach
								</ul>
							</li>
							<li class="dropdown @yield('nsx')">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Nhà sản xuất<span class="caret"></span></a>
								<ul class="dropdown-menu">
									@foreach($nhasanxuatList as $nhasanxuat)
									<li class=''><a href="{{route('Brand', $nhasanxuat->h_ma)}}"> {{ $nhasanxuat->h_ten }}</a></li>
									@endforeach
								</ul>
							</li>
							
						</ul>
						<ul class="nav navbar-nav navbar-right">

							<li>
								<a href="" data-toggle="modal" ng-click="showLoginRegister('success')"><i class="fa fa-shopping-basket" aria-hidden="true"></i> Giỏ hàng <span class="label bg-danger-2">1</span></a>
							</li>


							@if(!Session::has("customer_id"))
								<li>
									<a href="" data-toggle="modal" ng-click="showLoginRegister('login')"><i class="fas fa-sign-in-alt" aria-hidden="true" ></i> Đăng nhập</a>
								</li>
								<li>
									<a href="" data-toggle="modal" ng-click="showLoginRegister('register')"><i class="fas fa-user" aria-hidden="true"></i> Đăng ký</a>
								</li>
							@else
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Xin chào! {{ Session::get("customer_name") }}<span class="caret"></span></a>
									<ul class="dropdown-menu">
										<li><a href="">Thông tin</a></li>
										<li><a href="">Đơn hàng</a></li>
										<li><a style="cursor: pointer;" id="logout" ng-click="logout()">Đăng xuất</a></li>
									</ul>
								</li>
							@endif
						</ul>
					</div>
				</div>
			</nav>
		</div>
	</div>

	<div id="loginRegiter" class="modal modal-2 fade" role="dialog">
		<div class="modal-dialog">				
			<div class="modal-content hidden" style="width: 80%;" id="submitLoginRegister">
				<div class="imgcontainer">
					<span class="close" data-dismiss="modal" title="Close Modal">&times;</span>
					<div class="logo-login-register"><img src="{{asset('public/images/layouts/logo.png')}}" class="img-responsive"></div>
				</div>

				<div class="modal-body hidden" id="frmLogin"> <!--form login-->
					<form method="POST" name="frmPostLoin" id="frmPostLoin">
						<input type="hidden" name="_token" value="{{csrf_token()}}">
						<div class="form-group">
							<label for="email">Email:</label>
							<input type="text" class="form-control border-radis-none" id="emailLogin" name="emailLogin" placeholder="Email" ng-model="login.emailLogin" />
						</div>
						<div class="form-group">
							<label for="pwd">Mật Khẩu:</label>
							<input type="password" class="form-control border-radis-none" id="passLogin" name="passLogin" placeholder="Mật Khẩu" ng-model="login.passLogin" />
						</div>
						<div class="form-group">
							<span id="errorLogin" class="error"></span>
						</div>
						<button type="submit" class="btn btn-hotel-2 btn-block">Đăng Nhập</button>
					</form> 
					<hr/>
					<p>Quên mật khẩu? <a href="">Khôi Phục.</a></p>
					<p>Chưa có tài khoản? <a href="" ng-click="showLoginRegister('register')">Đăng Ký</a></p>
				</div>

				<div class="modal-body hidden" id="frmRegiter">
					<form method="POST" name="frmPostRegister" id="frmPostRegister">
						<input type="hidden" name="_token" value="{{csrf_token()}}">
						<div class="form-group">
							<label for="name">Họ & Tên:</label>
							<input id="name" type="text" class="form-control border-radis-none" name="name" placeholder="Họ & Tên" ng-model="register.name" />
						</div>
						<div class="form-group">
							<label for="name">Giới tính:</label>&nbsp;&nbsp;
							<label class="radio-inline"><input type="radio" id="man" name="gender" checked ng-model="register.gender" ng-value="1" />Nam</label>
							<label class="radio-inline"><input type="radio" id="woman" name="gender" ng-model="register.gender" ng-value="0" />Nữ</label>
						<div class="form-group">
						</div>
							<label for="email">Email:</label>
							<input id="email" type="text" class="form-control border-radis-none" name="email" placeholder="Email" ng-model="register.email" />
							<span id="errorEmail" class="error"></span>
						</div>
						<div class="form-group">
							<label for="phone">Điện Thoại:</label>
							<input id="phone" type="text" class="form-control border-radis-none" name="phone" placeholder="0123456" ng-model="register.phone" />
							<span id="errorPhone" class="error"></span>
						</div>
						<div class="form-group">
							<label for="address">Địa chỉ:</label>
							<input id="address" type="text" class="form-control border-radis-none" name="address" placeholder="Họ & Tên" ng-model="register.address" />
						</div>
						<div class="form-group">
							<label for="pwd">Mật Khẩu:</label>
							<input id="password" type="password" class="form-control border-radis-none" name="password" placeholder="Mật Khẩu" ng-model="register.pass" />
						</div>
						<div class="form-group">
							<label for="pwd">Nhập Lại MK:</label>
							<input id="repassword" type="password" class="form-control border-radis-none" name="repassword" placeholder="Mật Khẩu">
						</div>
						<button type="submit" class="btn btn-hotel-2 btn-block">Đăng Ký</button>
					</form> 
					<hr/>
					<p>Đã có tài khoản? <a href="" ng-click="showLoginRegister('login')">Đăng Nhập</a></p>
				</div>

			</div>

			<div class="modal-content hidden" style="width: 80%;" id="frmSuccessEror">
				<div class="imgcontainer">
					<span class="close" data-dismiss="modal" title="Close Modal">&times;</span>
				</div>
				<div class="modal-body text-center" id="frmSuccess" >
					<div style="width: 40%; height: 100%; margin: auto;">
						<img src="{{ asset('public/images/layouts/success.gif') }}" class="img-responsive" />
					</div>
					<h4 class="text-danger">Chúc mừng! Bạn đã đăng ký tài khoản thành công</h4>
					<h4><a href="" data-toggle="modal" ng-click="showLoginRegister('login')">Đăng nhập</a></h4>
					
				</div>

			</div>
		</div>
	</div>
</header>