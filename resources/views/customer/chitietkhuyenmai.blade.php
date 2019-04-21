@extends("layouts.customer.master")

@section('tieude')
	{{$khuyenmai->km_ten}}
@endsection

@section("header")
	@include("layouts.customer.header")
@endsection

@section("khuyemmai")
	active
@endsection

@section("footer")
	@include("layouts.customer.footer")
@endsection

@section('content')

<div class="row">
	<div class="col-sm-12 col-xs-12 col-md-12">
		<div class="titleProducts"><a href="{{ route('homepage') }}"><i class="fas fa-home"></i> Trang chủ <i class="fa fa-angle-right" aria-hidden="true"></i></a> <a href="{{ route('getKhuyenmai') }}"> Khuyến mãi <i class="fa fa-angle-right" aria-hidden="true"></i></a> {{$khuyenmai->km_ten}} </div>
	</div>
</div>

<div class="row">

	@include("layouts.customer.menu-left") <!--Menu bên trái-->

	<div class="col-sm-9">
		<div class="row">
			<div class="col-sm-12">
				<div class="title-detail-promotion">
					<span>{{ $khuyenmai->km_ten }}</span>&nbsp; @if($khuyenmai->km_trangThai == 0)<span class="label label-danger">Hết hạn</span>@else <span class="label label-success">Còn hạn</span> @endif
				</div>
				<div class="user-promotion">
					<span><i class="far fa-user"></i> <b>{{ $khuyenmai->nv_hoTen }}</b></span>&nbsp;&nbsp;&nbsp;
					<span><i class="far fa-clock"></i> {{ date_format($khuyenmai->km_taoMoi,"d/m/Y H:i:s") }}</span>&nbsp;&nbsp;&nbsp;
				</div>
				<div class="user-promotion">
					<span><i class="far fa-clock"></i> Bắt đầu: {{ date_format($khuyenmai->km_batDau,"d/m/Y") }}</span> - 
					<span><i class="far fa-clock"></i> Kết thúc: {{ date_format($khuyenmai->km_ketThuc,"d/m/Y") }}</span>&nbsp;&nbsp;&nbsp;
				</div>
				<hr/>
				<div class="discription">
					{!! $khuyenmai->km_noiDung !!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection