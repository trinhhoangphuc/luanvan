
@extends('layouts.admin.master')

@section('title')
    Redshop - Quản lý đánh giá
@endsection

@section("khachhang")
    active
@endsection

@section("dg")
    active
@endsection

@section('noidung')
<script src="{{asset('public/App/DanhgiaController.js')}}"></script>
<div class="content-wrapper" ng-controller="danhgiaController">

    <section class="content-header">
        <h1>
            Khách hàng - đánh giá
            <small>@{{dataTitle}}</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
            <li class="active">@{{dataTitle}}</li>
        </ol>
    </section>

    <section class="content">

        <div class="row">
            <div class="col-sm-12">
                <div class="box" >
                    <div class="box-header"><h3 class="box-title"><span class="glyphicon glyphicon-list-alt"></span> Danh sách @{{dataTitle}}</h3></div>

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
                        <div class="" ng-show="!isLoading && dsDanhgia.length != 0">
                            <table id="example1" class="table table-bordered table-hover" datatable="ng" dt-options="dtOptions" dt-columns="dtColumns">
                                <thead class="text-center">
                                    <tr >
                                        <th>
                                            <input type="checkbox" id="chkSelectItems" ng-click="checkInput()"/>
                                            <button id="btn-deleteall" class="btn btn-default btn-sm" ng-click="CreateEdit_show('deleteAll', -1)"><i class="glyphicon glyphicon-fire" aria-hidden="true"></i></button>
                                        </th>
                                        <th>Sản phẩm</th>
                                        <th>Khách hàng</th>
                                        <th>Đánh giá</th>
                                        <th>Trạng Thái</th>
                                        <th>
                                            <button class="btn   btn-sm btn-flat btn-primary btn-refresh" ng-click="refresh()"><i class="fa fa-refresh"></i></button>
                                         <!--    <button class="btn   btn-sm btn-flat bg-olive btn-add" ng-click="CreateEdit_show('create', -1)"><i class="fa fa-plus"></i></button> -->
                                        </th>
                                    </tr>
                                </thead>
                                <tbody ng-if="dsDanhgia.length > 0">
                                    <tr  ng-repeat="item in dsDanhgia" id="tr_@{{item.dg_ma}}" ng-class="item.dg_ma == newMember_Data? 'bg-default':''">
                                        <td><input type="checkbox" id="chk@{{ $index+1 }}" value="@{{ item.dg_ma }}" /></td>
                                        <td class="text-dark">@{{item.sp_ten}}</td>
                                        <td class="text-dark">@{{item.kh_ten}}</td>
                                        <td class="text-dark">
                                            <i class="fa chech-star" ng-class="item.dg_sao >= 1 ? 'fa-star':'fa-star-o'"></i>
                                            <i class="fa chech-star" ng-class="item.dg_sao >= 2 ? 'fa-star':'fa-star-o'"></i>
                                            <i class="fa chech-star" ng-class="item.dg_sao >= 3 ? 'fa-star':'fa-star-o'"></i>
                                            <i class="fa chech-star" ng-class="item.dg_sao >= 4 ? 'fa-star':'fa-star-o'"></i>
                                            <i class="fa chech-star" ng-class="item.dg_sao == 5 ? 'fa-star':'fa-star-o'"></i>
                                        </td>
                                        <td>
                                            <span ng-if="item.dg_trangThai == 1" class="label bg-green">Hiển thị</span>
                                            <span ng-if="item.dg_trangThai == 0" class="label bg-red">Khóa</span>
                                        </td>
                                        <td >
                                            <button class="btn btn-sm btn-flat btn-info btn-detail" ng-click="CreateEdit_show('detail', item.dg_ma)">
                                                <i class="fa fa-eye-slash"></i></button>
                                            <button class="btn btn-sm btn-flat bg-orange btn-edit" ng-click="CreateEdit_show('edit', item.dg_ma)"><i class="fa fa-pencil"></i></button>
                                            <button class="btn btn-sm btn-flat btn-danger btn-flat btn-delete" ng-click="CreateEdit_show('delete', item.dg_ma)"><i class="fa fa-trash" ></i></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="" ng-show="!isLoading && dsDanhgia.length == 0 ">
                            <table id="example1" class="table table-bordered table-hover" >
                                <thead class="text-center">
                                    <tr >
                                        <th>
                                            <input type="checkbox" id="chkSelectItems" ng-click="checkInput()"/>
                                            <button id="btn-deleteall" class="btn btn-default btn-sm" ng-click="CreateEdit_show('deleteAll', -1)"><i class="glyphicon glyphicon-fire" aria-hidden="true"></i></button>
                                        </th>
                                        <th>Sản phẩm</th>
                                        <th>Khách hàng</th>
                                        <th>Đánh giá</th>
                                        <th>Trạng Thái</th>
                                        <th>
                                            <button class="btn btn-sm btn-flat btn-primary btn-refresh" ng-click="refresh()"><i class="fa fa-refresh"></i></button>
                                            <!-- <button class="btn btn-sm btn-flat bg-olive btn-add" ng-click="CreateEdit_show('create', -1)"><i class="fa fa-plus"></i></button> -->
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="6" style="width: 10% !important; text-align: center;">
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


        <div class="modal fade" id="myModal">
            <div class="modal-dialog">
                <form name="frmCreatEdit" id="frmCreatEdit">
                    <div class="modal-content">
                        <div class="imgcontainer">
                            <span class="close" data-dismiss="modal" title="Close Modal">&times;</span>
                            <div class="title">@{{dialogTiTle}}</div>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <label for="trangthaiKhoa" class="control-label"><b>Trạng Thái:</b></label>

                                    &nbsp;
                                    <label class="radio-content">
                                        <input type="radio" name="trangThai" id="trangthaiKhaDung" ng-model="danhgia.trangThai" ng-value="1" value="1">
                                        <i class="fa fa-heart text-danger"></i> Hiển thị
                                    </label>&nbsp;&nbsp;&nbsp;&nbsp;
                                    <label class="radio-content">
                                        <input type="radio" name="trangThai" id="trangthaiKhoa" ng-model="danhgia.trangThai" ng-value="0" value="0">
                                        <i class="fa fa-lock text-blue"></i> Tạm khóa
                                    </label>
               
                            </div>
                            <div class="form-group"> 
                                <button type="submit" class="btn btn-danger btn-flat btn-block" >@{{dialogButton}}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="modal fade" id="myModal2">
            <div class="modal-dialog">
                
                <div class="modal-content">
                    <div class="imgcontainer">
                            <span class="close" data-dismiss="modal" title="Close Modal">&times;</span>
                            <div class="title">@{{dialogTiTle}}</div>
                        </div>
                    <div class="modal-body">
                        <form name="delte" id="delte">
                            <div class="form-group"> 
                                <div id="message" class="text-center"></div>
                            </div>
                            <Br/>
                            <div class="form-group row"> 
                                <div class="col-sm-6"> 
                                    <button type="submit" class="btn btn-danger btn-flat btn-block">@{{dialogButton}}</button>
                                </div>
                                <div class="col-sm-6"> 
                                    <button type="button" class="btn btn-default btn-block" data-dismiss="modal" title="Close Modal">Hủy</button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </section>
</div>

@endsection
