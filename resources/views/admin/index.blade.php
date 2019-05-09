@extends('layouts.admin.master')

@section('title')
    Quản trị Redshop.vn
@endsection

@section('trangchu')
    active
@endsection

@section('noidung')

<script src="{{asset('public/libs/zingchart.min.js')}}"></script>
<script src="{{asset('public/App/dashboardController.js')}}"></script>
<div class="content-wrapper">

    <section class="content-header">
        <h1>
            Trang chủ
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
        </ol>
    </section>

    <section class="content">

        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3 id="pSLDH"></h3>

                        <p  id="pSLDH">Đơn hàng mới</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="#" class="small-box-footer">Chi tiết <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3 id="pSLKH"></h3>

                        <p>Khách hàng</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="#" class="small-box-footer">Chi tiết <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3 id="pSLSP"></h3>

                        <p>Sản phẩm</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="#" class="small-box-footer">Chi tiết <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>53<sup style="font-size: 20px">%</sup></h3>

                        <p>Bounce Rate</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="#" class="small-box-footer">Chi tiết <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
           
            
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="chart-box">
                    <p class="title-chart">Thống kê năm <?php echo date('Y');?></p>
                    <div id="chTKT"></div>
                </div>
            </div>
        </div>

    </section>

</div>
@endsection