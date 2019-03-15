@extends("layouts.customer.master")
@section('tieude')
Thông tin chi tiết đơn hàng
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
		<div class="titleProducts"><a href="{{ route('homepage') }}"><i class="fas fa-home"></i> Trang chủ <i class="fa fa-angle-right" aria-hidden="true"></i></a><a href="{{ route('homepage') }}"> Đơn hàng <i class="fa fa-angle-right" aria-hidden="true"></i></a> Thông tin chi tiết đơn hàng</div>
	</div>
</div>

<div class="row">
	<div class="col-sm-12">
		
		<div class="order-title">
			<p>Chi tiết đơn hàng #{{$donhang->dh_ma}} -
				@if($donhang->dh_trangThai == 0) 
					<span>Chờ xác nhận từ cửa hàng</span>
				@elseif($donhang->dh_trangThai == 1)
					<span>Đã được xác nhận</span>
				@elseif($donhang->dh_trangThai == 2)
					<span>Đang được vận chuyển</span>
				@elseif($donhang->dh_trangThai == 0)
					<span>Giao hàng hoàn tất</span>
				@endif
			</p>
			<p style="font-size: 15px;">Ngày đặt hàng: {{$donhang->dh_taoMoi}}</p>
		</div>

		<div class="row">

			<div class="col-sm-4"><br/>
				<p style="font-size: 16px;">ĐỊA CHỈ NGƯỜI NHẬN</p>
				<div class="box-info">
					<p><b>{{$khachhang->kh_hoTen}}</b></p>
					<p>Địa chỉ: {{$khachhang->kh_diaChi}}</p>
					<p>Điện thoại: {{$khachhang->kh_dienThoai}}</p>
				</div>
			</div>

			<div class="col-sm-4"><br/>
				<p style="font-size: 16px;">HÌNH THỨC GIAO HÀNG</p>
				<div class="box-info">
					<p>{{$donhang->vc_ten}} </p>
					<p>Phí vận chuyển: {{number_format($donhang->vc_gia, 0, ",", ".")}} ₫</p>
				</div>
			</div>

			<div class="col-sm-4"><br/>
				<p style="font-size: 16px;">HÌNH THỨC THANH TOÁN</p>
				<div class="box-info">
					<p>{{$donhang->tt_ten}}</p>
					@if($donhang->dh_daThanhToan == 0) 
					<p>Chưa thanh toán</p>
					@elseif($donhang->dh_daThanhToan == 1)
					<p>Đã thanh toán</p>
					@endif
				</div>
			</div>

		</div>

		<div class="row">
			<div class="col-sm-12">
				<div class="order-product table-responsive">
					<table class="table table-order">
						<thead>
							<tr>
								<th width="8%">Ảnh</th>
								<th class="text-center">Sản phẩm</th>
								<th class="text-center">Hương vị</th>
								<th class="text-center">Giá</th>
								<th class="text-center">Số lượng</th>
								<th class="text-right">Thành tiền</th>
							</tr>
						</thead>
						<tbody>
							<?php  $tamtinh = 0;  ?>
							@foreach($chitiethoadon as $item)
							<tr>
								<td class="text-center">
									<img src="{{asset('public/images/products/'.$item->sp_hinh)}}" alt="{{$item->sp_ten}}" width="100%">
								</td>
								<td class="text-center"><a href="{{route('detail', $item->sp_ma)}}" style="color: #333"><b>{{$item->sp_ten}}</b></a></td>
								<td class="text-center"><b>{{$item->hv_ten}}</b></td>
								<td class="text-center">{{number_format($item->ctdh_donGia, 0, ",", '.')}} ₫</td>
								<td class="text-center">{{$item->ctdh_soluong}}</td>
								<td class="text-right">{{number_format($item->ctdh_donGia * $item->ctdh_soluong, 0, ",", '.')}} ₫</td><?php  $tamtinh += $item->ctdh_donGia * $item->ctdh_soluong;  ?>
							</tr>
							
							@endforeach
							<tr>
								<td class="text-right" colspan="6" style="font-size: 18px;">
									<br/>
									<p style="font-size: 15px;">Tổng tạm tính <span style="margin-left: 50px">{{number_format($tamtinh, 0, ",", '.')}} ₫</span></p>
									<p style="font-size: 15px;">Phí vận chuyển <span style="margin-left: 50px">{{number_format($donhang->vc_gia, 0, ",", '.')}} ₫</span></p>
									<p>Tổng cộng <span style="margin-left: 50px; color: red" >{{number_format($donhang->dh_tongTien, 0, ",", '.')}} ₫</span></p>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
				
			</div>
		</div>

		<br/>
		<div class="row">
			<div class="col-sm-12">
				<a href="{{route('profile')}}" style="font-size: 18px;"><< Quay lại đơn hàng của tôi</a>
			</div>
		</div>
	</div>
</div>

@endsection