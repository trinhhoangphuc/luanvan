@extends("layouts.customer.master")
@section('tieude')
	Thông tin cá nhân
@endsection

@section("header")
	@include("layouts.customer.header")
@endsection

@section("footer")
	@include("layouts.customer.footer")
@endsection

@section('content')

<div class="row">
	<div class="col-sm-12 col-xs-12 col-md-12">
		<div class="titleProducts"><a href="{{ route('homepage') }}"><i class="fas fa-home"></i> Trang chủ <i class="fa fa-angle-right" aria-hidden="true"></i></a> Đơn hàng & thông tin cá nhân</div>
	</div>
</div>

<div class="row">
	<div class="col-sm-8">
		<table class="table table-bordered table-hover table-responsive">
			<thead style="background: #F9FAFB; border-color: #f5f5f5">
				<tr>
					<th>Mã</th>
					<th>Ngày</th>
					<th>Giá trị</th>
					<th>Thanh toán</th>
					<th>Trạng thái</th>
				</tr>
			</thead>
			<tbody>
				@foreach($donhangList as $donhang)
				<tr>
					<td><a href="{{route('reviewOrder', $donhang->dh_ma)}}">#{{ $donhang->dh_ma }}</a></td>
					<td>{{ $donhang->dh_taoMoi }}</td>
					<td>{{ number_format($donhang->dh_tongTien, 0, ",", ".") }}đ</td>
					<td>
						@if($donhang->dh_daThanhToan == 0)
						<span >Chưa thanh toán</span>
						@elseif($donhang->dh_daThanhToan == 1)
						<span >Đã thanh toán</span>
						@else
						<span >Hủy đơn</span>
						@endif
					</td>
					<td>
						@if($donhang->dh_trangThai == 0) 
						<span>Chờ xác nhận</span>
						@elseif($donhang->dh_trangThai == 1)
						<span>Đã xác nhận</span>
						@elseif($donhang->dh_trangThai == 2)
						<span>Đang vận chuyển</span>
						@elseif($donhang->dh_trangThai == 0)
						<span>Hoàn tất</span>
						@endif
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
			{{$donhangList->render()}}
		</div>
	</div>
	<div class="col-sm-4">
		<div class="box-profile " id="profile">

			@if(session('success'))
			<script >
				toastr.success("Cập nhật thông tin thành công!");
			</script>
			@endif
			@if(session('error'))
			<script >
				toastr.error("Có lỗi xảy ra!, vui lòng kiểm tra lại!");
			</script>
			@endif

			<div class="avatar-img">
				<img src="{{asset('public/images/avatar/customer/'. $khachhang->kh_hinh)}}" alt="Ảnh đại diện redshop" />
			</div>
			<p><b><h5>{{ $khachhang->kh_hoTen }}</h5></b></p>
			<p><b><i class="fas fa-transgender"></i> Giới tính:</b> @if($khachhang->kh_gioiTinh == 1) Nam @else Nử @endif</p>
			<p><b><i class="far fa-envelope-open"></i> Email:</b> {{ $khachhang->kh_email }}</p>
			<p><b><i class="fas fa-phone-square"></i> Điện thoại:</b> {{ $khachhang->kh_dienThoai }}</p>
			<p><b><i class="fas fa-home"></i> Địa chỉ:</b> {{ $khachhang->kh_diaChi }}</p>
			<div class="row">
				<div class="col-sm-6">
					<button type="button" class="btn btn-hotel-2 btn-block" ng-click="showLoginRegister('profile')">Chỉnh sửa</button>
				</div>
			</div>
			
		</div>
		<div class="box-profile hidden" id="frmProfile">
			<form method="POST" name="frmPostProfile" id="frmPostProfile" action="{{ route('postProfile') }}" enctype="multipart/form-data">
				<input type="hidden" name="_token" value="{{csrf_token()}}">
				<div class="form-group"><a href="" ng-click="showLoginRegister('cancelProfile')"><h4><i class="fas fa-chevron-left"></i> Trở về</h4></a></div>
				<div class="form-group">
					<img class="user_avatar" id="output" src="{{asset('public/images/avatar/customer/'. $khachhang->kh_hinh)}}">
					<label for="avtuser" class="labelforfile"><i class="fas fa-file-image"></i> Chọn ảnh</label>
					<input class="form-control" name="avtuser" id="avtuser" type="file" accept="image/*" onchange="loadFile(event)" style="display: none">
					<script>
						var loadFile = function(event) {
							var output = document.getElementById('output');
							output.src = URL.createObjectURL(event.target.files[0]);
						};
					</script>
				</div>

				<div class="form-group">
					<label for="name">Họ & Tên:</label>
					<input id="name" type="text" class="form-control border-radis-none" name="name" placeholder="Họ & Tên" value="{{ $khachhang->kh_hoTen }}" />
				</div>

				<div class="form-group">
					<label for="name">Giới tính:</label>&nbsp;&nbsp;
					<label class="radio-inline"><input <?php if($khachhang->kh_gioiTinh == 1) echo "checked" ?> type="radio" id="man" name="gender" value="1" />Nam</label>
					<label class="radio-inline"><input <?php if($khachhang->kh_gioiTinh == 0) echo "checked" ?> type="radio" id="woman" name="gender" value="0" />Nữ</label>
				</div>
					
				<div class="form-group">
					<label for="phone">Điện Thoại:</label>
					<input id="phone" type="text" class="form-control border-radis-none" name="phone" placeholder="0123456" value="{{ $khachhang->kh_dienThoai }}" />
					<span id="errorPhone" class="error"></span>
				</div>

				<div class="form-group">
					<label for="address">Địa chỉ:</label>
					<input id="address" type="text" class="form-control border-radis-none" name="address" placeholder="Họ & Tên" value="{{ $khachhang->kh_diaChi }}" />
				</div>

				<div class="form-group">
					<label for="newPass">Mật khẩu mới:</label>
					<input id="newPass" type="password" class="form-control border-radis-none" name="newPass" placeholder="Nhập mật khẩu mới" />
				</div>

				<div class="form-group">
					<label for="rePass">Nhập lại mật khẩu mới:</label>
					<input id="rePass" type="password" class="form-control border-radis-none" name="rePass" placeholder="Nhập lại mật khẩu"  />
					<span id="errorPhone" class="error"></span>
				</div>

				<div class="row">
					<div class="col-sm-6">
						<button type="submit" class="btn btn-hotel-2 btn-block">Cập nhật</button>
					</div>
					<div class="col-sm-6">
						<button type="reset" class="btn btn-default-2 btn-block">Nhập lại</button>
					</div>
				</div>

			</form>
		</div>
	</div>
</div>

@endsection