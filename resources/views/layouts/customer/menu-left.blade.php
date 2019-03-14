<div class="col-sm-3">
	<div class="category">
		<div class="category-brand">
			Lọc dữ liệu
		</div>
		<br/>
		<form>
			<div class="form-group ">
				<label for="loai">Danh mục</label>
				<select class="form-control" id="loai" name="loai">
					<option value="0">--Tất cả--</option>
					@foreach($loaiList as $loai)
					<option value="{{ $loai->l_ma }}">{{ $loai->l_ten }}</option>
					@endforeach				
				</select> 
			</div>

			<div class="form-group ">
				<label for="chuDe">Nhà sản xuất</label>
				<select class="form-control" id="hang" name="hang">
					<option value="0">--Tất cả--</option>
					@foreach($nhasanxuatList as $nsx)
					<option value="{{ $nsx->h_ma }}">{{ $nsx->h_ten }}</option>
					@endforeach	
				</select> 
			</div>


			<div class="form-group ">
				<label for="giaTu">Giá Từ</label>
				<div class="range range-danger">
					<input type="range" name="giatu" id="giaTu" min="{{ $min }}" max="{{ $max }}" value="{{ $max - $min * 3 }}" onchange="rangeSuccess.value=value">
					<output id="rangeSuccess">{{ $max - $min * 3 }}</output>
				</div>
			</div>

			<div class="form-group ">
				<label for="giaDen">Giá Đến</label>
				<div class="range range-danger">
					<input type="range" name="giaden" id="giaDen"  min="{{ $min }}" max="{{ $max }}" value="{{ $max - $min }}" onchange="rangeInfo.value=value">
					<output id="rangeInfo">{{ $max - $min }}</output>
				</div>
			</div>

			<button class="btn btn-hotel-2 btn-block" style="margin: 5px 0px 5px 0px" type="button" id="btnFilter" ng-click="filterSP()">Tìm Kiếm</button>
		</form>
	</div>
	<br/><br/>
	<div class="category">
		<div class="category-brand">
			Sản Phẩm Mới
		</div>
		@foreach($sanphamAutoList as $item)
		<div class="row">
			<div class="hidden-xs col-md-11 col-md-11">
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
								<a href="{{route('detail', $item->sp_ma)}}"" class="btn btn-detail-2"><i class="fa fa-eye" aria-hidden="true"></i></a>
								<div style="margin: 5px 0px 5px 0px;"></div>
								@if($item->sp_soLuong > 0)
								<button type="button" class="btn btn-detail-2" ng-click="addToCart({{ $item->sp_ma }})"><i class="fa fa-shopping-basket" aria-hidden="true"></i></button>
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
			<div class="col-sm-1"></div>
		</div>
		@endforeach
	</div>
</div>