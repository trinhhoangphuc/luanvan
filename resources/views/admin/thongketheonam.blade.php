@extends('layouts.admin.master')

@section('title')
   Redshop - Thống kê theo năm
@endsection

@section('thongke')
    active
@endsection

@section('tknam')
    active
@endsection

@section('noidung')

<script src="{{asset('public/libs/zingchart.min.js')}}"></script>
<script src="{{asset('public/App/thongketheonamController.js')}}"></script>
<div class="content-wrapper">

   <section class="content-header">
        <h1>
            Thống kê
            <small>Theo năm</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
            <li class="active">Theo năm</li>
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
                        <div class="chart-box" >
                            <div id="chTKT"></div>
                            <div style="width: 15%; margin: auto;">
                                <div class="dropdown" style="width: 100%" id="cmbTKT">
                                    <button class="btn btn-danger btn-flat dropdown-toggle btn-tk" type="button" data-toggle="dropdown">Dữ liệu thống kê<span class="caret"></span></button>
                                    <ul class="dropdown-menu dm-2"></ul>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="tab-pane" id="QUNTITY">
                        <table id="example1" class="table table-bordered table-hover" >
                                <thead class="text-center">
                                    <tr>
                                        <th>STT</th>
                                        <th>Thời gian</th>
                                        <th class="text-center">Doanh thu</th>
                                    </tr>
                                </thead>
                                <tbody id="noiDung">
                                    
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3" class="text-right" id="btn-excel">
                                            
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                    </div>

                </div>
            </div>

        </div>
    </section>

</div>

@endsection