
@extends('layouts.admin.master')

@section('title')
    Redshop - Quản lý khách hàng
@endsection

@section('khachhang')
    active
@endsection

@section('kh')
    active
@endsection

@section('noidung')
<script src="{{asset('public/App/KhachhangController.js')}}"></script>
<div class="content-wrapper" ng-controller="khachhangController">

    <section class="content-header">
        <h1>
            Khách hàng - Đánh giá
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
                        <div  ng-show="!isLoading && dsKhachhang.length != 0">
                            <table id="example1" class="table table-bordered table-hover" datatable="ng" dt-options="dtOptions" dt-columns="dtColumns">
                                <thead class="text-center">
                                    <tr >
                                        <th>
                                            <input type="checkbox" id="chkSelectItems" ng-click="checkInput()"/>
                                            <button id="btn-deleteall" class="btn btn-default btn-sm" ng-click="CreateEdit_show('deleteAll', -1)"><i class="glyphicon glyphicon-fire" aria-hidden="true"></i></button>
                                        </th>

                                        <th>Họ tên</th>
                                        <th>Email</th>
                                        <th>Điện thoại</th>
                                        <th>Trạng Thái</th>
                                        <th>
                                            <button class="btn btn-sm btn-flat btn-primary btn-refresh" ng-click="refresh()"><i class="fa fa-refresh"></i></button>
                                            <button class="btn btn-sm btn-flat bg-olive btn-add" ng-click="CreateEdit_show('create', -1)"><i class="fa fa-plus"></i></button>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr  ng-repeat="item in dsKhachhang" id="tr_@{{item.kh_ma}}" ng-class="item.kh_ma == newMember_Data? 'bg-default':''">
                                        <td><input  type="checkbox" id="chk@{{ $index+1 }}" value="@{{ item.kh_ma }}" /></td>

                                        <td ><b>@{{ item.kh_hoTen }}</b></td>
                                        <td >@{{ item.kh_email }}</td>
                                        <td >
                                        	<span ng-if="item.kh_gioiTinh == 1">
                                        		<i class="fa fa-mars text-primary" aria-hidden="true"></i> Nam
                                        	</span>
                                        	<span ng-if="item.kh_gioiTinh == 0">
												<i class="fa fa-venus text-danger" aria-hidden="true"></i> Nữ
											</span>
                                        </td>
                                        <td>
                                           <span ng-if="item.kh_trangThai == 1" class="label bg-green">Hiển thị</span>
                                            <span ng-if="item.kh_trangThai == 0" class="label bg-red">Khóa</span>
                                        </td>
                                        <td >
                                            <button class="btn btn-sm btn-flat btn-info btn-detail" ng-click="CreateEdit_show('detail', item.kh_ma)">
                                                <i class="fa fa-eye-slash"></i></button>
                                            <button   class="btn btn-sm btn-flat bg-orange btn-edit" ng-click="CreateEdit_show('edit', item.kh_ma)"><i class="fa fa-pencil"></i></button>
                                             <button class="btn  btn-sm btn-flat bg-purple btn-resetPass" ng-click="CreateEdit_show('resetPass', item.kh_ma)"><i class="fa fa-key"></i></button>
                                            <button   class="btn btn-sm btn-flat bg-maroon btn-delete" ng-click="CreateEdit_show('delete', item.kh_ma)"><i class="fa fa-trash" ></i></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div  ng-show="!isLoading && dsKhachhang.length == 0 ">
                            <table id="example1" class="table table-bordered table-hover" >
                                <thead class="text-center">
                                    <tr >
                                        <th>
                                            <input type="checkbox" id="chkSelectItems" ng-click="checkInput()"/>
                                            <button id="btn-deleteall" class="btn btn-default btn-sm" ng-click="CreateEdit_show('deleteAll', -1)"><i class="glyphicon glyphicon-fire" aria-hidden="true"></i></button>
                                        </th>

                                        <th>Loại</th>
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
                <form ng-show="!LoadingFrm" name="frmCreatEdit" id="frmCreatEdit">
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
                                <label for="name" ><b>Tên khách hàng:</b></label>
                                <input type="text" id="name" name="ten" ng-model="khachhang.ten" class="form-control " placeholder="Nhập tên khách hàng" ng-required="true">
                                <span class="text-danger" id="dlgExistName"></span>
                            </div>
                            <div class="form-group">
                                <label for="email" ><b>Email:</b></label>
                                <input type="email" id="email" name="email" ng-model="khachhang.email" class="form-control " placeholder="Nhập địa chỉ Email" ng-required="true">
                                <span class="text-danger" id="dlgExistEmail"></span>
                            </div>
                            <div class="form-group">
                                <label for="gioitinh" class="control-label"><b>Giới tính:</b></label>
                                <div>
                                    &nbsp;
                                    <label class="radio-content">
                                        <input type="radio" name="gioitinh" id="gioitinhnam" ng-model="khachhang.gioitinh" ng-value="1" value="1"> <i class="fa fa-mars text-primary" aria-hidden="true"></i> Nam
                                    </label>&nbsp;&nbsp;&nbsp;&nbsp;
                                    <label class="radio-content">
                                        <input type="radio" name="gioitinh" id="gioitinhnu" ng-model="khachhang.gioitinh" ng-value="0" value="0"> <i class="fa fa-venus text-danger" aria-hidden="true"></i> Nữ
                                    </label>

                                </div>
                            </div>
                            <div class="form-group">
                                <label for="diachi" ><b>Địa chỉ:</b></label>
                                <input type="text" id="diachi" name="diachi" ng-model="khachhang.diachi" class="form-control " placeholder="Nhập địa chỉ" ng-required="true">
                            </div>
                            <div class="form-group">
                                <label for="dienthoai" ><b>Điện thoại:</b></label>
                                <input type="text" id="dienthoai" name="dienthoai" ng-model="khachhang.dienthoai" class="form-control " placeholder="Nhập số điện thoại" ng-required="true">
                                <span class="text-danger" id="dlgExistPhone"></span>
                            </div>
                            <div class="form-group">
                                <label for="trangthaiKhoa" class="control-label"><b>Trạng Thái:</b></label>
                                <div>
                                    &nbsp;
                                    <label class="radio-content">
                                        <input type="radio" name="trangThai" id="trangthaiKhaDung" ng-model="khachhang.trangThai" ng-value="1" value="1">
                                        <i class="fa fa-heart text-danger"></i> Hiển thị
                                    </label>&nbsp;&nbsp;&nbsp;&nbsp;
                                    <label class="radio-content">
                                        <input type="radio" name="trangThai" id="trangthaiKhoa" ng-model="khachhang.trangThai" ng-value="0" value="0">
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
                <table ng-show="LoadingFrm" width="100%" style="background-color: #fff;">
                	<tr>
                		<td width="45%" class="text-right">Đang xử lý dữ liệu</td>
                		<td width="150" class="text-center">
                			<md-progress-circular class="md-warn" md-diameter="100" md-mode="indeterminate"></md-progress-circular>
                		</td>
                		<td width="45% " style="text-align: left !important;">Xin chờ trong giây lát...</td>
                	</tr>
                </table>
            </div>
        </div>

        <div class="modal fade" id="myModal2">
            <div class="modal-dialog">
                <table ng-show="LoadingFrm" width="100%" style="background-color: #fff;">
                    <tr>
                        <td width="45%" class="text-right">Đang xử lý dữ liệu</td>
                        <td width="150" class="text-center">
                            <md-progress-circular class="md-warn" md-diameter="100" md-mode="indeterminate"></md-progress-circular>
                        </td>
                        <td width="45% " style="text-align: left !important;">Xin chờ trong giây lát...</td>
                    </tr>
                </table>
                <div class="modal-content" ng-show="!LoadingFrm">
                    <div class="modal-header">
                        <div class="imgcontainer">
                            <span class="close" data-dismiss="modal" title="Close Modal">&times;</span>
                            <div class="logo-login-register">
                                 <h3 class="title-comm" style="margin-top: 0; margin-bottom: 0;"><span class="title-holder">@{{dialogTiTle}}</span></h3>
                            </div>
                        </div>
                     </div>
                    <div class="modal-body">
                        <form name="delte" id="delte" >
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