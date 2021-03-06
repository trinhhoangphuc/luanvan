@extends("layouts.customer.master")

@section('tieude')
	Tất cả sản phẩm
@endsection

@section("header")
	@include("layouts.customer.header")
@endsection

@section("tatcasp")
	active
@endsection

@section("footer")
	@include("layouts.customer.footer")
@endsection

@section('content')

<div class="row">
	<div class="col-sm-12 col-xs-12 col-md-12">
		<div class="titleProducts"><a href="{{ route('homepage') }}"><i class="fas fa-home"></i> Trang chủ <i class="fa fa-angle-right" aria-hidden="true"></i></a> Tất cả sản phẩm</div>
	</div>
</div>

<div class="row">

	@include("layouts.customer.menu-left") <!--Menu bên trái-->

	<div class="col-sm-9">
		<div class="row">
			@foreach($sanphamList as $item)
			<div class="col-xs-6 col-md-4 col-sm-4">
				<div class="product">
					@if($item->sp_tinhTrang == 1)
					<span class="label_news <?php if($item->sp_giamGia > 0) echo 'top_'; ?> ">
						<span class="bf_">Mới</span>
					</span>
					@endif
					@if($item->sp_giamGia > 0)
					<span class="sale_count">
						<span class="bf_">
							-{{ round( 100 - ($item->sp_giamGia * 100)/$item->sp_giaBan) }}%
						</span>
					</span>
					@endif
					<img src="{{asset('public/images/products/'.$item->sp_hinh)}}" alt="{{$item->sp_ten}}" class="image">
					<div class="overlay">
						<div class="box">
							<div class="btn-detail">

								<div style="margin: 5px 0px 5px 0px;"></div>
								<a href="{{route('detail', $item->sp_ma)}}" class="btn btn-detail-2"><i class="fa fa-eye" aria-hidden="true"></i></a>
								<div style="margin: 5px 0px 5px 0px;"></div>
								@if($item->sp_soLuong > 0)
								<button type="button" class="btn btn-detail-2" ng-click="addToCart({{ $item->sp_ma }}, 'single')"><i class="fa fa-shopping-basket" aria-hidden="true"></i></button>
								@endif
							</div>
						</div>
					</div>
					<div class="detail">
						<div class="title">{{$item->sp_ten}}</div>
						<p class="price">
							@if($item->sp_giamGia > 0)
							<span class="discount">{{number_format($item->sp_giaBan, 0, ".", ",")}} <sup>đ</sup></span>&nbsp;
							<span>{{number_format($item->sp_giamGia, 0, ".", ",")}} <sup>đ</sup></span>
							@else
							<span>{{number_format($item->sp_giaBan, 0, ".", ",")}} <sup>đ</sup></span>
							@endif
						</p>
					</div>
				</div>
			</div>
			@endforeach

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
				{{$sanphamList->render()}}
			</div>
		</div>
	</div>
</div>
@endsection