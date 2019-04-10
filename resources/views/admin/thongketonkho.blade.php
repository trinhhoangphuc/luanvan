
@extends('layouts.admin.master')

@section('title')
   Redshop - Sản phẩm tồn kho
@endsection

@section("thongke")
    active
@endsection

@section("tonkho")
    active
@endsection

@section('noidung')
<script src="{{asset('public/App/thongketonkhoController.js')}}"></script>
<div class="content-wrapper" ng-controller="thongketonkhoController">

    <section class="content-header">
        <h1>
            Thống kê
            <small>Sản phẩm tồn kho</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
            <li class="active">Sản phẩm tồn kho</li>
        </ol>
    </section>

    <section class="content">

        <div class="row">
            <div class="col-sm-12">
                <div class="box" >
                    
                    <div class="row">
                        <div class="col-sm-7"><div class="box-header"><h3 class="box-title"><span class="glyphicon glyphicon-list-alt"></span> Danh sách @{{dataTitle}}</h3></div></div>
                        <div class="col-sm-5">
                            <div class="box-header">
                            <select name="" class="form-control select2" style="width: 100%" ng-model="sanpham.sp_ma" ng-change="changeProduct()">
                                <option value="0" ng-value="0">--Chọn Sản Phẩm--</option>
                                <option ng-repeat="sp in dsSanpham" value="@{{sp.sp_ma}}" ng-value="@{{sp.sp_ma}}">@{{sp.sp_ten}}</option>

                            </select>
                        </div>
                        </div>
                    </div>
                    <div class="box-body">
                        <table width="100%" ng-show="isLoading">
                            <tr>
                                <td width="45%" class="text-right">Dữ liệu đang được tải về</td>
                                <td width="150" class="text-center">
                                    <md-progress-circular class="md-warn" md-diameter="100" md-mode="indeterminate"></md-progress-circular>
                                </td>
                                <td width="45% " style="text-align: left !important;">Xin chờ trong giây lát...</td>
                            </tr>
                        </table>
                        <div class="table-responsive" style="padding: 0px 15px" ng-show="!isLoading && dsNhap.length != 0">
                            <table id="example1" class="table table-bordered table-hover" datatable="ng" dt-options="dtOptions" dt-columns="dtColumns">
                                <thead class="text-center">
                                    <tr >
                                        <th>STT</th>
                                        <th>Mã nhập</th>
                                        <th>Hương vị</th>
                                        <th>Tồn kho</th>
                                        <th>Hạn sử dụng</th>
                                        <th>Trạng Thái</th>
                                        <th style="">
                                        	
                                        	
                                        </th>
                                    </tr>
                                </thead>
                                <tbody ng-if="dsNhap.length > 0">
                                    <tr  ng-repeat="item in dsNhap" id="tr_@{{item.n_ma}}" ng-class="item.n_ma == newMember_Data? 'bg-default':''">
                                        
                                        <td>@{{ $index+1 }}</td>
                                        <td>#@{{ item.n_ma }}</td>
                                        <td>@{{ dsHuongvi.dbFind("hv_ma", item.hv_ma).hv_ten }}</td>
                                        <td>@{{ item.n_soLuong }}</td>
                                        <td>@{{ item.hansudung}} tháng</td>
                                        <td>
                                            <span ng-if="item.hansudung > 6" class="label bg-green">Còn hạn</span>
                                            <span ng-if="item.hansudung <= 6" class="label bg-red">Sắp hết hạn</span>
                                            <span ng-if="item.hansudung <= 0" class="label bg-red">Hết hạn</span>
                                        </td>
                                        <td >
                                            <button class="btn btn-sm btn-flat btn-info btn-detail" ng-click="CreateEdit_show('detail', item.n_ma)">
                                                <i class="fa fa-eye-slash"></i></button>
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="7" class="text-right" id="btn-excel">
                                            <a href="http://localhost/luanvan/admin/thongke/excelSPTK/@{{sanpham.sp_ma}}" target="_blank" class="btn btn-danger btn-flat"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Xuất File Excel</a>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="table-responsive" style="padding: 0px 15px" ng-show="!isLoading && dsNhap.length == 0 ">
                            <table id="example1" class="table table-bordered table-hover" >
                                <thead class="text-center">
                                    <tr >
                                        <th>STT</th>
                                        <th>Mã nhập</th>
                                        <th>Hương vị</th>
                                        <th>Tồn kho</th>
                                        <th>Hạn sử dụng</th>
                                        <th>Trạng Thái</th>
                                        <th >
                                        	
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="7">
                                            Chưa có dữ liệu
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection
