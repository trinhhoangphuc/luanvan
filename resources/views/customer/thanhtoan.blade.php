@extends("layouts.customer.master")

@section('tieude')
Thanh toán
@endsection

@section("header")
	@include("layouts.customer.header")
@endsection

@section("footer")
	@include("layouts.customer.footer")
@endsection

@section('content')

<div class="row">
	<div class="col-sm-12 col-xs-12 col-md-12">
		<div class="titleProducts"><a href="{{ route('homepage') }}"><i class="fas fa-home"></i> Trang chủ <i class="fa fa-angle-right" aria-hidden="true"></i></a> Thanh toán</div>
	</div>
</div>

<div class="row">
	<div class="col-sm-7">
		<div class="box-error" style="margin-top: 0px; box-shadow: none;">
			<div class="login-cart">
				<div class="order">
					<span  class="title">Địa chỉ giao hàng</span>
				</div>
				<div class="address-item" style="padding: 5px;">
					<form id="form-payment" name="form-payment" class="" role="form" action="{{route('postPayment')}}" method="POST">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="form-group">
							<label for="name">Họ & Tên:</label>
							<input id="name3" type="text" class="form-control border-radis-none" name="name" placeholder="Email" value="{{$khachhang->kh_hoTen}}" />
						</div>
						<div class="form-group">
							<label for="phone">Điện Thoại:</label>
							<input id="phone3" type="text" class="form-control border-radis-none" name="phone" placeholder="0123456"  value="{{$khachhang->kh_dienThoai}}" />
						</div>
						<div class="form-group">
							<label for="address">Địa chỉ:</label>
							<input id="address3" type="text" class="form-control border-radis-none" name="address" placeholder="Nhập địa chỉ" value="{{$khachhang->kh_diaChi}}"/>
						</div>
					
				</div>
			</div>
		</div>
		<div class="panel panel-default payment">
			<div class="panel-body">
				
					
					<h3 class="step-title">1. Chọn hình thức vận chuyển</h3>
					<div class="panel panel-default">
						<div class="panel-body">
							<div class="col-sm-12">     

								@foreach($vanchuyenList as $tt)
									@if($loop->index == 0)
									<label class="radio"> <img src="{{asset('public/images/layouts/icon-sc.png')}}"> {{ $tt->vc_ten }} <span style="color: red">{{number_format($tt->vc_gia,0,",",".")}} đ</span>
										<input type="radio" checked="checked" id="vc_{{ $tt->vc_ma }}" name="transport" value="{{ $tt->vc_ma }}" onclick="changeVC({{ $tt->vc_ma }});" />
										<span class="checkround"></span>
									</label>
									<br/>  
									@else
									<label class="radio"> <img src="{{asset('public/images/layouts/icon-sc.png')}}"> {{ $tt->vc_ten }} <span style="color: red">{{number_format($tt->vc_gia,0,",",".")}} đ</span>
										<input type="radio" id="vc_{{ $tt->vc_ma }}" name="transport" value="{{ $tt->vc_ma }}" onclick="changeVC({{ $tt->vc_ma }});" />
										<span class="checkround"></span>
									</label>
									<br/>  
									@endif
								@endforeach      

							</div>
						</div>
					</div>
					<h3 class="step-title">2. Chọn hình thức thanh toán</h3>
					<div class="panel panel-default">
						<div class="panel-body">
							<div class="col-sm-12">

								@foreach($thanhtoanList as $tt)
									@if ($tt->tt_ma != 1)
									<label class="radio"> {{ $tt->tt_ten }} 
										<input type="radio" checked="checked" id="pay_{{ $tt->tt_ma }}" name="payment" value="{{ $tt->tt_ma }}" onclick="changeTT({{ $tt->tt_ma }});">
										<span class="checkround"></span>
									</label>
									<br/>  
									@else
									<label class="radio"> <img src="{{asset('public/images/layouts/paypal.png')}}" width="100px" />
										<input type="radio" id="pay_{{ $tt->tt_ma }}" name="payment" value="{{ $tt->tt_ma }}" onclick="changeTT({{ $tt->tt_ma }});">
										<span class="checkround"></span>
									</label>
									<br/>  
									@endif
								@endforeach 

							</div>
						</div>
					</div>
					
					<button class="btn btn-hotel-2" id="btn-payment" style="width: 40%;" type="submit"> Đặt Mua</button>
					<div id="paypal-button-container" class="hidden" ></div>
				</form>
			</div>
		</div>

	</div>
	<div class="col-sm-5">
		<div class="box-error" style="margin-top: 0px; margin-bottom: 10px; box-shadow: none;">
			<div class="login-cart">
				<div class="order">
					<span  class="title">Thông tin người mua</span>	
				</div>
				<div class="address-item" style="padding: 5px;">
					<p class="name">{{$khachhang->kh_hoTen}}</p>
					<p class="address" title="">Địa chỉ: {{$khachhang->kh_diaChi}}</p>
					<p class="phone">Điện thoại: {{$khachhang->kh_dienThoai}}</p>
				</div>
			</div>
		</div>
		
		<div class="box-error" style="margin-top: 0px; box-shadow: none;">
			<div class="login-cart">
				<div class="order">
					<span  class="title">Đơn hàng ( {{count($cart)}} sản phẩm)</span>
					<a class="btn pull-right btn-hotel-2" href="{{route('getCart')}}">Sửa</a>
				</div>
				@foreach($cart as $item)
				<div class="item">
					<p class="title">
						<img src="{{asset('public/images/products/'. $item->options->img )}}" alt="{{ $item->name }}" width="20%;">
						<strong>{{ $item->qty }} x </strong>
						<a href="{{ route('detail', $item->id) }}">{{ $item->name }}</a>
					</p>
					@if($item->options->discount > 0)			
					<p class="price"><br/><span>{{number_format($item->options->discount * $item->qty,0,",",".")}} đ</span></p>
					<div class="clear"></div>
					@else
					<p class="price"><br/><span>{{number_format($item->options->price_2 * $item->qty,0,",",".")}} đ</span></p>
					<div class="clear"></div>
					@endif
					<div class="clear"></div>
				</div>
				@endforeach
				<div class="item">
					<p class="title">
						<span>Tạm tính:	</span>
					</p>
					<p class="price"><span>{{number_format($total,0,",",".")}} đ</span></p>
					<p class="title">
						<span>Vận chuyển: </span>
					</p>
					@foreach($vanchuyenList as $item)
						@if($loop->index == 0)
						<?php 
							$tong = $total; 
							$tong += $item->vc_gia;
						?>
						<p class="price"><span id="vcid">{{number_format($item->vc_gia,0,",",".")}} đ</span></p>
						@endif
					@endforeach
					<div class="clear"></div>
				</div>
				<div class="item">
					<p class="title">
						<span><b>Tổng tiền:	</b></span>
					</p>
					<p class="price" style="color: red; font-size: 18px;">
						<span id="totalID">{{number_format($tong,0,",",".")}} đ</span>
					</p>
					<div class="clear"></div>
				</div>
			</div>
		</div>
	</div>
	  
