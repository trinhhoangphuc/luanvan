@extends('layouts.admin.master')

@section('title')
    Redshop - Quản lý loại sản phẩm
@endsection

@section("hanghoa")
    active
@endsection

@section("sanpham")
    active
@endsection

@section('noidung')
<script src="{{asset('public/App/SanphamController.js')}}"></script>
<div class="content-wrapper" ng-controller="sanphamController">

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
                        <div class="" ng-show="!isLoading && dsLoai.length != 0">
                            <table id="myTable" class="table table-bordered table-hover" datatable="ng" dt-options="dtOptions" dt-columns="dtColumns">
                                    <thead class="text-center">
                                      
                                        <tr >
                                            <th >
                                                <input type="checkbox" id="chkSelectItems" ng-click="checkInput()"/>
                                               <button id="btn-deleteall" class="btn btn-default btn-sm btn-flat" ng-click="CreateEdit_show('deleteAll', -1)"><i class="glyphicon glyphicon-fire" aria-hidden="true"></i></button>
                                            </th>

                                            <th>Ảnh</th>
                                            <th>Thông tin</th>
                                            <th>
                                                <button class="btn  btn-sm btn-flat  btn-refresh btn-primary" ng-click="refresh()"><i class="fa fa-refresh"></i></button>
                                                <button class="btn  btn-sm btn-flat btn-success btn-add" ng-click="CreateEdit_show('create', -1)"><i class="fa fa-plus"></i></button>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tdody>
                                        <tr  ng-repeat="item in dsSanpham" id="tr_@{{item.sp_ma}}" ng-class="item.sp_ma == newMember_Data? 'bg-default':''" >
                                            <td style="width: 10% !important;"><input type="checkbox" id="chk@{{ $index+1 }}" value="@{{ item.sp_ma }}" /></td>
                                            <td class="text-dark" style="width: 15% !important;">
                                                <div id="img-product-box">
                                                    <a href="" class="intro-banner-vdo-play-btn pinkBg" target="_blank" ng-if="item.sp_soLuong <= 10">
                                                        <i class="" aria-hidden="true"></i>
                                                        <span class="ripple pinkBg"></span>
                                                        <span class="ripple pinkBg"></span>
                                                        <span class="ripple pinkBg"></span>
                                                    </a>
                                                    <a href="" ng-click="ClickShowImg(item.sp_ma)"><img src="{{asset('public/images/products')}}/@{{item.sp_hinh}}" id="img-product"></a>
                                               </div>
                                            </td>
                                            <td class="" style="width: 64% !important;">
                                                <table class="table table-bordered">
                                                    <tr>
                                                        <td class="text-center" colspan="4" style="background: #FAFAFA;">
                                                            <div class="product-name">@{{ item.sp_ten }} </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Loại:</b></td>
                                                        <td class="text-center">@{{ dsLoai.dbFind('l_ma', item.l_ma).l_ten }}</td>
                                                        <td><b>Nhà sản xuất:</td>
                                                        <td class="text-center">@{{ dsHang.dbFind('h_ma', item.h_ma).h_ten }}</div></td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Giá bán:</b></td>
                                                        <td class="text-center  text-danger">@{{ item.sp_giaBan | number: 0 }} đ</td>
                                                        <td><b>Số lượng:</b></td>
                                                        <td class="text-center">@{{ item.sp_soLuong }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Tình trạng:</b></td>
                                                        <td class="text-center">
                                                            <span class="badge bg-olive" ng-if="item.sp_soLuong > 10">Còn hàng</span>
                                                            <span class="badge btn-danger btn-flat" ng-if="item.sp_soLuong == 0">Hết hàng</span>
                                                            <span class="badge bg-orange" ng-if="item.sp_soLuong <= 10 && item.sp_soLuong > 0">Sắp hết</span>
                                                        </td>
                                                        <td><b>Đánh giá:</b></td>
                                                        <td class="text-center">
                                                            <i class="fa chech-star" ng-class="item.sp_danhGia >= 1 ? 'fa-star':'fa-star-o'"></i>
                                                            <i class="fa chech-star" ng-class="item.sp_danhGia >= 2 ? 'fa-star':'fa-star-o'"></i>
                                                            <i class="fa chech-star" ng-class="item.sp_danhGia >= 3 ? 'fa-star':'fa-star-o'"></i>
                                                            <i class="fa chech-star" ng-class="item.sp_danhGia >= 4 ? 'fa-star':'fa-star-o'"></i>
                                                            <i class="fa chech-star" ng-class="item.sp_danhGia == 5 ? 'fa-star':'fa-star-o'"></i>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Mới:</b></td>
                                                        <td class="text-center" align="center">
                                                            <span class="text-success" ng-if="item.sp_tinhTrang == 1">
                                                                <i class="fa fa-check"></i>
                                                            </span>
                                                            <span class="text-danger" ng-if="item.sp_tinhTrang == 0">
                                                                <i class="fa fa-times"></i>
                                                            </span>

                                                        </td>
                                                        <td><b>Trạng thái:</b></td>
                                                        <td class="text-center" ng-if="item.sp_trangThai==0">
                                                            <i class="fa fa-lock" aria-hidden="true"></i>
                                                        </td>
                                                        <td class="text-center" ng-if="item.sp_trangThai==1">
                                                            <i class="fa fa-heart text-danger" aria-hidden="true"></i>
                                                        </td>
                                                    </tr>

                                                </table>
                                            </td>
                                            <td class="text-center">
                                                <p><button class="btn  btn-sm btn-flat btn-info btn-detail" ng-click="CreateEdit_show('detail', item.sp_ma)"><i class="fa fa-eye-slash"></i></button></p>
                                                <p><button class="btn  btn-sm btn-flat bg-orange btn-edit" ng-click="CreateEdit_show('edit', item.sp_ma)"><i class="fa fa-pencil"></i></button></p>
                                                <p><button  class="btn  btn-sm btn-flat bg-purple" ng-click="CreateEdit_show('uploadIMG', item.sp_ma)"><i class="fa fa-sliders"></i></button></p>
                                                <p><button  class="btn  btn-sm btn-flat btn-danger btn-flat  btn-delete" ng-click="CreateEdit_show('delete', item.sp_ma)"><i class="fa fa-trash" ></i></button></p>
                                            </td>
                                        </tr>
                                    </tdody>
                                </table>
                        </div>
                        <div class="" ng-show="!isLoading && dsLoai.length == 0 ">
                            <table id="example1" class="table table-bordered table-hover" >
                                <thead class="text-center">
                                    <thead class="text-center">
                                      
                                        <tr >
                                            <th >
                                                <input type="checkbox" id="chkSelectItems" ng-click="checkInput()"/>
                                               <button id="btn-deleteall" class="btn btn-default btn-sm btn-flat" ng-click="CreateEdit_show('deleteAll', -1)"><i class="glyphicon glyphicon-fire" aria-hidden="true"></i></button>
                                            </th>

                                            <th>Ảnh</th>
                                            <th>Thông tin</th>
                                            <th>
                                                <button class="btn  btn-sm btn-flat  btn-refresh btn-primary" ng-click="refresh()"><i class="fa fa-refresh"></i></button>
                                                <button class="btn  btn-sm btn-flat btn-success btn-add" ng-click="CreateEdit_show('create', -1)"><i class="fa fa-plus"></i></button>
                                            </th>
                                        </tr>
                                    </thead>
                                </thead>
                                <tdody>
                                    <tr>
                                        <td colspan="4" style="width: 10% !important; text-align: center;">
                                            Chưa có dữ liệu
                                        </td>
                                    </tr>
                                </tdody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="myModal">
            <div class="modal-dialog modal-lg">
                <form name="frmCreatEdit" id="frmCreatEdit">
                    <div class="modal-content">
                        <div class="imgcontainer">
                            <span class="close" data-dismiss="modal" title="Close Modal">&times;</span>
                            <div class="title">@{{dialogTiTle}}</div>
                        </div>
                         <div class="modal-body">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <label for="name" class=""><b>Tên sản phẩm:</b></label>
                                <input type="text" id="name" name="ten" ng-model="sanpham.ten" class="form-control" placeholder="Nhập tên sản phẩm" ng-required="true"  autocomplete="off">
                                <span class="text-danger" id="dlgExistName"></span>
                            </div>
                            <div class="form-group">
                                <label for="type" class=""><b>Loại sản phẩm:</b></label>
                                <select name="maLoai" id="type" class="form-control" ng-model="sanpham.maLoai" ng-required="true" >
                                     <option ng-show="dsLoai.length == 0" value="0" ng-value="0">--Chưa có dữ liệu--</option>
                                     <option ng-repeat="l in dsLoai" value="@{{ l.l_ma }}" ng-value="l.l_ma">@{{ l.l_ten }}</option>
                                </select>
                         </div>
                         <div class="form-group">
                            <label for="brand" class=""><b>Nhà sản xuất:</b></label>
                            <select name="maHang" id="brand" class="form-control" ng-model="sanpham.maHang" ng-required="true">
                                <option ng-show="dsHang.length == 0" value="0" ng-value="0">--Chưa có dữ liệu--</option>
                                <option ng-repeat="nsx in dsHang" value="@{{ nsx.h_ma }}" ng-value="nsx.h_ma">@{{ nsx.h_ten }}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="gia" class=""><b>Giá bán:</b></label>
                            <input type="number" id="gia" name="gia" ng-model="sanpham.gia" class="form-control" ng-required="true"  autocomplete="off" min="1" max="9999999999999">
                        </div>
                         <div class="form-group">
                            <label for="giamGia" class=""><b>Giảm giá:</b></label>
                            <input type="number" id="giamGia" name="giamGia" ng-model="sanpham.giamGia" class="form-control" ng-required="true"  autocomplete="off" min="0" max="9999999999999">
                        </div>
                        <div class="form-group">
                            <label for="thongTin" class=""><b>Hương vị:</b></label>
                            <select name="maHuong" id="maHuong" class="form-control" ng-model="sanpham.maHuong"  style="width: 100%; height: 150px" multiple="multiple">
                                 <option ng-if="dsHuongvi.length == 0" value="0" ng-value="0">--Chưa có dữ liệu--</option>
                                 <option ng-repeat="hv in dsHuongvi" id="multi_@{{ hv.hv_ma }}" value="@{{ hv.hv_ma }}" ng-value="hv.hv_ma">@{{ hv.hv_ten }}</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="thongTin" class=""><b>Mô tả:</b></label>
                            <!-- <textarea ckeditor="formData.ckeditorOptions"  ng-model="sanpham.thongTin" name="thongTin" id="thongTin"></textarea> -->
                            <textarea id="editor1" name="editor1" rows="10" cols="80" ckeditor="formData.ckeditorOptions" ng-model="sanpham.thongTin" name="thongTin">

                            </textarea>
                        </div>

                        <div class="form-group" ng-if=" status=='edit' ">
                            <label for="trangthaiKhoa" class="control-label"><b>Sản phẩm mới: </b></label>
                            <span>
                                &nbsp;
                                <label class="radio-content">
                                    <input type="radio" name="tinhTrang" id="phai" ng-model="sanpham.tinhTrang" ng-value="1" value="1">
                                    <i class="fa fa-check text-success"></i> Phải
                                </label>&nbsp;&nbsp;&nbsp;&nbsp;
                                <label class="radio-content">
                                    <input type="radio" name="tinhTrang" id="khong" ng-model="sanpham.tinhTrang" ng-value="0" value="0">
                                    <i class="fa fa-times text-danger"></i> Không phải
                                </label>
                            </span>
                        </div>
                       
                        <div class="form-group">
                            <label for="trangthaiKhoa" class="control-label"><b>Trạng Thái:</b></label>
                            <span>
                                &nbsp;
                                <label class="radio-content">
                                    <input type="radio" name="trangThai" id="trangthaiKhaDung" ng-model="sanpham.trangThai" ng-value="1" value="1">
                                    <i class="fa fa-heart text-danger"></i> Hiển thị
                                </label>&nbsp;&nbsp;&nbsp;&nbsp;
                                <label class="radio-content">
                                    <input type="radio" name="trangThai" id="trangthaiKhoa" ng-model="sanpham.trangThai" ng-value="0" value="0">
                                    <i class="fa fa-lock text-blue"></i> Tạm khóa
                                </label>

                            </span>
                        </div>
                        <div class="form-group"> 
                            <button type="submit" class="btn btn-danger btn-block"  ng-click="CreateEdit_save()">@{{dialogButton}}</button>
                        </div>
                    </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="modal fade" id="myModal4">
            <div class="modal-dialog modal-lg">

                <div class="modal-content">
                    <div class="imgcontainer">
                            <span class="close" data-dismiss="modal" title="Close Modal">&times;</span>
                            <div class="title">@{{dialogTiTle}}</div>
                        </div>
                   <div class="modal-body" style="background: #fff !important">

                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                              <li class="active"><a href="#IMAGES" data-toggle="tab"><span class="glyphicon glyphicon-picture"></span> Hình ảnh</a></li>
                               <li><a href="#QUNTITY" data-toggle="tab"><span class="glyphicon glyphicon-tag"></span> Số lượng</a></li>
                            </ul>
                            <div class="tab-content">
                              
                              <div class="tab-pane active" id="IMAGES">
                                    <div id="frmUpload">
                                        <div class="ListOfFiles border-img-upload" >
                                            <div class="row" ng-if="dsHinh.length > 0" >
                                                <div class="" ng-repeat="hinh in dsHinh" style=" width: 20%; display:inline-table; margin: auto !important;">
                                                    <div class="box-img" style="margin-top: 5px;">
                                                        <img src="{{asset('public/images/products')}}/@{{hinh.ha_ten}}" width="100%" class="img-responsive" />
                                                        <button class="btn btn-sm btn-flat btn-danger btn-flat btn-uload-img left" ng-click="frmUpload_Delete(hinh.sp_ma, hinh.ha_ma)">
                                                            <span class="fa fa-trash"></span>
                                                        </button>
                                                        <button class="btn btn-sm btn-flat btn-success btn-uload-img" ng-click="frmUpload_setMainImage(hinh.sp_ma, hinh.ha_ma)">
                                                            <i class="fa fa-thumb-tack" aria-hidden="true"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row" ng-if="dsHinh.length == 0" >
                                                <div class="col-sm-12 text-center">
                                                    Sản phẩm <b>"@{{formData.upload_sp_ten}}"</b> chưa có hình
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ImageManagement">
                                            <div class="row" style="margin-top: 20px;">
                                                <div class="col-sm-7">
                                                    <input type="file" nv-file-select="" uploader="uploader" multiple="" accept=".png, .jpg, .jpeg" multiple="" />
                                                </div>
                                                <div class="col-sm-5 text-right">
                                                    <p>Số lượng: @{{ uploader.queue.length }}</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th width="50%">Tập tin</th>
                                                                <th ng-show="uploader.isHTML5">Kích thước</th>
                                                                <th ng-show="uploader.isHTML5"><i class="fa fa-tasks" aria-hidden="true"></i></th>
                                                                <th><i class="fa fa-check"></i></th>
                                                                <th>Quản lý</th>
                                                            </tr>
                                                        </thead>
                                                        <tdody>
                                                            <tr ng-repeat="item in uploader.queue" class="text-center">
                                                                <td><strong>@{{ item.file.name }}</strong></td>
                                                                <td ng-show="uploader.isHTML5" nowrap>@{{ item.file.size/1024/1024|number:2 }} MB</td>
                                                                <td ng-show="uploader.isHTML5" style="vertical-align: middle;">
                                                                    <div class="progress" style="margin-bottom: 0;">
                                                                        <div class="progress-bar" role="progressbar" ng-style="{ 'width': item.progress + '%' }"></div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <span ng-show="item.isSuccess"><i class="fa fa-check"></i></span>
                                                                    <span ng-show="item.isCancel"><i class="fa fa-ban" aria-hidden="true"></i></span>
                                                                    <span ng-show="item.isError"><i class="fa fa-remove"></i></span>
                                                                </td>
                                                                <td nowrap>
                                                                    <button type="button" class="btn btn-success btn-flat btn-sm btn-flat" ng-click="item.upload()" ng-disabled="item.isReady || item.isUploading || item.isSuccess">
                                                                        <i class="fa fa-upload" aria-hidden="true"></i>
                                                                    </button>
                                                                    <!-- <button type="button" class="btn bg-orange btn-sm btn-flat" ng-click="item.cancel()" ng-disabled="!item.isUploading">
                                                                        <i class="fa fa-ban" aria-hidden="true"></i>
                                                                    </button> -->
                                                                    <button type="button" class="btn btn-danger btn-flat btn-sm btn-flat" ng-click="item.remove()">
                                                                        <i class="fa fa-remove"></i>
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                        </tdody>
                                                    </table>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div>
                                                        <div style="margin: 10px">
                                                            Tiến trình upload:
                                                            <div class="progress" style="margin-top: 10px; margin-bottom: 10px;">
                                                                <div class="progress-bar" role="progressbar" ng-style="{ 'width': uploader.progress + '%' }"></div>
                                                            </div>
                                                        </div>
                                                        <button type="button" class="btn btn-success btn-flat btn-s" ng-click="uploader.uploadAll()" ng-disabled="!uploader.getNotUploadedItems().length">
                                                            <span class="glyphicon glyphicon-upload"></span> Lưu ảnh
                                                        </button>
                                                       <!--  <button type="button" class="btn bg-orange btn-s" ng-click="uploader.cancelAll()" ng-disabled="!uploader.isUploading">
                                                            <span class="glyphicon glyphicon-ban-circle"></span> Hủy bỏ
                                                        </button> -->
                                                        <button type="button" class="btn btn-danger btn-flat btn-s" ng-click="uploader.clearQueue()" ng-disabled="!uploader.queue.length">
                                                            <span class="glyphicon glyphicon-trash"></span> Xóa 
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 
                                    </div>
                              </div>
 
                              <div class="tab-pane" id="QUNTITY">
                                <table class="table" id="tableSoLuong">
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Tùy chọn</th>
                                            <th>N.Sản Xuất</th>
                                            <th>H.Sử dụng</th>
                                            <th>Số lượng</th>
                                            <th><button type="button" class="btn btn-xs btn-flat bg-olive" ng-click="CreateEditSoLuong_show('create', -1)"><i class="fa fa-plus"></i></button></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        <tr ng-repeat="sl in dsSoLuongNhap">
                                            <script type="text/javascript" >
                                                app.filter("asDate", function () {
                                                    return function (input) {
                                                        return new Date(input);
                                                    }
                                                });
                                            </script>
                                            <td>@{{ $index+1 }}</td>
                                            <td>@{{ sl.hv_ten }}</td>
                                            <td>@{{ sl.n_ngaySX | asDate | date:'dd-MM-yyyy' }}</td>
                                            <td>@{{ sl.n_hanSD | asDate | date:'dd-MM-yyyy' }}</td>
                                            <td>@{{ sl.n_soLuong }}</td>
                                            <td>
                                                <button type="button" class="btn btn-xs btn-flat bg-orange" ng-click="CreateEditSoLuong_show('edit', sl.n_ma)"><i class="fa fa-edit"></i></button>
                                                 <button type="button" class="btn btn-xs btn-flat btn-danger btn-flat" ng-click="CreateEditSoLuong_show('delete', sl.n_ma)"><i class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>         
                                </table>
                                <div class="hidden" id="frmSoluong">
                                    <a ng-click="CreateEditSoLuong_show('list', -1)" href=""><i class="fa fa-undo" aria-hidden="true"></i> Danh sánh</a>
                                    <br/><br/>
                                    <form name="frmaddproduct" id="frmaddproduct">
                                        <div class="form-group">
                                            <label for="thongTin" class=""><b>Hương vị:</b></label>
                                            <select name="maHuong" id="maHuong" class="form-control" ng-model="nhap.maHuong"  style="width: 100%;">
                                                 <option ng-if="dsChitiethuong.length == 0" value="0" ng-value="0">--Chưa có dữ liệu--</option>
                                                 <option ng-repeat="hv in dsChitiethuong" id="multi_@{{ hv.hv_ma }}" value="@{{ hv.hv_ma }}" ng-value="hv.hv_ma">@{{ dsHuongvi.dbFind("hv_ma", hv.hv_ma).hv_ten }}</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="soluong" class=""><b>Số lượng:</b></label>
                                            <input type="number" id="soluong" name="soluong" ng-model="nhap.soluong" class="form-control"  min="1" max="999999" value="10" required="" />
                                        </div>
                                        <div class="form-group">
                                            <label for="ngaysanxuat" class=""><b>Ngày sản xuất:</b></label>
                                            <input type="date" id="ngaysanxuat" name="ngaysanxuat" ng-model="nhap.ngaysanxuat" class="form-control " required="">
                                        </div>
                                        <div class="form-group">
                                            <label for="hansudung" class=""><b>Hạn sử dụng:</b></label>
                                            <input type="date" id="hansudung" name="hansudung" ng-model="nhap.hansudung" class="form-control " required="">
                                        </div>
                                        <div class="form-group"> 
                                            <button type="submit" class="btn btn-danger btn-block" >@{{dialogButton}}</button>
                                        </div>
                                    </form>
                                </div>
                              </div>

                          </div>
                        
                    </div>

                    </div>
                </div>

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

        <div class="modal fade" id="myModal3">
            <div class="modal-dialog">
                
                <div class="modal-content">
                    <div class="imgcontainer">
                            <span class="close" data-dismiss="modal" title="Close Modal">&times;</span>
                            <div class="title">@{{dialogTiTle}}</div>
                        </div>
                     <div class="modal-body">
                        <img src="{{asset('public/images/products')}}/@{{showimg}}" width="100%" height="100%" />
                    </div>
                </div>
            </div>
        </div>


    </section>
</div>
@endsection
