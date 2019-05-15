@extends("layouts.customer.master")

@section("header")
	@include("layouts.customer.header")
@endsection

@section('tieude')
Giỏ hàng
@endsection

@section("footer")
	@include("layouts.customer.footer")
@endsection

@section('content')

<div class="row">
	<div class="col-sm-12 col-xs-12 col-md-12">
		<div class="titleProducts"><a href="{{ route('homepage') }}"><i class="fas fa-home"></i> Trang chủ <i class="fa fa-angle-right" aria-hidden="true"></i></a> Thanh toán</div>
	</div>
</div>

<div class="row">
	<div class="col-sm-12">
		<div class="wallpaper">
			<div class="title" style="margin-top: -40px;">
				<h2> Thông tin khách hàng </h2>
			</div>
		</div>
	</div>
</div>
<br/>
<div class="row">
	<div class="col-sm-7">
		<div class="box-error" style="margin-top: 0px; margin-bottom: 10px; box-shadow: none;">
			<div class="login-cart">
				<div class="order">
					<span  class="title">ĐẶT HÀNG CHỈ 45 GIÂY</span>	
				</div>
				<div class="address-item" style="padding: 5px;">
					<p class="address" title="" style="margin: 10px 0px;"><b>Nếu bạn đã mua trên Redshop.vn?</b></p>
					<p class="phone"><button type="button" class="btn btn-hotel-2" ng-click="showLoginRegister('login')">Hãy đăng nhập tại đây</button></p>
				</div>
			</div>
		</div>
		<div class="panel panel-default payment">
			<div class="panel-body">
				<form method="POST" name="frmPostRegister-2" id="frmPostRegister-2">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<h3 class="step-title"><b>Hoặc tạo ngay dưới đây</b></h3>
					<p>Lợi ích của việc đăng ký thành viên là: các lần đặt hàng tiếp theo bạn chỉ cần đăng nhập bằng email và mật khẩu bạn đã tạo và có thể theo dõi đơn hàng của bạn.</p>
					<input type="hidden" name="_token" value="{{csrf_token()}}">
					<div class="form-group">
						<label for="name">Họ & Tên:</label>
						<input id="name" type="text" class="form-control border-radis-none" name="name" placeholder="Họ & Tên" ng-model="register2.name" />
					</div>
					<div class="form-group">
						<label for="name">Giới tính:</label>&nbsp;&nbsp;
						<label class="radio-inline"><input type="radio" id="man" name="gender" checked ng-model="register2.gender" ng-value="1" />Nam</label>
						<label class="radio-inline"><input type="radio" id="woman" name="gender" ng-model="register2.gender" ng-value="0" />Nữ</label>
					</div>
					<div class="form-group">
						<label for="email">Email:</label>
						<input id="email" type="text" class="form-control border-radis-none" name="email" placeholder="Email" ng-model="register2.email" />
						<span id="errorEmail-2" class="error"></span>
					</div>
					<div class="form-group">
						<label for="phone">Điện Thoại:</label>
						<input id="phone" type="text" class="form-control border-radis-none" name="phone" placeholder="0123456" ng-model="register2.phone" />
						<span id="errorPhone-2" class="error"></span>
					</div>
					<div class="form-group">
						<label for="address">Địa chỉ:</label>
						<input id="address" type="text" class="form-control border-radis-none" name="address" placeholder="Họ & Tên" ng-model="register2.address" />
					</div>
					<div class="form-group">
						<label for="pwd">Mật Khẩu:</label>
						<input id="password" type="password" class="form-control border-radis-none" name="password" placeholder="Mật Khẩu" ng-model="register2.pass" />
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-hotel-2 btn-block">Xác nhận</button>
					</div>
				</form>
			</div>
		</div>

	</div>
	<div class="col-sm-5">
		<div class="box-error" style="margin-top: 0px; box-shadow: none;">
			<div class="login-cart">
				<div class="order">
					<span  class="title">Đơn hàng ( {{count($cart)}} sản phẩm)</span>
					<a class="btn pull-right btn-hotel-2" href="{{route('getCart')}}">Sửa</a>
				</div>
				@foreach($cart as $item)
				<div class="item">
					<p class="title">
						<strong>{{$item->qty}} x </strong>
						<a href="{{route('detail', $item->options->sp_ma)}}">{{$item->name}}</a>
					</p>

					<p class="price">
						@if($item->options->discount > 0)
						<span>{{number_format($item->options->discount,0,",",".")}} đ</span>
						@else
						<span>{{number_format($item->options->price_2,0,",",".")}} đ</span>
						@endif	
					</p>

					<div class="clear"></div>

				</div>
				@endforeach


				<div class="item">
					<p class="title">
						<span><b>Tạm tính:	</b></span>
					</p>
					<p class="price" style="color: red; font-size: 18px;">
						<span id="totalID">{{number_format($total,0,",",".")}} đ</span>
					</p>
					<div class="clear"></div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection