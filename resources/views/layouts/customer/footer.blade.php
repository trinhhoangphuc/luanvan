<a id="back-to-top" href="#" class="btn back-to-top" role="button"><i class="fa fa-angle-double-up"></i></a>
<footer>
	<div class="footer-top-area">
		<div class="zigzag-bottom"></div>
		<div class="container">
			<div class="row">
				<div class="col-md-3 col-sm-6">
					<div class="footer-about-us">
						<h2>R<span>edshop.vn</span></h2>
						<p>Redshop được thành lập như là một địa chỉ bán hàng online đã được đăng ký với bộ công thương, đi kèm theo đó là 1 Showroom trưng bày sản phẩm để phục vụ và tạo niềm tin cho khách hàng khi mua sản phẩm.</p>
						<div class="footer-social">
							<a href="#" target="_blank"><i class="fab fa-facebook-square"></i></a>
							<a href="#" target="_blank"><i class="fab fa-twitter-square"></i></a>
							<a href="#" target="_blank"><i class="fab fa-youtube"></i></a>
							<a href="#" target="_blank"><i class="fab fa-linkedin"></i></a>
						</div>
					</div>
				</div>

				<div class="col-md-3 col-sm-6">
					<div class="footer-menu">
						<h2 class="footer-wid-title">Danh Mục </h2>
						<ul>

							@foreach($loaiList as $loai)
							<li class=''><a href="{{route('Category', $loai->l_ma)}}"> {{ $loai->l_ten }}</a></li>
							@endforeach

						</ul>                        
					</div>
				</div>

				<div class="col-md-3 col-sm-6">
					<div class="footer-menu">
						<h2 class="footer-wid-title">Hãng Sãn Xuất</h2>
						<ul>

							@foreach($nhasanxuatList as $nhasanxuat)
							<li class=''><a href="{{route('Brand', $nhasanxuat->h_ma)}}"> {{ $nhasanxuat->h_ten }}</a></li>
							@endforeach
						</ul>                        
					</div>
				</div>

				<div class="col-md-3 col-sm-6">
					<div class="footer-menu">
						<h2 class="footer-wid-title">Liên Hệ</h2>
						<ul>
							<li><a href="" >
								<i class="fa fa-map-marker fa-2x" aria-hidden="true"></i>&nbsp;&nbsp;378M9/7A Nguyễn Văn Linh
							</a></li>
							<li><a href=""><i class="fa fa-phone fa-2x" aria-hidden="true"></i>&nbsp;&nbsp;0123-456-789</a></li>
							<li><a href=""><i class="fa fa-envelope fa-2x" aria-hidden="true"></i>&nbsp;&nbsp;fishing@info.com</a></li>
						</ul>                        
					</div>
				</div>
			</div>
		</div>
	</div> <!-- End footer top area -->
	<div class="footer-bottom-area">
		<div class="container">
			<div class="row">
				<div class="col-md-8">
					<div class="copyright">
						<p>&copy; 2015 uCommerce. All Rights Reserved. <a href="http://www.freshdesignweb.com" target="_blank">freshDesignweb.com</a></p>
					</div>
				</div>

				<div class="col-md-4">
					<div class="footer-card-icon">
						<i class="fab fa-cc-discover"></i>
						<i class="fab fa-cc-mastercard"></i>
						<i class="fab fa-cc-paypal"></i>
						<i class="fab fa-cc-visa"></i>
					</div>
				</div>
			</div>
		</div>
	</div> <!-- End footer bottom area -->
</footer>