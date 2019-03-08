@extends("layouts.customer.master")
@section('tieude')
	Thông tin cá nhân
@endsection
@section("danhmuc")

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
			<thead style="background: #DDDDDD; border-color: #f5f5f5">
				<tr>
					<th>Mã</th>
					<th>Ngày</th>
					<th>Giá trị</th>
					<th>Thanh toán</th>
					<th>Trạng thái</th>
				</tr>
			</thead>
			<tbody>
				@for($i=0; $i<=9; $i++)
				<tr>
					<td>#{{ $i+1 }}</td>
					<td>08/03/2019</td>
					<td>1,600,000đ</td>
					<td><span >Đã thanh toán</span></td>
					<td><span >Hoàn tất</span></td>
				</tr>
				@endfor
			</tbody>
		</table>
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
			<ul class="pagination">
				<li><a href="#">1</a></li>
				<li><a href="#">2</a></li>
				<li><a href="#">3</a></li>
				<li><a href="#">4</a></li>
				<li><a href="#">5</a></li>
			</ul>
		</div>
	</div>
	<div class="col-sm-4">
		<div class="box-profile">
			<div class="avatar-img">
				<img src="{{asset('public/images/avatar/customer/phuc.jpg')}}" alt="Ảnh đại diện redshop" />
			</div>
			<p><b><h5>Trịnh Hoàng Phúc</h5></b></p>
			<p><b><i class="fas fa-transgender"></i> Giới tính:</b> Nam</p>
			<p><b><i class="far fa-envelope-open"></i> Email:</b> thphucct@gmail.com</p>
			<p><b><i class="fas fa-phone-square"></i> Điện thoại:</b> 0368060988</p>
			<p><b><i class="fas fa-home"></i> Địa chỉ:</b> 39 Nguyễn Đình Chiễu, k1, p4, tp Sóc Trăng</p>
			<div class="row">
				<div class="col-sm-6">
					<button type="button" class="btn btn-hotel-2 btn-block">Cập nhật</button>
				</div>
				<div class="col-sm-6">
					<button type="button" class="btn btn-default-2 btn-block">Đổi mật khẩu</button>
				</div>
			</div>
			
		</div>
	</div>
</div>
@endsection