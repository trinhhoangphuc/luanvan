@extends("layouts.customer.master")
@section('tieude')
	Thông tin chi tiết đơn hàng
@endsection
@section("danhmuc")

@endsection
@section('content')
<div class="row">
	<div class="col-sm-12 col-xs-12 col-md-12">
		<div class="titleProducts"><a href="{{ route('homepage') }}"><i class="fas fa-home"></i> Trang chủ <i class="fa fa-angle-right" aria-hidden="true"></i></a><a href="{{ route('homepage') }}"> Đơn hàng <i class="fa fa-angle-right" aria-hidden="true"></i></a> Thông tin chi tiết đơn hàng</div>
	</div>
</div>

<div class="row">
	<div class="col-sm-12">
	</div>
</div>

@endsection