@extends('layouts.admin.master')

@section('title')
    Thống kê theo loại
@endsection

@section('thongke')
    active
@endsection

@section('tkloai')
    active
@endsection

@section('noidung')

		
<script src="{{asset('public/libs/zingchart.min.js')}}"></script>


<div class="content-wrapper">

    <section class="content-header">
        <h1>
            Thống kê
            <small>Theo loại</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
            <li class="active">Theo loại</li>
        </ol>
    </section>

    <section class="content">

        <div class="row">
            <div class="col-sm-12">
                <div class="chart-box" >
                    <div id="myChart"></div>
                </div>
            </div>
        </div>

    </section>

</div>
<script src="{{asset('public/App/thongketheoloaiController.js')}}"></script>
@endsection