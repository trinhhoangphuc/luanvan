@extends("layouts.customer.master")
@section('tieude')
	Redshop.vn
@endsection
@section("trangchu")
	active
@endsection
@section("banner")
	
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 0px;">
		<div class="banner" style="min-height: 50px;">
			<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
				<!-- Indicators -->
				<ol class="carousel-indicators">
					@foreach($bannerList as $banner)
						@if($loop->index == 0)
						<li data-target="#carousel-example-generic" data-slide-to="{{ $loop->index }}" class="active"></li>
						@else
						<li data-target="#carousel-example-generic" data-slide-to="{{ $loop->index }}"></li>
						@endif
					@endforeach
				</ol>

				<!-- Wrapper for slides -->
				<div class="carousel-inner" role="listbox">
					@foreach($bannerList as $banner)
						@if($loop->index == 0)
						<div class="item active">
							<img src="{{asset('public/images/banner/'.$banner->bn_hinh )}}" alt="">
						</div>
						@else
						<div class="item">
							<img src="{{asset('public/images/banner/'.$banner->bn_hinh )}}" alt="">
						</div>
						@endif
					@endforeach
				</div>

				<!-- Controls -->
				<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
					<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
					<span class="sr-only">Previous</span>
				</a>
				<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
					<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
					<span class="sr-only">Next</span>
				</a>
			</div>  
		</div>
	</div>

@endsection
@section('content')


<div class="row" >
	<div class="col-md-6">
		<div class="asks-first">
			<div class="asks-first-circle">
				<span class="fa fa-check-circle" style=" vertical-align: middle;"></span>
			</div>
			<div class="asks-first-info">
				<h2>Đảm bảo chất lượng</h2>
				<p>100% nhập khẩu chính hãng, có tem bảo hành</p>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="asks-first2">
			<div class="asks-first-circle">
				<span class="fas fa-dollar-sign" style=" vertical-align: middle;"></span>

			</div>
			<div class="asks-first-info">
				<h2>Tiết kiệm chi phí</h2>
				<p>Giá cả siêu rẻ so với giá thị trường</p>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-sm-12">
		<div class="wallpaper">
			<div class="title">
				<h2> Sản phẩm bán chạy </h2>
			</div>
		</div>
		<br/>

		<div class="row">
			@foreach($sanphambanchayList as $sanphambanchay)
			<div class="col-xs-6 col-md-3 col-sm-4 box-hidden">
				<div class="product">
					@if($sanphambanchay->sp_tinhTrang == 1)
					<span class="label_news <?php if($sanphambanchay->sp_giamGia > 0) echo 'top_'; ?> ">
						<span class="bf_">Mới</span>
					</span>
					@endif
					@if($sanphambanchay->sp_giamGia > 0)
					<span class="sale_count">
						<span class="bf_">
							-{{ round( 100 - ($sanphambanchay->sp_giamGia * 100)/$sanphambanchay->sp_giaBan) }}%
						</span>
					</span>
					@endif
					<img src="{{asset('public/images/products/'.$sanphambanchay->sp_hinh)}}" alt="{{$sanphambanchay->sp_ten}}" class="image">
					<div class="overlay">
						<div class="box">
							<div class="btn-detail">
								
								<div style="margin: 5px 0px 5px 0px;"></div>
								<a href="{{route('detail', $sanphambanchay->sp_ma)}}" class="btn btn-detail-2"><i class="fa fa-eye" aria-hidden="true"></i></a>
								<div style="margin: 5px 0px 5px 0px;"></div>
								@if($sanphambanchay->sp_soLuong > 0)
								<button type="button" class="btn btn-detail-2" ng-click="addToCart({{ $sanphambanchay->sp_ma }}, 'single')"><i class="fa fa-shopping-basket" aria-hidden="true"></i></button>
								@endif
							</div>
						</div>
					</div>
					<div class="detail">
						<div class="title">{{$sanphambanchay->sp_ten}}</div>
						<p class="price">
							@if($sanphambanchay->sp_giamGia > 0)
							<span class="discount">{{number_format($sanphambanchay->sp_giaBan, 0, ".", ",")}} <sup>đ</sup></span>&nbsp;
							<span>{{number_format($sanphambanchay->sp_giamGia, 0, ".", ",")}} <sup>đ</sup></span>
							@else
							<span>{{number_format($sanphambanchay->sp_giaBan, 0, ".", ",")}} <sup>đ</sup></span>
							@endif
						</p>
					</div>
				</div>
			</div>
			@endforeach
			
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
				<a id="loadmore" href="" ><span class="caret"></span> Xem Thêm <span class="caret"></span></a>
			</div>
		</div>
	</div>

</div>

<div class="row">
	<div class="col-sm-12">
		<div class="wallpaper">
			<div class="title">
				<h2> Sản phẩm Mới </h2>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<div class="recommended_items"><!--recommended_items-->
					<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
						<div class="carousel-inner">

							<div class="item active">
								@foreach($sanphammoiList as $sanphammoi)
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
														<button type="button" class="btn btn-detail-2" ng-click="addToCart({{ $sanphammoi->sp_ma }}, 'single')"><i class="fa fa-shopping-basket" aria-hidden="true"></i></button>
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

							@if(count($sanphammoiList) > 4)
							<div class="item">
								@foreach($sanphammoiList as $sanphammoi)
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
														<button type="button" class="btn btn-detail-2" ng-click="addToCart({{ $sanphammoi->sp_ma }}, 'single')"><i class="fa fa-shopping-basket" aria-hidden="true"></i></button>
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
@endsection