</div>
<script>

	var vanchuyenList = <?php echo $vanchuyenList; ?>;
	var thanhtoanList = <?php echo $thanhtoanList; ?>;
	var $tong_2 = <?php echo $total; ?>;

	function formatNumber(nStr, decSeperate, groupSeperate) {
        nStr += '';
        x = nStr.split(decSeperate);
        x1 = x[0];
        x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + groupSeperate + '$2');
        }
        return x1 + x2;
    }

	function changeVC(id){
		for( i=0; i<vanchuyenList.length; i++){
			if(vanchuyenList[i].vc_ma == id){
				$gia = vanchuyenList[i].vc_gia;
				$tongtien = $tong_2 + $gia;
				$("#totalID").text( formatNumber($tongtien, ',', '.') + " đ");
  				$("#vcid").text( formatNumber($gia, ',', '.') + " đ" );
  				break;
			}
		}
	}

	function changeTT(id){
		for( i=0; i<thanhtoanList.length; i++){
			if(thanhtoanList[i].tt_ma == 1 && id == 1){
				$("#paypal-button-container").removeClass("hidden");
				$("#btn-payment").addClass("hidden");
  				break;
			}else{
				$("#paypal-button-container").addClass("hidden");
				$("#btn-payment").removeClass("hidden");
  				break;
			}
		}
	}
