
@extends('layouts.admin.master')

@section('title')
    Redshop - Quản lý chức vụ
@endsection

@section("nhansu")
    active
@endsection

@section("chucvu")
    active
@endsection

@section('noidung')
<script src="{{asset('public/App/ChucvuController.js')}}"></script>
<div class="content-wrapper" ng-controller="chucvuController">

    <section class="content-header">
        <h1>
            Nhân viên - Chức vụ
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
                        <div class="table-responsive" style="padding: 0px 15px" ng-show="!isLoading && dsChucvu.length != 0">
                            <table id="example1" class="table table-bordered table-hover" datatable="ng" dt-options="dtOptions" dt-columns="dtColumns">
                                <thead class="text-center">
                                    <tr >
                                        <th>
                                            <input type="checkbox" id="chkSelectItems" ng-click="checkInput()"/>
                                            <button id="btn-deleteall" class="btn btn-default btn-sm" ng-click="CreateEdit_show('deleteAll', -1)"><i class="glyphicon glyphicon-fire" aria-hidden="true"></i></button>
                                        </th>

                                        <th>Chức vụ</th>
                                        <th>Trạng Thái</th>
                                        <th>
                                            <button class="btn   btn-sm btn-flat btn-primary btn-refresh" ng-click="refresh()"><i class="fa fa-refresh"></i></button>
                                            <button class="btn   btn-sm btn-flat bg-olive btn-add" ng-click="CreateEdit_show('create', -1)"><i class="fa fa-plus"></i></button>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody ng-if="dsChucvu.length > 0">
                                    <tr  ng-repeat="item in dsChucvu" id="tr_@{{item.cv_ma}}" ng-class="item.cv_ma == newMember_Data? 'bg-default':''"  ng-if="item.cv_ma != 1 ">
                                        <td><input type="checkbox" id="chk@{{ $index+1 }}" value="@{{ item.cv_ma }}" /></td>

                                        <td class="text-dark"><b>@{{item.cv_ten}}</b></td>
                                        <td>
                                            <span ng-if="item.cv_trangThai == 1" class="label bg-green">Hiển thị</span>
                                            <span ng-if="item.cv_trangThai == 0" class="label bg-red">Khóa</span>
                                        </td>
                                        <td >
                                            <button class="btn btn-sm btn-flat btn-info btn-detail" ng-click="CreateEdit_show('detail', item.cv_ma)">
                                                <i class="fa fa-eye-slash"></i></button>
                                            <button class="btn btn-sm btn-flat bg-orange btn-edit" ng-click="CreateEdit_show('edit', item.cv_ma)"><i class="fa fa-pencil"></i></button>
                                            <button class="btn btn-flat  btn-sm bg-purple btn-role" ng-click="CreateEdit_show('role', item.cv_ma)"><i
                                                        class="fa fa-address-card"></i></button>
                                            <button class="btn btn-sm btn-flat btn-danger btn-flat btn-delete" ng-click="CreateEdit_show('delete', item.cv_ma)"><i class="fa fa-trash" ></i></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="table-responsive" style="padding: 0px 15px" ng-show="!isLoading && dsChucvu.length == 0 ">
                            <table id="example1" class="table table-bordered table-hover" >
                                <thead class="text-center">
                                    <tr >
                                        <th>
                                            <input type="checkbox" id="chkSelectItems" ng-click="checkInput()"/>
                                            <button id="btn-deleteall" class="btn btn-default btn-sm" ng-click="CreateEdit_show('deleteAll', -1)"><i class="glyphicon glyphicon-fire" aria-hidden="true"></i></button>
                                        </th>

                                        <th>Chức vụ</th>
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
                        <div class="imgcontainer">
                            <span class="close" data-dismiss="modal" title="Close Modal">&times;</span>
                            <div class="title">@{{dialogTiTle}}</div>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <label for="name" class=""><b>Tên Chức vụ:</b></label>
                                <input type="text" id="name" name="ten" ng-model="chucvu.ten" class="form-control " placeholder="Nhập tên Chức vụ" ng-required="true"autocomplete="off">
                                <span class="error" id="dlgExistName"></span>
                            </div>
                            <div class="form-group">
                                <label for="trangthaiKhoa" class="control-label"><b>Trạng Thái:</b></label>
                                <div>
                                    &nbsp;
                                    <label class="radio-content">
                                        <input type="radio" name="trangThai" id="trangthaiKhaDung" ng-model="chucvu.trangThai" ng-value="1" value="1">
                                        <i class="fa fa-heart text-danger"></i> Hiển thị
                                    </label>&nbsp;&nbsp;&nbsp;&nbsp;
                                    <label class="radio-content">
                                        <input type="radio" name="trangThai" id="trangthaiKhoa" ng-model="chucvu.trangThai" ng-value="0" value="0">
                                        <i class="fa fa-lock text-blue"></i> Tạm khóa
                                    </label>
                                    
                                </div>
                            </div>
                            <div class="form-group"> 
                                <button type="submit" class="btn btn-danger btn-flat btn-block" >@{{dialogButton}}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="modal fade" id="myModal3">
            <div class="modal-dialog">
                <form name="frmRole" id="frmRole">
                    <div class="modal-content">
                        <div class="imgcontainer">
                            <span class="close" data-dismiss="modal" title="Close Modal">&times;</span>
                            <div class="title">@{{dialogTiTle}}</div>
                        </div>
                        <div class="modal-body">
                           <input type="hidden" name="_token" value="{{ csrf_token() }}">
                           <div class="row" style="padding: 0px 10px;">
                            <div class="col-sm-6"  ng-repeat="quyen in dsQuyen">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" id="quyen_@{{quyen.q_ma}}" value="@{{quyen.q_ma}}">@{{quyen.q_ten}}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <br/><br/>
                        <div class="form-group">
                            <button type="submit" class="btn btn-danger btn-block">@{{dialogButton}}</button>
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
