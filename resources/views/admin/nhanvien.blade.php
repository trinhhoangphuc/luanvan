
@extends('layouts.admin.master')

@section('title')
    Redshop - Quản lý nhân viên
@endsection

@section('nhansu')
    active
@endsection

@section('nhanvien')
    active
@endsection

@section('noidung')
<script src="{{asset('public/App/NhanvienController.js')}}"></script>
<div class="content-wrapper" ng-controller="nhanvienController">

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
                        <div class="table-responsive" style="padding: 0px 15px" ng-show="!isLoading && dsNhanvien.length != 0">
                            <table id="example1" class="table table-bordered table-hover" datatable="ng" dt-options="dtOptions" dt-columns="dtColumns">
                                <thead class="text-center">
                                    <tr >
                                        <th>
                                            <input type="checkbox" id="chkSelectItems" ng-click="checkInput()"/>
                                            <button id="btn-deleteall" class="btn btn-default btn-sm" ng-click="CreateEdit_show('deleteAll', -1)"><i class="glyphicon glyphicon-fire" aria-hidden="true"></i></button>
                                        </th>
                                        <th>Hình</th>
                                        <th>Họ tên</th>
                                        <th>Giới tính</th>
                                        <th width="20%">Chức vụ</th>
                                        <th>Trạng Thái</th>
                                        <th>
                                            <button class="btn btn-sm btn-flat btn-primary btn-refresh" ng-click="refresh()"><i class="fa fa-refresh"></i></button>
                                            <button class="btn btn-sm btn-flat bg-olive btn-add" ng-click="CreateEdit_show('create', -1)"><i class="fa fa-plus"></i></button>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr  ng-repeat="item in dsNhanvien" id="tr_@{{item.nv_ma}}" ng-class="item.nv_ma == newMember_Data? 'bg-default':''" ng-if="item.nv_email != 'webredshop@gmail.com'">
                                        <td><input ng-if="{{Session::get('admin_id')}} != item.nv_ma" type="checkbox" id="chk@{{ $index+1 }}" value="@{{ item.nv_ma }}" /></td>
                                        <td width="10%"><img src="{{asset('public/images/avatar/staff')}}/@{{item.nv_hinh}}" alt="" width="100%" ></td>
                                        <td class="text-dark"><b>@{{ item.nv_hoTen }}</b></td>
                                        <td class="text-dark">
                                            <span ng-if="item.nv_gioiTinh == 1">Nam</span>
                                            <span ng-if="item.nv_gioiTinh == 0">Nữ</span>
                                        </td>
                                        <td>@{{ dsChucvu.dbFind("cv_ma", item.cv_ma).cv_ten }}</td>
                                        <td>
                                           <span ng-if="item.nv_trangThai == 1" class="label bg-green">Hiển thị</span>
                                            <span ng-if="item.nv_trangThai == 0" class="label bg-red">Khóa</span>
                                        </td>
                                        <td >
                                            <button class="btn btn-sm btn-flat btn-info btn-detail" ng-click="CreateEdit_show('detail', item.nv_ma)">
                                                <i class="fa fa-eye-slash"></i></button>
                                            <button  ng-if="{{Session::get('admin_id')}} != item.nv_ma" class="btn btn-sm btn-flat bg-orange btn-edit" ng-click="CreateEdit_show('edit', item.nv_ma)"><i class="fa fa-pencil"></i></button>
                                            <button class="btn  btn-sm btn-flat bg-purple btn-resetPass" ng-click="CreateEdit_show('resetPass', item.nv_ma)"><i class="fa fa-key"></i></button>
                                            <button  ng-if="{{Session::get('admin_id')}} != item.nv_ma" class="btn btn-sm btn-flat btn-danger btn-flat btn-delete" ng-click="CreateEdit_show('delete', item.nv_ma)"><i class="fa fa-trash" ></i></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="table-responsive" style="padding: 0px 15px" ng-show="!isLoading && dsNhanvien.length == 0 ">
                            <table id="example1" class="table table-bordered table-hover" >
                                <thead class="text-center">
                                    <tr >
                                        <th>
                                            <input type="checkbox" id="chkSelectItems" ng-click="checkInput()"/>
                                            <button id="btn-deleteall" class="btn btn-default btn-sm" ng-click="CreateEdit_show('deleteAll', -1)"><i class="glyphicon glyphicon-fire" aria-hidden="true"></i></button>
                                        </th>
                                        <th>Hình</th>
                                        <th>Họ tên</th>
                                        <th>Giới tính</th>
                                        <th width="20%">Chức vụ</th>
                                        <th>Trạng Thái</th>
                                        <th>
                                            <button class="btn btn-sm btn-flat btn-primary btn-refresh" ng-click="refresh()"><i class="fa fa-refresh"></i></button>
                                            <button class="btn btn-sm btn-flat bg-olive btn-add" ng-click="CreateEdit_show('create', -1)"><i class="fa fa-plus"></i></button>
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
                                <label for="name" class=""><b>Tên nhân viên:</b></label>
                                <input type="text" id="name" name="ten" ng-model="nhanvien.ten" class="form-control " placeholder="Nhập tên nhân viên" ng-required="true">
                                <span class="text-danger" id="dlgExistName"></span>
                            </div>
                            <div class="form-group">
                                <label for="email" class=""><b>Email:</b></label>
                                <input type="email" id="email" name="email" ng-model="nhanvien.email" class="form-control " placeholder="Nhập địa chỉ Email" ng-required="true">
                                <span class="text-danger" id="dlgExistEmail"></span>
                            </div>
                            <div class="form-group">
                                <label for="gioitinh" class="control-label"><b>Giới tính:</b></label>
                                <div>
                                    &nbsp;
                                    <label class="radio-content">
                                        <input type="radio" name="gioitinh" id="gioitinhnam" ng-model="nhanvien.gioitinh" ng-value="1" value="1"> <i class="fa fa-mars text-primary" aria-hidden="true"></i> Nam
                                    </label>&nbsp;&nbsp;&nbsp;&nbsp;
                                    <label class="radio-content">
                                        <input type="radio" name="gioitinh" id="gioitinhnu" ng-model="nhanvien.gioitinh" ng-value="0" value="0"> <i class="fa fa-venus text-danger" aria-hidden="true"></i> Nữ
                                    </label>

                                </div>
                            </div>
                            <div class="form-group">
                                <label for="ngaysinh" class=""><b>Ngày sinh:</b></label>
                                <input type="date" id="ngaysinh" name="ngaysinh" ng-model="nhanvien.ngaysinh" class="form-control " placeholder="Nhập ngày sinh" ng-required="true">
                            </div>
                            <div class="form-group">
                                <label for="diachi" class=""><b>Địa chỉ:</b></label>
                                <input type="text" id="diachi" name="diachi" ng-model="nhanvien.diachi" class="form-control " placeholder="Nhập địa chỉ" ng-required="true">
                            </div>
                            <div class="form-group">
                                <label for="dienthoai" class=""><b>Điện thoại:</b></label>
                                <input type="text" id="dienthoai" name="dienthoai" ng-model="nhanvien.dienthoai" class="form-control " placeholder="Nhập số điện thoại" ng-required="true">
                                <span class="text-danger" id="dlgExistPhone"></span>
                            </div>
                            <div class="form-group">
                                <label for="brand" class=""><b>Chức vụ:</b></label>
                                <select name="chucvu" id="brand" class="form-control" ng-model="nhanvien.chucvu" ng-required="true">
                                    <option ng-show="dsChucvu.length == 0" value="0" ng-value="0">--Chưa có dữ liệu--</option>
                                    <option ng-repeat="cv in dsChucvu" value="@{{ cv.cv_ma }}" ng-value="cv.cv_ma">@{{ cv.cv_ten }}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="trangthaiKhoa" class="control-label"><b>Trạng Thái:</b></label>
                                <div>
                                    &nbsp;
                                    <label class="radio-content">
                                        <input type="radio" name="trangThai" id="trangthaiKhaDung" ng-model="nhanvien.trangThai" ng-value="1" value="1">
                                        <i class="fa fa-heart text-danger"></i> Hiển thị
                                    </label>&nbsp;&nbsp;&nbsp;&nbsp;
                                    <label class="radio-content">
                                        <input type="radio" name="trangThai" id="trangthaiKhoa" ng-model="nhanvien.trangThai" ng-value="0" value="0">
                                        <i class="fa fa-lock text-blue"></i> Tạm khóa
                                    </label>

                                </div>
                            </div>
                            <div class="form-group"> 
                                <button type="submit" class="btn btn-flat btn-danger btn-block" >@{{dialogButton}}</button>
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