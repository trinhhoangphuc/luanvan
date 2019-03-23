@extends("layouts.customer.master")
@section('tieude')
	Đặt hàng thành công
@endsection

@section('content')
<div class="row">
	<div class="col-sm-12 text-center" >
		<a href="{{route('homepage')}}"><img src="{{asset('public/images/layouts/logo.png')}}" class="img-responsive" style="margin:auto;" /></a>
	</div>

</div>
<hr/><br/>
<div class="row">
	<div class="col-sm-7">
		<br/>
		<div class="order-title">
			<p>Cám ơn bạn đã đặt hàng!!! </p>
			<p style="font-size: 15px;">MÃ ĐƠN HÀNG: #{{$donhang->dh_ma}}</p> <p style="font-size: 14px;">Ngày đặt: {{$donhang->dh_taoMoi}}</p>
		</div>
		<div class="alert-order">
			Redshop sẽ gọi lại xác nhận trong thời gian sớm nhất, bạn vui lòng để ý để thoại và nghe máy giúp chúng tôi. Xin chân thành cảm ơn!
		</div>
		<hr/>
		<div class="col-sm-6"><br/>
			<p style="font-size: 16px;">ĐỊA CHỈ NGƯỜI NHẬN</p>
			<div class="box-info" >
				<p><b>{{$donhang->dh_nguoiNhan}}</b></p>
				<p>Địa chỉ: {{$donhang->dh_diaChi}}</p>
				<p>Điện thoại: {{$donhang->dh_dienThoai}}</p>
			</div>
		</div>
		<div class="col-sm-6"><br/>
			<p style="font-size: 16px;">ĐỊA CHỈ NGƯỜI MUA</p>
			<div class="box-info" >
				<p><b>{{$khachhang->kh_hoTen}}</b></p>
				<p>Địa chỉ: {{$khachhang->kh_diaChi}}</p>
				<p>Điện thoại: {{$khachhang->kh_dienThoai}}</p>
			</div>
		</div>

		<div class="col-sm-6"><br/>
			<p style="font-size: 16px;">HÌNH THỨC VẬN CHUYỂN</p>
			<div class="box-info" >
				<p>{{$donhang->vc_ten}}</p>
				<p>Phí vân chuyển: {{number_format($donhang->vc_gia, 0, ",", '.')}} ₫</p>
			</div>
		</div>
		<div class="col-sm-6"><br/>
			<p style="font-size: 16px;">HÌNH THỨC THANH TOÁN</p>
			<div class="box-info" >
				<p>{{$donhang->tt_ten}}</p>
				@if($donhang->dh_daThanhToan == 0) 
				<p>Chưa thanh toán</p>
				@elseif($donhang->dh_daThanhToan == 1)
				<p>Đã thanh toán</p>
				@endif
			</div>
		</div>

	</div>
	<div class="col-sm-5">
		
		<div class="box-error" style="margin-top: 0px; box-shadow: none; border:none;">
			<div class="login-cart">
				<div class="order">
					<span class="title">Sản phẩm đã đặt</span>
				</div>
				<?php  $tamtinh = 0;  ?>
				@foreach($chitiethoadon as $item)
				<div class="item">
					<p class="title">
						<img src="{{asset('public/images/products/'.$item->sp_hinh)}}" alt="{{$item->sp_ten}}" width="20%;">
						<strong>{{$item->ctdh_soluong}} x </strong>
						<a href="{{ route('detail', $item->sp_ma) }}">{{$item->sp_ten}} ( {{$item->hv_ten}} )</a>
					</p>

					<p class="price"><br/><span>{{number_format($item->ctdh_donGia * $item->ctdh_soluong, 0, ",", '.')}} ₫</span></p>

					<div class="clear"></div>
				</div>
				<?php  $tamtinh += $item->ctdh_donGia * $item->ctdh_soluong;  ?>
				@endforeach
				

				<div class="item">
					<p class="title">
						<span>Tạm tính:	</span>
					</p>
					<p class="price"><span>{{number_format($tamtinh, 0, ",", '.')}} ₫</span></p>
					<p class="title">
						<span>Vận chuyển: </span>
					</p>
					
						<p class="price"><span id="vcid">{{number_format($donhang->vc_gia, 0, ",", '.')}} ₫</span></p>

					<div class="clear"></div>
				</div>
				<div class="item">
					<p class="title">
						<span><b>Tổng tiền:	</b></span>
					</p>
					<p class="price" style="color: red; font-size: 18px;">
						<span id="totalID">{{number_format($donhang->dh_tongTien, 0, ",", '.')}} ₫</span>
					</p>
					<div class="clear"></div>
				</div>
			</div>
		</div>

		<a href="{{route('homepage')}}" class="btn btn-hotel-2">Quay lại trang chủ</a>
	</div>
</div>
<div style="margin: 100px;"></div>
@endsection