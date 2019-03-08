@extends("layouts.customer.master")
@section('tieude')
	{{$nsx->l_ten}}
@endsection
@section("nsx")
	active
@endsection
@section('content')
<div class="row">
	<div class="col-sm-12 col-xs-12 col-md-12">
		<div class="titleProducts"><a href="{{ route('homepage') }}"><i class="fas fa-home"></i> Trang chủ <i class="fa fa-angle-right" aria-hidden="true"></i></a> {{$nsx->l_ten}}</div>
	</div>
</div>

<div class="row">
	@if( count($sanphamList) > 0)

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
								<a href="" class="btn btn-detail-2"><i class="fa fa-shopping-basket" aria-hidden="true"></i></a>
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
	@else
	<div class="error_404">
		<br/><br/>
		<h2> <span style="color: #666">"{{$nsx->l_ten}}"</span> chưa có sản phẩm!</h2>
		<br/><br/>
	</p>
	@endif
</div>
@endsection