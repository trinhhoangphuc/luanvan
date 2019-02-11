@extends("layouts.customer.master")
@section('content')
<div class="row">
	<div class="col-sm-12 col-xs-12 col-md-12">
		<div class="titleProducts"><a href="index.html"><i class="fas fa-home"></i> Trang chủ <i class="fa fa-angle-right" aria-hidden="true"></i></a> Tất cả sản phẩm</div>
	</div>
</div>

<div class="row">
	<div class="col-md-6">
		<div class="product-information2">
			<div class="show" href="{{asset('public/images/products/img1.jpg')}}" >
				<img  src="{{asset('public/images/products/img1.jpg')}}" id="show-img">
			</div>
			<div class="small-img">
				<img src="{{asset('public/libs/vendor/Product-Gallery-Image-Zoom/images/online_icon_right@2x.png')}}" class="icon-left" alt="" id="prev-img">
				<div class="small-container">
					<div id="small-img-roll">
						<img src="{{asset('public/images/products/img1.jpg')}}" class="show-small-img" alt="">
						<img src="{{asset('public/images/products/img2.jpg')}}" class="show-small-img" alt="">
						<img src="{{asset('public/images/products/img3.jpg')}}" class="show-small-img" alt="">
						<img src="{{asset('public/images/products/img4.jpg')}}" class="show-small-img" alt="">
						<img src="{{asset('public/images/products/img5.jpg')}}" class="show-small-img" alt="">
						<img src="{{asset('public/images/products/img6.jpg')}}" class="show-small-img" alt="">
					</div>
				</div>
				<img src="{{asset('public/libs/vendor/Product-Gallery-Image-Zoom/images/online_icon_right@2x.png')}}" class="icon-right" alt="" id="next-img">
			</div>
		</div>

	</div>

	<div class="col-sm-6">
		<div class="product-information">
			<!-- <img src="{{asset('public/images/layouts//new.jpg')}}')}}" class="newarrival" alt="" /> -->
			<h2>Máy Câu Cá Ngang Màu Vàng Đồng Yumoshi LV200</h2><br/>
			<p class="star">
				<span class="fa fa-star checked"></span>
				<span class="fa fa-star checked"></span>
				<span class="fa fa-star checked"></span>
				<span class="fa fa-star"></span>
				<span class="fa fa-star"></span>
			</p>
			<p><b>Mã Sản Phẩm:</b> #434</p>
			<p><b>Loại:</b> Cần hai khúc</p>
			<p><b>Hãng sản xuất:</b> Kastking</p>
			<div class="price-discount">
				<span  class="discount" >390,000 đ</span>&nbsp;&nbsp;
				<span class="price">500,000 đ</span>
			</div>
			<br>
			<form method="post" action="">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<span>
					<label>Số lượng:</label>
					<input type="number" value="1" max="100" min="1" id="" name="qty" />
				</span>&nbsp;&nbsp;&nbsp;
				<button type="submit" class="btn btn-hotel-2">
					<i class="fa fa-shopping-basket"></i>
					Thêm vào giỏ
				</button>
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
				<div role="tabpanel" class="tab-pane active" id="home" style="text-align: left">
					Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.<br/><br/>
					Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.<br/><br/>
					Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.<br/><br/>
				</div>
				<div role="tabpanel" class="tab-pane" id="profile">
					<div class="comments">
						<div class="comment-wrap">
							<div class="photo">
								<div class="avatar" style="background-image: url('https://s3.amazonaws.com/uifaces/faces/twitter/dancounsell/128.jpg')}}')"></div>
							</div>
							<div class="comment-block">
								<form action="">
									<textarea name="" id="" cols="30" rows="3" placeholder="Add comment..."></textarea>
									<div style="margin-top:10px; float: right">
										<button type="submit" class="btn btn-hotel-2">Gửi đánh giá</button>
									</div>
								</form>
							</div>
						</div>

						<div id="load-comment" class="comment-wrap">
							<div class="photo">
								<div class="avatar" style="background-image: url('https://s3.amazonaws.com/uifaces/faces/twitter/jsa/128.jpg')}}')"></div>
							</div>
							<div class="comment-block">
								<p class="comment-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto temporibus iste nostrum dolorem natus recusandae incidunt voluptatum. Eligendi voluptatum ducimus architecto tempore, quaerat explicabo veniam fuga corporis totam reprehenderit quasi
								sapiente modi tempora at perspiciatis mollitia, dolores voluptate. Cumque, corrupti?</p>
							</div>
						</div>

						<div id="load-comment" class="comment-wrap">
							<div class="photo">
								<div class="avatar" style="background-image: url('https://s3.amazonaws.com/uifaces/faces/twitter/felipenogs/128.jpg')}}')"></div>
							</div>
							<div class="comment-block">
								<p class="comment-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto temporibus iste nostrum dolorem natus recusandae incidunt voluptatum. Eligendi voluptatum ducimus architecto tempore, quaerat explicabo veniam fuga corporis totam.</p>
							</div>
						</div>

						<button class="btn bg-success-2 btn-block"> Xem thêm</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

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

								<div class="col-xs-6 col-md-3 col-sm-4">
									<div class="product">
										<span class="sale_count">
											<span class="bf_">Mới</span>
										</span>
										<span class="label_news top_">
											<span class="bf_">Mới</span>
										</span>
										<img src="{{asset('public/images/products/img1.jpg')}}" alt="Avatar" class="image">
										<div class="overlay">
											<div class="box">
												<div class="btn-detail">
													<a href="" class="btn btn-detail-2"><i class="fa fa-eye" aria-hidden="true"></i></a>
													<div style="margin: 5px 0px 5px 0px;"></div>
													<a href="" class="btn btn-detail-2"><i class="fa fa-shopping-basket" aria-hidden="true"></i></a>
												</div>
											</div>
										</div>
										<div class="detail">
											<div class="title">Máy Câu Cá Ngang Màu Vàng Đồng Yumoshi LV200</div>
											<p class="price">
												<span class="discount">1,000,000 đ</span>&nbsp;
												<span>500,000 đ</span>
											</p>
										</div>
									</div>
								</div>

								<div class="col-xs-6 col-md-3 col-sm-4">
									<div class="product">
										<span class="sale_count">
											<span class="bf_">-10%</span>
										</span>
										<img src="{{asset('public/images/products/img2.jpg')}}" alt="Avatar" class="image">
										<div class="overlay">
											<div class="box">
												<div class="btn-detail">
													<a href="" class="btn btn-detail-2"><i class="fa fa-eye" aria-hidden="true"></i></a>
													<div style="margin: 5px 0px 5px 0px;"></div>
													<a href="" class="btn btn-detail-2"><i class="fa fa-shopping-basket" aria-hidden="true"></i></a>
												</div>
											</div>
										</div>
										<div class="detail">
											<div class="title">Máy Câu Cá Ngang Màu Vàng Đồng Yumoshi LV200</div>
											<p class="price">
												<span class="discount">1,000,000 đ</span>&nbsp;
												<span>500,000 đ</span>
											</p>
										</div>
									</div>
								</div>

								<div class="col-xs-6 col-md-3 col-sm-4">
									<div class="product">
										<span class="label_news">
											<span class="bf_">Mới</span>
										</span>
										<img src="{{asset('public/images/products/img3.jpg')}}" alt="Avatar" class="image">
										<div class="overlay">
											<div class="box">
												<div class="btn-detail">
													<a href="" class="btn btn-detail-2"><i class="fa fa-eye" aria-hidden="true"></i></a>
													<div style="margin: 5px 0px 5px 0px;"></div>
													<a href="" class="btn btn-detail-2"><i class="fa fa-shopping-basket" aria-hidden="true"></i></a>
												</div>
											</div>
										</div>
										<div class="detail">
											<div class="title">Máy Câu Cá Ngang Màu Vàng Đồng Yumoshi LV200</div>
											<p class="price">
												<span class="discount">1,000,000 đ</span>&nbsp;
												<span>500,000 đ</span>
											</p>
										</div>
									</div>
								</div>

								<div class="col-xs-6 col-md-3 col-sm-4">
									<div class="product">
										<span class="sale_count">
											<span class="bf_">Mới</span>
										</span>
										<span class="label_news top_">
											<span class="bf_">Mới</span>
										</span>
										<img src="{{asset('public/images/products/img4.jpg')}}" alt="Avatar" class="image">
										<div class="overlay">
											<div class="box">
												<div class="btn-detail">
													<a href="" class="btn btn-detail-2"><i class="fa fa-eye" aria-hidden="true"></i></a>
													<div style="margin: 5px 0px 5px 0px;"></div>
													<a href="" class="btn btn-detail-2"><i class="fa fa-shopping-basket" aria-hidden="true"></i></a>
												</div>
											</div>
										</div>
										<div class="detail">
											<div class="title">Máy Câu Cá Ngang Màu Vàng Đồng Yumoshi LV200</div>
											<p class="price">
												<span class="discount">1,000,000 đ</span>&nbsp;
												<span>500,000 đ</span>
											</p>
										</div>
									</div>
								</div>

							</div>               
							<div class="item">

								<div class="col-xs-6 col-md-3 col-sm-4">
									<div class="product">
										<span class="sale_count">
											<span class="bf_">-10%</span>
										</span>
										<img src="{{asset('public/images/products/img5.jpg')}}" alt="Avatar" class="image">
										<div class="overlay">
											<div class="box">
												<div class="btn-detail">
													<a href="" class="btn btn-detail-2"><i class="fa fa-eye" aria-hidden="true"></i></a>
													<div style="margin: 5px 0px 5px 0px;"></div>
													<a href="" class="btn btn-detail-2"><i class="fa fa-shopping-basket" aria-hidden="true"></i></a>
												</div>
											</div>
										</div>
										<div class="detail">
											<div class="title">Máy Câu Cá Ngang Màu Vàng Đồng Yumoshi LV200</div>
											<p class="price">
												<span class="discount">1,000,000 đ</span>&nbsp;
												<span>500,000 đ</span>
											</p>
										</div>
									</div>
								</div>

								<div class="col-xs-6 col-md-3 col-sm-4">
									<div class="product">
										<span class="label_news">
											<span class="bf_">Mới</span>
										</span>
										<img src="{{asset('public/images/products/img6.jpg')}}" alt="Avatar" class="image">
										<div class="overlay">
											<div class="box">
												<div class="btn-detail">
													<a href="" class="btn btn-detail-2"><i class="fa fa-eye" aria-hidden="true"></i></a>
													<div style="margin: 5px 0px 5px 0px;"></div>
													<a href="" class="btn btn-detail-2"><i class="fa fa-shopping-basket" aria-hidden="true"></i></a>
												</div>
											</div>
										</div>
										<div class="detail">
											<div class="title">Máy Câu Cá Ngang Màu Vàng Đồng Yumoshi LV200</div>
											<p class="price">
												<span class="discount">1,000,000 đ</span>&nbsp;
												<span>500,000 đ</span>
											</p>
										</div>
									</div>
								</div>
								<div class="col-xs-6 col-md-3 col-sm-4">
									<a>
										<div class="product">
											<span class="label_news">
												<span class="bf_">Mới</span>
											</span>
											<img src="{{asset('public/images/products/img7.jpg')}}" alt="Avatar" class="image">
											<div class="overlay">
												<div class="box">
													<div class="btn-detail">
														<a href="" class="btn btn-detail-2"><i class="fa fa-eye" aria-hidden="true"></i></a>
														<div style="margin: 5px 0px 5px 0px;"></div>
														<a href="" class="btn btn-detail-2"><i class="fa fa-shopping-basket" aria-hidden="true"></i></a>
													</div>
												</div>
											</div>
											<div class="detail">
												<div class="title">Máy Câu Cá Ngang Màu Vàng Đồng Yumoshi LV200</div>
												<p class="price">
													<span class="discount">1,000,000 đ</span>&nbsp;
													<span>500,000 đ</span>
												</p>
											</div>
										</div>
									</a>
								</div>
								<div class="col-xs-6 col-md-3 col-sm-4">
									<div class="product">
										<span class="label_news">
											<span class="bf_">Mới</span>
										</span>
										<img src="{{asset('public/images/products/img8.jpg')}}" alt="Avatar" class="image">
										<div class="overlay">
											<div class="box">
												<div class="btn-detail">
													<a href="" class="btn btn-detail-2"><i class="fa fa-eye" aria-hidden="true"></i></a>
													<div style="margin: 5px 0px 5px 0px;"></div>
													<a href="" class="btn btn-detail-2"><i class="fa fa-shopping-basket" aria-hidden="true"></i></a>
												</div>
											</div>
										</div>
										<div class="detail">
											<div class="title">Máy Câu Cá Ngang Màu Vàng Đồng Yumoshi LV200</div>
											<p class="price">
												<span class="discount">1,000,000 đ</span>&nbsp;
												<span>500,000 đ</span>
											</p>
										</div>
									</div>
								</div>
							</div>
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