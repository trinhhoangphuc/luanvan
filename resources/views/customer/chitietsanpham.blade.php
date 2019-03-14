@extends("layouts.customer.master")
@section('tieude')
	{{$sanpham->sp_ten}}
@endsection
@section("chitiet")
	active
@endsection
@section('content')
<div class="row">
	<div class="col-sm-12 col-xs-12 col-md-12">
		<div class="titleProducts">
			<a href="{{ route('homepage') }}"><i class="fas fa-home"></i> Trang chủ <i class="fa fa-angle-right" aria-hidden="true"></i></a> 
			<a href="{{ route('Category', $sanpham->l_ma) }}"> {{$sanpham->l_ten}} <i class="fa fa-angle-right" aria-hidden="true"></i></a>
			{{$sanpham->sp_ten}}
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-6">
		<div class="product-information2">
		
				<div class="show" href="{{ asset('public/images/products/' . $hinhanh[0]->ha_ten )}}" >
					<img  src="{{ asset('public/images/products/' . $hinhanh[0]->ha_ten )}}" id="show-img">
				</div>
	
			<div class="small-img">
				<img src="{{asset('public/libs/vendor/Product-Gallery-Image-Zoom/images/online_icon_right@2x.png')}}" class="icon-left" alt="" id="prev-img">
				<div class="small-container">
					<div id="small-img-roll">
						@foreach($hinhanh as $hinh)
						<img src="{{ asset('public/images/products/' . $hinh->ha_ten )}}" class="show-small-img" alt="">
						@endforeach
					</div>
				</div>
				<img src="{{asset('public/libs/vendor/Product-Gallery-Image-Zoom/images/online_icon_right@2x.png')}}" class="icon-right" alt="" id="next-img">
			</div>
		</div>

	</div>

	<div class="col-sm-6">
		<div class="product-information" style="font-size: 16px;">
			<h2>{{$sanpham->sp_ten}}</h2><br/>
			<p class="star">
				<input type="hidden" id="rate" class="rating" value="{{ $sanpham->sp_danhGia }}" data-readonly "/>
				<span>({{ $sanpham->sp_danhGia }}/5)</span>
				<!-- data-filled="symbol symbol-filled" data-empty="symbol symbol-empty -->
			</p>

			<p><b>Mã Sản Phẩm:</b> {{$sanpham->sp_ma}}</p>
			<p><b>Loại:</b> <a href="{{ route('Category', $sanpham->l_ma) }}">{{$sanpham->l_ten}}</a></p>
			<p><b>Hãng sản xuất:</b> <a href="{{ route('Brand', $sanpham->h_ma) }}">{{$sanpham->h_ten}}</a></p>
			<div class="price-discount">
				@if($sanpham->sp_giamGia > 0)
				<span class="discount">{{number_format($sanpham->sp_giaBan, 0, ".", ",")}} <sup>đ</sup></span>&nbsp;
				<span class="price">{{number_format($sanpham->sp_giamGia, 0, ".", ",")}} <sup>đ</sup></span>
				@else
				<span class="price">{{number_format($sanpham->sp_giaBan, 0, ".", ",")}} <sup>đ</sup></span>
				@endif
			</div>
			<br>
			<p style="font-size: 18px;">
				Mua hàng tại Redshop bạn hoàn toàn yên tâm, chúng tôi nói không với hàng giả, hàng nhái, với 6 cửa hàng mặt đường chính tại Hà Nội, Đà Nẵng và TP.HCM. Cam kết chất lượng 100%, quý khách phát hiện hàng giả đền 100 lần
			</p>
			
			<form method="post" action="">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<span>
					<label>Số lượng:</label>
					<input type="number" value="1" max="100" min="1" id="qty_{{$sanpham->sp_ma}}" name="qty" required />
				</span>&nbsp;&nbsp;&nbsp;
				<span>
					<select  name="mahuong" id="mahuong_{{$sanpham->sp_ma}}" required>
						@foreach($chitiethuongList as $cth)
						<option value="{{ $cth->hv_ma }}" >{{ $cth->hv_ten }}</option>
						@endforeach
					</select>
				</span>&nbsp;&nbsp;&nbsp;<br/><br/>
				@if($sanpham->sp_soLuong > 0)
				<button type="button" class="btn btn-hotel-2" ng-click="addToCart({{ $sanpham->sp_ma }}, 'multi')">
					<i class="fa fa-shopping-basket"></i>
					Thêm vào giỏ
				</button>
				@else
				<div class="price-discount">
					<span class="price">Hết hàng</span>
				</div>
				@endif
			</form>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12"> 
		<div class="card" >
			<ul class="nav nav-tabs" role="tablist">
				<li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab"><i class="fa fa-info"></i>  <span>Mô tả</span></a></li>
				<li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab"><i class="fa fa-comment"></i>  <span>Đánh giá</span></a></li>
			</ul>

			<!-- Tab panes -->
			<div class="tab-content">
				<div role="tabpanel" class="tab-pane active" id="home" style="text-align: left; padding: 10px 20px">
					{!! $sanpham->sp_thongTin !!}
				</div>
				<div role="tabpanel" class="tab-pane" id="profile">
					<div class="comments">
						<div class="col-sm-12">
							<div class="comment-wrap">
								@if(Session::has("customer_id"))
								<div class="photo">
									<div class="avatar" style="background-image: url('{{asset('public/images/avatar/customer/' .Session::get('customer_img'))}}')"></div>
								</div>
								<div class="comment-block">
									<form action="{{route('rate', $sanpham->sp_ma)}}" method="POST">
										<p class="product-information" style="padding: 0px 10px; text-align: left; border: none; ">
											<input type="hidden" name="_token" value="{{csrf_token()}}">
											<input type="hidden" name="rate" class="rating" value="0" />
											<textarea name="noiDung" id="noiDung" cols="30" rows="3" placeholder="Bình luận" required></textarea>
											<div style="margin-top:10px; float: right; margin-right: 12px;">
												<button type="submit" class="btn btn-hotel-2">Gửi đánh giá</button>
											</div>
										</p>
									</form>
								</div>
								@else
								<div class="photo"><div class="avatar"></div></div>
								<div class="comment-block">
									<p class="product-information" style="padding: 0px 10px; text-align: left !important; border: none; ">
										<p style="text-align: left !important;">
											<b>Vui lòng đăng nhập trước khi đánh giá!</b> 
											<a href="" ng-click="showLoginRegister('login')">Đăng nhập </a>
										</p>
									</p>
								</div>
								@endif
							</div>
						</div>

						@foreach($danhgiaList as $danhgia)
						<div class="col-sm-12 box-hidden">
							<div id="load-comment" class="comment-wrap ">
								<div class="photo">
									<div class="avatar" style="background-image: url('{{asset('public/images/avatar/customer/' . $danhgia->kh_hinh)}}')"></div>
								</div>
								<div class="comment-block">
									<p class="product-information" style="padding: 0px 10px; text-align: left; border: none; font-size: 15px;">
										@if($danhgia->dg_sao > 0)
										<input type="hidden"  class="rating" value="{{ $danhgia->dg_sao }}" data-readonly "/><br/>
										@endif
										{{$danhgia->dg_noiDung}}
									</p>

								</div>
							</div>
						</div>
						@endforeach
						
						@if(count($danhgiaList) > 4)
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
							<a id="loadmore" href="" ><span class="caret"></span> Xem Thêm <span class="caret"></span></a>
						</div>
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@if(count($sanphamcungloaiList) > 0)
<div class="row">
	<div class="col-sm-12">
		<div class="wallpaper">
			<div class="title">
				<h2> Sản phẩm cùng loại </h2>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<div class="recommended_items"><!--recommended_items-->
					<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
						<div class="carousel-inner">
							<div class="item active">
								@foreach($sanphamcungloaiList as $sanphammoi)
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
														<a href="{{route('detail', $sanphammoi->sp_ma)}}"" class="btn btn-detail-2"><i class="fa fa-eye" aria-hidden="true"></i></a>
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

							@if(count($sanphamcungloaiList) > 4)
							<div class="item">
								@foreach($sanphamcungloaiList as $sanphammoi)
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
														@if($item->sp_soLuong > 0)
														<button type="button" class="btn btn-detail-2" ng-click="addToCart({{ $item->sp_ma }}, 'single')"><i class="fa fa-shopping-basket" aria-hidden="true"></i></button>
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
@endsection