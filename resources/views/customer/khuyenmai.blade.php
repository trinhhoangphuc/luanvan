@extends("layouts.customer.master")

@section('tieude')
	Chương trình khuyến mãi
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
		<div class="titleProducts"><a href="{{ route('homepage') }}"><i class="fas fa-home"></i> Trang chủ <i class="fa fa-angle-right" aria-hidden="true"></i></a> Chương trình khuyến mãi</div>
	</div>
</div>

<div class="row">

	@include("layouts.customer.menu-left") <!--Menu bên trái-->

	<div class="col-sm-9">
		<div class="row">
			@if($khuyenmai != null)
				@foreach($khuyenmai as $km)
				<div class="col-sm-6">
					<div class="box-promotion">
						<a href="">
							<div class="title-promotion">
								<span>{{ $km->km_ten }}</span>&nbsp; @if($km->km_trangThai == 0)<span class="label label-danger">Hết hạn</span>@else <span class="label label-success">Còn hạn</span> @endif
							</div>
							<div class="user-promotion">
								<span><i class="far fa-user"></i> <b>{{ $km->nv_hoTen }}</b></span>&nbsp;&nbsp;&nbsp;
								<span><i class="far fa-clock"></i> {{ date_format($km->km_taoMoi,"d/m/Y H:i:s") }}</span>&nbsp;&nbsp;&nbsp;
							</div>
							<hr/>
							<div class="sort-discription">
								{!! $km->km_moTaNgan !!}
							</div>
							<br/>
						</a>
					</div>
					<br/>
				</div>

				@endforeach
			@else
				<h2>Chưa có chương trình khuyến mãi</h2>
			@endif
		</div>
		<div class="row">
			<div class="col-sm-12">{{ $khuyenmai->render() }}</div>
		</div>
	</div>
</div>
@endsection