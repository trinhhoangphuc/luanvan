
@extends('layouts.admin.master')

@section('title')
    Redshop - Quản lý thanh toán
@endsection

@section("hanghoa")
    active
@endsection

@section("tt")
    active
@endsection

@section('noidung')
<script src="{{asset('public/App/ThanhtoanController.js')}}"></script>
<div class="content-wrapper" ng-controller="thanhtoanController">

    <section class="content-header">
        <h1>
            Hàng hóa
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
                        <div class="" ng-show="!isLoading && dsThanhtoan.length != 0">
                            <table id="example1" class="table table-bordered table-hover" datatable="ng" dt-options="dtOptions" dt-columns="dtColumns">
                                <thead class="text-center">
                                    <tr >
                                        <th>
                                            <input type="checkbox" id="chkSelectItems" ng-click="checkInput()"/>
                                            <button id="btn-deleteall" class="btn btn-default btn-sm" ng-click="CreateEdit_show('deleteAll', -1)"><i class="glyphicon glyphicon-fire" aria-hidden="true"></i></button>
                                        </th>

                                        <th>Thanh toán</th>
                                        <th>Trạng Thái</th>
                                        <th>
                                            <button class="btn   btn-sm btn-flat btn-primary btn-refresh" ng-click="refresh()"><i class="fa fa-refresh"></i></button>
                                            <button class="btn   btn-sm btn-flat bg-olive btn-add" ng-click="CreateEdit_show('create', -1)"><i class="fa fa-plus"></i></button>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody ng-if="dsThanhtoan.length > 0">
                                    <tr  ng-repeat="item in dsThanhtoan" id="tr_@{{item.tt_ma}}" ng-class="item.tt_ma == newMember_Data? 'bg-default':''">
                                        <td><input ng-if="item.tt_ma != 1" type="checkbox" id="chk@{{ $index+1 }}" value="@{{ item.tt_ma }}" /></td>

                                        <td class="text-dark"><b>@{{item.tt_ten}}</b></td>
                                        <td>
                                            <span ng-if="item.tt_trangThai == 1" class="label bg-green">Hiển thị</span>
                                            <span ng-if="item.tt_trangThai == 0" class="label bg-red">Khóa</span>
                                        </td>
                                        <td >
                                            <button  class="btn btn-sm btn-flat btn-info btn-detail" ng-click="CreateEdit_show('detail', item.tt_ma)">
                                                <i class="fa fa-eye-slash"></i></button>
                                            <button class="btn btn-sm btn-flat bg-orange btn-edit" ng-click="CreateEdit_show('edit', item.tt_ma)"><i class="fa fa-pencil"></i></button>
                                            <button ng-if="item.tt_ma != 1" class="btn btn-sm btn-flat bg-maroon btn-delete" ng-click="CreateEdit_show('delete', item.tt_ma)"><i class="fa fa-trash" ></i></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="" ng-show="!isLoading && dsThanhtoan.length == 0 ">
                            <table id="example1" class="table table-bordered table-hover" >
                                <thead class="text-center">
                                    <tr >
                                        <th>
                                            <input type="checkbox" id="chkSelectItems" ng-click="checkInput()"/>
                                            <button id="btn-deleteall" class="btn btn-default btn-sm" ng-click="CreateEdit_show('deleteAll', -1)"><i class="glyphicon glyphicon-fire" aria-hidden="true"></i></button>
                                        </th>

                                        <th>thanh toán</th>
                                        <th>Trạng Thái</th>
                                        <th>
                                            <button class="btn btn-sm btn-flat btn-primary btn-refresh" ng-click="refresh()"><i class="fa fa-refresh"></i></button>
                                            <button class="btn btn-sm btn-flat bg-olive btn-add" ng-click="CreateEdit_show('create', -1)"><i class="fa fa-plus"></i></button>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="4" style="width: 10% !important; text-align: center;">
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
                        <div class="modal-header">
                            <div class="imgcontainer">
                                <span class="close" data-dismiss="modal" title="Close Modal">&times;</span>
                                <div class="logo-login-register">
                                     <h3 class="title-comm" style="margin-top: 0; margin-bottom: 0;"><span class="title-holder">@{{dialogTiTle}}</span></h3>
                                </div>
                            </div>
                         </div>
                        <div class="modal-body">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <label for="name" class=""><b>Tên thanh toán:</b></label>
                                <input type="text" id="name" name="ten" ng-model="thanhtoan.ten" class="form-control " placeholder="Nhập tên thanh toán" ng-required="true" ng-blur="checkExistName()" autocomplete="off">
                                <span class="text-danger" id="dlgExistName"></span>
                            </div>
                            <div class="form-group">
                                <label for="trangthaiKhoa" class="control-label"><b>Trạng Thái:</b></label>
                                <div>
                                    &nbsp;
                                    <label class="radio-content">
                                        <input type="radio" name="trangThai" id="trangthaiKhaDung" ng-model="thanhtoan.trangThai" ng-value="1" value="1">
                                        <i class="fa fa-heart text-danger"></i> Hiển thị
                                    </label>&nbsp;&nbsp;&nbsp;&nbsp;
                                    <label class="radio-content">
                                        <input type="radio" name="trangThai" id="trangthaiKhoa" ng-model="thanhtoan.trangThai" ng-value="0" value="0">
                                        <i class="fa fa-lock text-blue"></i> Tạm khóa
                                    </label>

                                </div>
                            </div>
                            <div class="form-group"> 
                                <button type="submit" class="btn bg-maroon btn-block"  ng-click="CreateEdit_save()">@{{dialogButton}}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="modal fade" id="myModal2">
            <div class="modal-dialog">
                
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="imgcontainer">
                            <span class="close" data-dismiss="modal" title="Close Modal">&times;</span>
                            <div class="logo-login-register">
                                 <h3 class="title-comm" style="margin-top: 0; margin-bottom: 0;"><span class="title-holder">@{{dialogTiTle}}</span></h3>
                            </div>
                        </div>
                     </div>
                    <div class="modal-body">
                        <form name="delte" id="delte">
                            <div class="form-group"> 
                                <div id="message" class="text-center"></div>
                            </div>
                            <Br/>
                            <div class="form-group row"> 
                                <div class="col-sm-6"> 
                                    <button type="submit" class="btn bg-maroon btn-block">@{{dialogButton}}</button>
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