</script>
<script src="https://www.paypalobjects.com/api/checkout.js"></script>
<script>

	paypal.Button.render({
		env: 'sandbox',

		// style: {
		// 	layout: 'horizontal',
		// 	size: 'medium',
		// 	shape: 'pill',
		// 	color: 'gold'
		// },
		style: {
			color:  'gold',
			shape:  'pill',
			label:  'pay',
			height: 40
		},

		funding: {
			allowed: [
			paypal.FUNDING.CARD,
			paypal.FUNDING.CREDIT
			],
			disallowed: []
		},

		client: {
			sandbox: 'AS9FRbEqsg1ex9bmexC1ShHxK6RBVnhPwM6tQYd2H9zyZlzvRu9Yf9BBsqlZlSLuuSQ9blUgi8ocxJWa',
			production: '9PH06259G4965803L'
		},

		payment: function(data, actions) {



			<?php $test = 0; ?>
			@foreach($cart as $item)

				<?php
				if($item->options->discount > 0)	
					$tiendo =  round($item->options->discount/ 23189.96);
				else
					$tiendo =  round($item->options->price_2/ 23189.96);
					$test = $test + ($tiendo * $item->qty);
				?>			
			@endforeach
			
			for(var i=0; i<vanchuyenList.length; i++){
				if($("#vc_"+vanchuyenList[i].vc_ma).prop("checked") == true){
					gia = Math.floor(vanchuyenList[i].vc_gia/ 23189.96);
					test = <?php  echo $test; ?> + gia;
					break;
				}
			}

			return actions.payment.create({
				transactions: [{
					item_list: {
						<?php $tongtien = 0; ?>
						items: [
						@foreach($cart as $item)
						{
							<?php
							if($item->options->discount > 0)	
								$tiendo =  round($item->options->discount/ 23189.96);
							else
								$tiendo =  round($item->options->price_2/ 23189.96);
							$tongtien = $tongtien + ($tiendo * $item->qty);
							?>
							name: '{{$item->name}}',
							quantity: '{{$item->qty}}',
							price: '{{$tiendo}}',
							tax: '0.01',
							sku: '1',
							currency: 'USD'
						},
						@endforeach
						],

						shipping_address: {
							recipient_name: 'Trịnh Hoàng Phúc',
							line1: 'Cần Thơ',
							line2: 'Ninh Kiều',
							city: 'San Jose',
							country_code: 'US',
							postal_code: '95131',
							phone: '0368060988',
							state: 'CA'
						}
					},
					amount: {
						<?php $test = $tongtien + 2; ?>
						total: test,
						currency: 'USD',
						details: {
							subtotal: '{{$tongtien}}',
							shipping: gia
						}
					},

					description: 'The payment transaction description.',
					custom: '90048630024435',
					payment_options: {
						allowed_payment_method: 'INSTANT_FUNDING_SOURCE'
					},
					soft_descriptor: 'ECHI5786786',


				}],
				note_to_payer: 'Contact us for any questions on your order.'
			});
		},


		onAuthorize: function (data, actions) {
			return actions.payment.execute()
			.then(function () {
				$.ajax({
					url: '{{route("postPayment")}}',
					type: "POST",
					data:{
						'name' :  		$("#name3").val(),
						'phone' : 		$("#phone3").val(),
						'address' : 	$("#address3").val(),
						'transport' :   $('[name="transport"]:radio:checked').val(),
						'payment' : 	$('[name="payment"]:radio:checked').val(),
					},
					headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
					success: function(data)
					{
						if(data.message != 0){

							location.href = URL_2 + "thanh-toan-thanh-cong/"+data.message;
						}
					},
					error: function(data)
					{
						console.log(data);
					}
				});

			
			});
		}
	}, '#paypal-button-container');
</script>
@endsection