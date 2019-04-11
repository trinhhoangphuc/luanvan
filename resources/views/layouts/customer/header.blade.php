
<header id="header">
	<div class="header_top">
		<div class="container">
			<div class="row">
				<div class="col-sm-6">
					<div class="contactinfo" style="padding: 5px;">
						<ul class="nav nav-pills">
							<li><a href="#"><i class="fa fa-phone"></i> Hotline: 090.123.4567</a></li>
							<li><a href="#"><i class="fa fa-envelope"></i> Redshop.vn - Thực phẩm thể hình</a></li>
						</ul>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="social-icons pull-right">
						<ul class="nav navbar-nav">
							<li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
							<li><a href="#"><i class="fab fa-twitter"></i></a></li>
							<li><a href="#"><i class="fab fa-linkedin"></i></a></li>
							<li><a href="#"><i class="fab fa-dribbble"></i></a></li>
							<li><a href="#"><i class="fab fa-google-plus"></i></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="header-middle">
		<div class="container">
			<div class="row">
				<div class="col-sm-4">
					<div class="logo pull-left">
						<a href=""><img src="{{asset('public/images/layouts/logo.png')}}" class="img-responsive" /></a>
					</div>
				</div>
				<div class="col-sm-8 ">
					<div class="col-sm-4"></div>
					<div class="search-header col-md-8">
						<form name="searchFrm" id="searchFrm">
							<input type="hidden" name="_token" value="{{csrf_token()}}">

							<input type="hidden" name="_token" name="{{ csrf_token() }}">
							<input type="text" class="form-control border-search" placeholder="Nhập từ khóa..." name="search" id="search" ng-model="search" ng-keyup="compelte(search)" autocomplete="off">
							<p style="margin-top: 2px;">Gợi ý: Bcaa, Mass, whey, my protein, Iso 100, .v.v.</p>

							<div id="box-search-item" style=" position: absolute; z-index: 9999; width: 95%;  overflow: auto;">
								<ul class="list-group" >
									<li class="list-group-item" ng-repeat="searchData in filterSearch">
										<a href="@{{URL_3}}@{{searchData.sp_ma}}">
											<img src="{{asset('public/images/products')}}/@{{searchData.sp_hinh}}" alt="@{{searchData.sp_ten}}" width="10%" />
											@{{searchData.sp_ten}}
										</a>
									</li>
								</ul>
							</div>
						</form>
					</div>
				</div>

			</div>
		</div>
	</div>
	
	<div class="header-bottom" id="header-bottom">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
					</div>
					<div class="mainmenu">
						<ul class="nav navbar-nav collapse navbar-collapse">
							<li ><a class="{{ (\Request::route()->getName() == 'homepage') ? 'active' : '' }}" href="{{ route('homepage') }}"> Trang chủ</a></li>
							<li><a class="{{ (\Request::route()->getName() == 'getAllProducts') ? 'active' : '' }}" href="{{ route('getAllProducts') }}">Sản phẩm</a></li>
							<li class="dropdown"><a class="{{ (\Request::route()->getName() == 'Category') ? 'active' : '' }}" href="{{ route('homepage') }}" href="">Danh mục<i class="fa fa-angle-down"></i></a>
								<ul role="menu" class="sub-menu">
									@foreach($loaiList as $loai)
									<li class=''><a class='{{(\Request::path()  == "danh-muc/$loai->l_ma") ? "active" : ""}}' href="{{route('Category', $loai->l_ma)}}"> {{ $loai->l_ten }}</a></li>
									@endforeach
								</ul>
							</li> 
							<li class="dropdown"><a class="{{ (\Request::route()->getName() == 'Brand') ? 'active' : '' }}" href="">Nhà sản xuất<i class="fa fa-angle-down"></i></a>
								<ul role="menu" class="sub-menu">
									@foreach($nhasanxuatList as $nsx)
									<li class=''><a class='{{(\Request::path()  == "nha-san-xuat/$nsx->h_ma") ? "active" : ""}}' href="{{route('Brand', $nsx->h_ma)}}"> {{ $nsx->h_ten }}</a></li>
									@endforeach
								</ul>
							</li>
							<li><a class="{{ (\Request::route()->getName() == 'getKhuyenmai') ? 'active' : '' }}" href="{{ route('getKhuyenmai') }}">Khuyến mãi</a></li>
						</ul>
						<ul class="nav navbar-nav collapse navbar-collapse navbar-right">
							<li>
								<a class="@yield('giohang')" href="{{route('getCart')}}" data-toggle="modal"><i class="fa fa-shopping-basket" aria-hidden="true"></i> Giỏ hàng <span class="label " style="background-color: #333">@{{cart}}</span></a>
							</li>


							@if(!Session::has("customer_id"))
							<li>
								<a href="" data-toggle="modal" ng-click="showLoginRegister('login')"><i class="fas fa-sign-in-alt" aria-hidden="true" ></i> Đăng nhập</a>
							</li>
							<li>
								<a href="" data-toggle="modal" ng-click="showLoginRegister('register')"><i class="fas fa-user" aria-hidden="true"></i> Đăng ký</a>
							</li>
							@else
							<li class="dropdown @yield('ttcn')"><a href=""><img src="{{asset('public/images/avatar/customer/'.Session::get('customer_img'))}}" width="20px" height="20px" class="img-circle" /> {{ Session::get("customer_name") }}<i class="fa fa-angle-down"></i></a>
								<ul role="menu" class="sub-menu">
									<li><a href="{{ route('profile') }}">Thông tin</a></li>
									<li><a style="cursor: pointer;" id="logout" ng-click="logout()">Đăng xuất</a></li>
								</ul>
							</li> 
							@endif
						</ul>

					</div>
				</div>
			</div>
		</div>
	</div>
	</header>

	<div id="loginRegiter" class="modal modal-2 fade" role="dialog">
		<div class="modal-dialog">				
			<div class="modal-content hidden" style="width: 80%;" id="submitLoginRegister">
				<div class="imgcontainer">
					<span class="close" data-dismiss="modal" title="Close Modal">&times;</span>
					<div class="logo-login-register"><img src="{{asset('public/images/layouts/logo.png')}}" class="img-responsive"></div>
				</div>

				<div class="modal-body hidden" id="frmLogin">
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