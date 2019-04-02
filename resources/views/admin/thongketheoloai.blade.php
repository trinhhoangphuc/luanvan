@extends('layouts.admin.master')

@section('title')
    Sản phẩm bán chạy
@endsection

@section('thongke')
    active
@endsection

@section('tkloai')
    active
@endsection

@section('noidung')

<style type="text/css" media="screen">
    .zc-ref {
      display: none;
    }
    #myChart-wrapper{
      margin:auto;
    }
</style>
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
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#IMAGES" data-toggle="tab"><i class="fa fa-pie-chart" aria-hidden="true"></i> Biễu đồ</a></li>
                        <li><a href="#QUNTITY" data-toggle="tab"><i class="fa fa-list" aria-hidden="true"></i> Danh sách</a></li>
                    </ul>
                    <div class="tab-content">

                      <div class="tab-pane active" id="IMAGES">
                        <div class="chart-box">
                            <div id="myChart"></div>
                        </div>
                    </div>

                    <div class="tab-pane" id="QUNTITY">
                        <table id="example1" class="table table-bordered table-hover" >
                                <thead class="text-center">
                                    <tr>
                                        <th>STT</th>
                                        <th>Loại</th>
                                        <th class="text-center">Số lượng</th>
                                    </tr>
                                </thead>
                                <tbody id="noiDung">
                                    
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3" class="text-right">
                                            <a href="{{route('excelLoai')}}" target="_blank" class="btn btn-danger btn-flat"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Xuất File Excel</a>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                    </div>

                </div>
            </div>

        </div>
    </div>

    </section>

</div>
<script src="{{asset('public/App/thongketheoloaiController.js')}}"></script>
@endsection