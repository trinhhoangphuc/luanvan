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
		<div class="titleProducts"><a href="{{ route('homepage') }}"><i class="fas fa-home"></i> Trang chủ <i class="fa fa-angle-right" aria-hidden="true"></i></a> Tất cả sản phẩm</div>
	</div>
</div>

<div class="row">

	@include("layouts.customer.menu-left") <!--Menu bên trái-->

	<div class="col-sm-9">
		<div class="row">
			
		</div>
	</div>
</div>
@endsection