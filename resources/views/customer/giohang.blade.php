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
		<div class="titleProducts"><a href="{{ route('homepage') }}"><i class="fas fa-home"></i> Trang chủ <i class="fa fa-angle-right" aria-hidden="true"></i></a> Giỏ hàng</div>
	</div>
</div>



@if(count($cart) > 0)
<div class="row">
	<div class="col-sm-12">
		<div class="wallpaper">
			<div class="title" style="margin-top: -40px;">
				<h2> GIỎ HÀNG (Có @{{cart}} sản phẩm) </h2>
			</div>
		</div>
	</div>
</div>
<br/>

<div class="row">
	<div class="col-sm-8">
	
		<div class="box-cart">

			@if(session('success'))
			<script >
				toastr.success("Đã cập nhật số lượng giỏ hàng!");
			</script>
			@endif
			@if(session('error'))
			<script >
				toastr.warning("Vượt quá số lượng sản phẩm trong kho!");
			</script>
			@endif

			@foreach($cart as $item)
			<div class="col-sm-12">
				<div class="panel panel-default payment" style="margin-bottom: 10px;">
					<div class="panel-body  cart-item">
						<div class="row">
							<div class="col-sm-2">
								<p class="image">
									<img class="img-responsive" src="{{asset('public/images/products/' . $item->options->img)}}">
								</p>
							</div>
							<div class="col-sm-6">
								<p class="title"><a href="{{route('detail', $item->options->sp_ma)}}" style="color: #777;">{{$item->name}} <span style="color: red;">({{$item->options->taste}})</span></a></p>
								<p class="seller-by">Quà tặng: <a>{{$item->options->gifName}}</a></p>
								<p class="price">	
									@if($item->options->discount > 0)
									<span style="text-decoration: line-through; color:#666;">{{number_format($item->options->price_2,0,",",".")}} đ</span>
									<span>{{number_format($item->options->discount,0,",",".")}} đ</span>
									@else
									<span>{{number_format($item->options->price_2,0,",",".")}} đ</span>
									@endif										
								</p>
							</div>
							<div class="col-sm-4">
								<form method="POST" action="{{route('updateCart', $item->id)}}">
									<input type="hidden" name="_token" value="{{ csrf_token() }}" />
									<p class="col-sm-12 col-md-6 col-xs-6" style="padding-left: 0"><input type="number" class="form-control text-center" value="{{ $item->qty }}"id="qtyItem_{{$item->id}}" name="qty" min="1" max="10" required></p>
									<button class="btn btn-sm btn-hotel-2" style="margin-bottom: 2px;" type="submit">Sửa</button>
									<a href="{{ route('deleteCart', $item->id) }}" class="btn btn-sm btn-default-2" style="margin-bottom: 2px;">Xóa</a>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
			@endforeach

		</div>
	</div>
	<div class="col-sm-4">
		<div class="box-error " style="margin-top: 0px;">
			<div class="login-cart">
				<div class="item">
					<p class="title">
						<span>Tạm tính:	</span>
					</p>
					<p class="price"><span>{{number_format($total,0,",",".")}} đ</span></p>
					<div class="clear"></div>
				</div>
				<div class="item">
					<p class="title">
						<span><b>Thành tiền: </b></span>
					</p>
					<p class="price" style="color: red; font-size: 18px;">
						<span>{{number_format($total,0,",",".")}} đ</span>

					</p>
					<div class="clear"></div>
					<p class="text-right">(đã bao gồm VTA)</p>
				</div>
			</div>
		</div>

		<a href="{{route('payment')}}" class="btn btn-hotel-2 btn-block ">Đặt hàng</a>
		<a href="{{route('homepage')}}" class="btn btn-default-2 btn-block " style="border-radius: 0;">Tiếp tục mua hàng</a>
	</div>
