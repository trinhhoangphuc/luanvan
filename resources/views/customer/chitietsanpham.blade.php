@extends("layouts.customer.master")
@section('tieude')
	{{$sanpham->sp_ten}}
@endsection

@section("header")
	@include("layouts.customer.header")
@endsection

@section("chitiet")
	active
@endsection

@section("footer")
	@include("layouts.customer.footer")
@endsection

@section('content')

@if(session('success'))
<script >
	toastr.info("Cám ơn bạn đã đánh giá sản phẩm!");
</script>
@endif
@if(session('error'))
<script >
	toastr.warning("Không thể đánh giá sản phẩm!");
</script>
@endif
<script src='https://unpkg.com/spritespin@4.0.3/release/spritespin.js' type='text/javascript'></script>
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

			@if($sanpham->sp_anh360 == 0)
			<div id="slide">
				<div class="exzoom " id="exzoom">
					<div class="exzoom_img_box">
						<ul class='exzoom_img_ul'>
							@foreach($hinhanh as $hinh)
							<li><img src="{{ asset('public/images/products/' . $hinh->ha_ten )}}" class="show-small-img" alt=""></li>
							@endforeach
						</ul>
					</div>
					<div class="exzoom_nav"></div>
					<p class="exzoom_btn">
						<a href="javascript:void(0);" class="exzoom_prev_btn"> < </a>
						<a href="javascript:void(0);" class="exzoom_next_btn"> > </a>
					</p>
				</div>
			</div>
			@else

			<div id="360" class="">
				<div id='mySpriteSpin' class="spritespin"></div>	
			</div>
			@endif

			<!-- <br/>
			<button id="slideBTN" type="button" class="btn btn-flat btn-hotel-2" onclick="slide360('slide')"><i class="far fa-images"></i></button>
			<button type="button" class="btn btn-flat btn-hotel-2" onclick="slide360('360')"><i class="fas fa-arrows-alt-h"></i></button> -->
			

		</div>

	</div>

	<div class="col-sm-6">
		<div class="product-information" style="font-size: 16px;">
			<h2>{{$sanpham->sp_ten}}</h2><br/>
			<p class="star">
				<input type="hidden" id="rate" class="rating" value="{{ $sanpham->sp_danhGia }}" data-readonly />
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
						<div class="row">
							<div class="col-sm-12">
								<h3 style="text-align: left !important; color: #478524;">Nhận xét, đánh giá ({{count($danhgiaList)}} lượt)</h3>
								<div class="alert-order" style="text-align: left !important; background: #D5F1E1; color: #444; border-radius: 0px; margin-bottom: 10px;">
									Nếu bạn có bất cứ thắc mắc gì về sản phẩm này hoặc bạn muốn đặt hàng hãy Viết Comment dưới đây, mỗi đóng góp của bạn đều rất ý nghĩa với Redshop.
								</div>
								<button class="btn btn-block btn-hotel-3" style="text-align: left !important;" data-toggle="modal" data-target="#postRate">
									Đánh giá và viết coment của bạn tại đây
								</button>
							</div>
						</div>
						<br/>
						@foreach($danhgiaList as $danhgia)
						<div class="col-sm-12 box-hidden">
							<div id="load-comment" class="comment-wrap ">
								<div class="photo">
									<div class="avatar" style="background-image: url('{{asset('public/images/avatar/customer/user.png')}}')"></div>
								</div>
								<div class="comment-block">
									<p class="product-information" style="padding: 0px 10px; text-align: left; border: none; font-size: 15px;">
										<b>{{ $danhgia->kh_ten }}</b> - <span style="font-size: 13px !important;">{{ $danhgia->dg_taoMoi->format('d/m/Y H:m:s') }}</span><br/>
										@if($danhgia->dg_sao > 0)
										<input type="hidden"  class="rating" value="{{ $danhgia->dg_sao }}" data-readonly /><br/>
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
@endif

<div id="postRate" class="modal modal-2 fade" role="dialog">
	<div class="modal-dialog">				
		<div class="modal-content" style="width: 100%;">
			<div class="imgcontainer" style="width: 100%; padding: 5px 10px;">
				<span class="close" data-dismiss="modal" title="Close Modal">&times;</span>
				<h3 class="text-left">Đánh giá sản phẩm này</h3>
			</div>

			<div class="modal-body">
				<form method="POST" name="frmpostRate" id="frmpostRate" action="{{route('rate', $sanpham->sp_ma)}}">
					<input type="hidden" name="_token" value="{{csrf_token()}}">
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<input id="name" type="text" class="form-control" name="name" placeholder="Họ tên của bạn" value="<?php  if(Session::has('customer_id')) echo Session::get('customer_name'); ?>" <?php  if(Session::has('customer_id')) echo "readonly"; ?> />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<input id="phone" type="text" class="form-control" name="phone" placeholder="Số điện thoại" value="<?php  if(Session::has('customer_id')) echo Session::get('customer_phone'); ?>" <?php  if(Session::has('customer_id')) echo "readonly"; ?> />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<p>Bạn hãy nhập <span style="color: #E71640">số điện thoại</span> bạn đang dùng để Redshop tiện theo dõi. Số điện thoại của bạn sẽ được chúng tôi bảo mật, cam kết không để lộ thông tin.</p>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<div class="form-group">
								<textarea class="form-control" name="noiDung" id="noiDung" rows="5" placeholder="Nội dụng" ></textarea>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-sm-12">
							<div class="form-group">
								<p>Mời bạn đánh giá (1 - 5 sao) sản phẩm này giúp chúng tôi</p>
								<p class="product-information" style="padding: 0px; font-size: 15px; text-align: left; border: none; ">
									<input type="hidden" name="rate" class="rating" value="0" />
								</p>
							</div>
						</div>
					</div>

					<button type="submit" class="btn btn-hotel-2" style="border-radius: 4px;">Gửi ngay</button>
				</form> 
				<hr/>
				<p>Xin chân thành cảm ơn!</p>
			</div>

		</div>
	</div>
</div>
<script type='text/javascript'>
	var dsHinh = <?php echo $hinhanh; ?>;
	var test = [];
	for (i=0; i<dsHinh.length; i++) {
		url_hinh = "http://localhost/luanvan/public/images/products/" + dsHinh[i].ha_ten;
		test.push(url_hinh);
	}
	$('.spritespin').spritespin({
		source: test,

		sense: -1,
		responsive: true,
		animate: false,
		plugins: [
		'360',
		'drag'
		]
	});
	
	// function slide360(status) {
	// 	switch(status){
	// 		case "slide":
	// 			$("#slide").removeClass("hidden");
	// 			$("#360").addClass("hidden");
	// 		break;
	// 		case "360":

	// 			$("#360").removeClass("hidden");
	// 			$("#slide").addClass("hidden");
	// 			for (i=0; i<dsHinh.length; i++) {
	// 				url_hinh = "http://localhost/luanvan/public/images/products/" + dsHinh[i].ha_ten;
	// 				test.push(url_hinh);
	// 			}
	// 			$('.spritespin').spritespin({
	// 				source: test,

	// 				sense: -1,
	// 				responsive: true,
	// 				animate: false,
	// 				plugins: [
	// 				'360',
	// 				'drag'
	// 				]
	// 			});
	// 		break;
	// 	}
	// }
	// $(document).ready(function() {
		
	// 	$("#slideBTN").click(function() {
	// 		// body...
	// 	});
	// });

	

</script>
@endsection