</div>
@if($sanphamdaxem != null)
<div class="row">
	<div class="col-sm-12">
		<div class="wallpaper" style="margin: 80px 0px 10px 0px;">
			<div class="title">
				<h2> Sản phẩm đã xem </h2>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<div class="recommended_items"><!--recommended_items-->
					<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
						<div class="carousel-inner">
							<div class="item active">
								@foreach($sanphamdaxem as $sanphammoi)
									@if($loop->index < 4)
									<div class="col-xs-6 col-md-3 col-sm-4">
										<div class="product">
											@if($sanphammoi->sp_tinhTrang == 1)
											<span class="label_news <?php if($sanphammoi->sp_giamGia > 0) echo 'top_'; ?> ">
												<span class="bf_">Mới</span>
											</span>
											@endif
											@if($sanphammoi->sp_giamGia > 0)
											<span class="sale_count">
												<span class="bf_">
													-{{ round( 100 - ($sanphammoi->sp_giamGia * 100)/$sanphammoi->sp_giaBan) }}%
												</span>
											</span>
											@endif
											<img src="{{asset('public/images/products/'.$sanphammoi->sp_hinh)}}" alt="{{$sanphammoi->sp_ten}}" class="image">
											<div class="overlay">
												<div class="box">
													<div class="btn-detail">
														
														<div style="margin: 5px 0px 5px 0px;"></div>
														<a href="{{route('detail', $sanphammoi->sp_ma)}}" class="btn btn-detail-2"><i class="fa fa-eye" aria-hidden="true"></i></a>
														<div style="margin: 5px 0px 5px 0px;"></div>
														@if($sanphammoi->sp_soLuong > 0)
														<button type="button" class="btn btn-detail-2" ng-click="addToCart({{ $sanphammoi->sp_ma }}, 'view')"><i class="fa fa-shopping-basket" aria-hidden="true"></i></button>
														@endif
													</div>
												</div>
											</div>
											<div class="detail">
												<div class="title">{{$sanphammoi->sp_ten}}</div>
												<p class="price">
													@if($sanphammoi->sp_giamGia > 0)
														<span class="discount">{{number_format($sanphammoi->sp_giaBan, 0, ".", ",")}} <sup>đ</sup></span>&nbsp;
														<span>{{number_format($sanphammoi->sp_giamGia, 0, ".", ",")}} <sup>đ</sup></span>
													@else
														<span>{{number_format($sanphammoi->sp_giaBan, 0, ".", ",")}} <sup>đ</sup></span>
													@endif
												</p>
											</div>
										</div>
									</div>
									@endif
								@endforeach

							</div> 

							@if(count($sanphamdaxem) > 4)
							<div class="item">
								@foreach($sanphamdaxem as $sanphammoi)
									@if($loop->index >= 4)
									<div class="col-xs-6 col-md-3 col-sm-4">
										<div class="product">
											@if($sanphammoi->sp_tinhTrang == 1)
											<span class="label_news <?php if($sanphammoi->sp_giamGia > 0) echo 'top_'; ?> ">
												<span class="bf_">Mới</span>
											</span>
											@endif
											@if($sanphammoi->sp_giamGia > 0)
											<span class="sale_count">
												<span class="bf_">
													-{{ round( 100 - ($sanphammoi->sp_giamGia * 100)/$sanphammoi->sp_giaBan) }}%
												</span>
											</span>
											@endif
											<img src="{{asset('public/images/products/'.$sanphammoi->sp_hinh)}}" alt="{{$sanphammoi->sp_ten}}" class="image">
											<div class="overlay">
												<div class="box">
													<div class="btn-detail">
														
														<div style="margin: 5px 0px 5px 0px;"></div>
														<a href="{{route('detail', $sanphammoi->sp_ma)}}" class="btn btn-detail-2"><i class="fa fa-eye" aria-hidden="true"></i></a>
														<div style="margin: 5px 0px 5px 0px;"></div>
														@if($sanphammoi->sp_soLuong > 0)
														<button type="button" class="btn btn-detail-2" ng-click="addToCart({{ $sanphammoi->sp_ma }}, 'view')"><i class="fa fa-shopping-basket" aria-hidden="true"></i></button>
														@endif
													</div>
												</div>
											</div>
											<div class="detail">
												<div class="title">{{$sanphammoi->sp_ten}}</div>
												<p class="price">
													@if($sanphammoi->sp_giamGia > 0)
														<span class="discount">{{number_format($sanphammoi->sp_giaBan, 0, ".", ",")}} <sup>đ</sup></span>&nbsp;
														<span>{{number_format($sanphammoi->sp_giamGia, 0, ".", ",")}} <sup>đ</sup></span>
													@else
														<span>{{number_format($sanphammoi->sp_giaBan, 0, ".", ",")}} <sup>đ</sup></span>
													@endif
												</p>
											</div>
										</div>
									</div>
									@endif
								@endforeach
							</div>
							@endif
						</div>
						<a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
							<i class="fas fa-angle-left"></i>
						</a>
						<a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
							<i class="fas fa-angle-right"></i>
						</a>          
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endif
@else
<div class="row">
	<div class="col-sm-12">
		<div class="box-error emty-cart text-center" style="margin-top: 0px; border:none;">
			<div class="emty-cart-img"><img src="{{asset('public/images/layouts/cart.gif')}}" alt="emty cart"></div>
			<h3>Không có sản phẩm nào trong giỏ hàng của bạn.</h3><br/>
			<a href="{{route('getAllProducts')}}" class="btn btn-hotel-2">Tiếp tục mua sắm</a>
			<br/>
		</div>
	</div>
</div>
@endif




@endsection