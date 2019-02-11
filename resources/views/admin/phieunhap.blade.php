
@extends('layouts.admin.master')

@section('title')
    Redshop - Quản lý phiếu nhập
@endsection

@section("dontu")
    active
@endsection

@section("phieunhap")
    active
@endsection

@section('noidung')
<script src="{{asset('public/App/PhieunhapController.js')}}"></script>
<div class="content-wrapper" ng-controller="phieunhapController">

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
                        <div class="" ng-show="!isLoading && dsPhieunhap.length != 0">
                            <table id="example1" class="table table-bordered table-hover" datatable="ng" dt-options="dtOptions" dt-columns="dtColumns">
                                <thead class="text-center">
                                    <tr >
                                        <th>
                                            <input type="checkbox" id="chkSelectItems" ng-click="checkInput()"/>
                                            <button id="btn-deleteall" class="btn btn-default btn-sm" ng-click="CreateEdit_show('deleteAll', -1)"><i class="glyphicon glyphicon-fire" aria-hidden="true"></i></button>
                                        </th>

                                        <th>Số hóa đơn</th>
                                        <th>Nhà cung cấp</th>
                                        <th>Ngày xuất</th>
                                        <th>Trạng Thái</th>
                                        <th>
                                            <button class="btn   btn-sm btn-flat btn-primary btn-refresh" ng-click="refresh()"><i class="fa fa-refresh"></i></button>
                                            <button class="btn   btn-sm btn-flat bg-olive btn-add" ng-click="CreateEdit_show('create', -1)"><i class="fa fa-plus"></i></button>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody ng-if="dsPhieunhap.length > 0">
                                    <tr  ng-repeat="item in dsPhieunhap" id="tr_@{{item.pn_ma}}" ng-class="item.pn_ma == newMember_Data? 'bg-default':''">
                                        <td><input type="checkbox" id="chk@{{ $index+1 }}" value="@{{ item.pn_ma }}" /></td>

                                        <td class="text-dark"><b>@{{item.pn_soHoaDon}}</b></td>
                                        <td class="text-dark">@{{dsNhacungcap.dbFind("ncc_ma", item.ncc_ma).ncc_ten }}</td>
                                        <script ="text/javascript" >
                                            app.filter("asDate", function () {
                                                return function (input) {
                                                    return new Date(input);
                                                }
                                            });
                                        </script>
                                        <td class="text-dark">@{{ item.pn_ngayXuatHoaDon | asDate | date:'dd-MM-yyyy' }}</td>
                                        <td>
                                            <span ng-if="item.pn_trangThai == 1" class="label bg-green">Đã thanh toán</span>
                                            <span ng-if="item.pn_trangThai == 0" class="label bg-red">Chưa thanh toán</span>
                                        </td>
                                        <td >
                                            <button class="btn btn-sm btn-flat btn-info btn-detail" ng-click="CreateEdit_show('detail', item.pn_ma)">
                                                <i class="fa fa-eye-slash"></i></button>
                                            <button class="btn btn-sm btn-flat bg-orange btn-edit" ng-click="CreateEdit_show('edit', item.pn_ma)"><i class="fa fa-pencil"></i></button>
                                             <button class="btn btn-sm btn-flat bg-purple btn-edit" ng-click="CreateEdit_show('addProduct', item.pn_ma)"><i class="glyphicon glyphicon-th-list"></i></button>
                                            <button class="btn btn-sm btn-flat bg-maroon btn-delete" ng-click="CreateEdit_show('delete', item.pn_ma)"><i class="fa fa-trash" ></i></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="" ng-show="!isLoading && dsPhieunhap.length == 0 ">
                            <table id="example1" class="table table-bordered table-hover" >
                                <thead class="text-center">
                                    <tr >
                                        <th>
                                            <input type="checkbox" id="chkSelectItems" ng-click="checkInput()"/>
                                            <button id="btn-deleteall" class="btn btn-default btn-sm" ng-click="CreateEdit_show('deleteAll', -1)"><i class="glyphicon glyphicon-fire" aria-hidden="true"></i></button>
                                        </th>

                                        <th >Số hóa đơn</th>
                                        <th >Nhà cung cấp</th>
                                        <th >Ngày xuất</th>
                                        <th width="25%">Trạng Thái</th>
                                        <th >
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
                                <label for="sohoadon" class=""><b>Số hóa đơn:</b></label>
                                <input type="text" id="sohoadon" name="sohoadon" ng-model="phieunhap.sohoadon" class="form-control " placeholder="Nhập tên Số hóa đơn" ng-required="true">
                                <span class="error" id="dlgExistName"></span>
                            </div>
                            <div class="form-group">
                                <label for="maNCC" class=""><b>Nhà cung cấp:</b></label>
                                <select name="maNCC" id="maNCC" class="form-control" ng-model="phieunhap.maNCC">
                                    <option ng-show="dsNhacungcap.length == 0" value="0" ng-value="0">--Chưa có dữ liệu--</option>
                                    <option ng-repeat="cv in dsNhacungcap" value="@{{ cv.ncc_ma }}" ng-value="cv.ncc_ma">@{{ cv.ncc_ten }}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="ngayxuathoadon" class=""><b>Ngày xuất hóa đơn:</b></label>
                                <input type="date" id="ngayxuathoadon" name="ngayxuathoadon" ng-model="phieunhap.ngayxuathoadon" class="form-control " ng-required="true">
                            </div>
                             <div class="form-group">
                                <label for="brand" class=""><b>Nhân viên thanh toán:</b></label>
                                <select  class="form-control" ng-model="phieunhap.maNVTT">
                                    <option ng-repeat="item in dsNhanvien" value="@{{item.nv_hoTen}}" ng-value="item.nv_hoTen">@{{item.nv_hoTen}}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="ngaythanhtoan" class=""><b>Ngày thanh toán:</b></label>
                                <input type="date" id="ngaythanhtoan" name="ngaythanhtoan" ng-model="phieunhap.ngaythanhtoan" class="form-control ">
                            </div>
                            <div class="form-group">
                                <label for="ghichu" class=""><b>Ghi chú:</b></label>
                                <textarea iname="ghichu" class="form-control " rows="5" cols="30" ng-model="phieunhap.ghichu" name="ghichu">
                                </textarea>
                            </div>
                           
                            <div class="form-group">
                                <label for="trangthaiKhoa" class="control-label"><b>Trạng Thái:</b></label>
                                <div>
                                    &nbsp;
                                    <label class="radio-content">
                                        <input type="radio" name="trangThai" id="trangthaiKhaDung" ng-model="phieunhap.trangThai" ng-value="1" value="1">
                                        <i class="glyphicon glyphicon-check text-success"></i> Đã thanh toán
                                    </label>&nbsp;&nbsp;&nbsp;&nbsp;
                                    <label class="radio-content">
                                        <input type="radio" name="trangThai" id="trangthaiKhoa" ng-model="phieunhap.trangThai" ng-value="0" value="0">
                                        <i class="glyphicon glyphicon-remove-sign text-danger"></i> Chưa thanh toán
                                    </label>
                                    
                                </div>
                            </div>
                            <div class="form-group"> 
                                <button type="submit" class="btn bg-maroon btn-block" >@{{dialogButton}}</button>
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

        <div class="modal fade" id="myModal3">
            <div class="modal-dialog modal-lg">
        
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
                            <button type="button" class="btn btn-flat bg-olive" ng-click="ShowCreateEdit_Item('list', -1)">
                                <i class="glyphicon glyphicon-list"></i> Danh sách
                            </button>
                            <div class="row"  >
                                <div class="col-sm-12">
                                    <div id="table-addproduct" class="hidden">
                                        <br/>
                                        <table style="margin-top: 6px;" class="table table-bordered table-hover" datatable="ng" dt-options="dtOptions" dt-columns="dtColumns">
                                            <thead class="text-center">
                                                <tr >
                                                    <th>Ảnh</th>
                                                    <th class="text-center">Tên sản phẩm</th>
                                                    <th class="text-center">SL nhập</th>
                                                    <th class="text-center">Tồn kho</th>
                                                    <th>
                                                        <button class="btn btn-xs btn-flat btn-primary btn-refresh-2" ng-click="refresh-2()">
                                                            <i class="fa fa-refresh"></i>
                                                        </button>
                                                        <button class="btn btn-xs btn-flat bg-olive btn-add-2" ng-click="ShowCreateEdit_Item('create', id_member)">
                                                            <i class="fa fa-plus"></i>
                                                        </button>
                                                    </th>

                                                </tr>
                                            </thead>
                                            <tbody ng-if="dsSanpham.length > 0">
                                                <tr  ng-repeat="item in dsSanpham" id="trpn_@{{$index}}" ng-class="item.sp_ma == newMember_Data? 'bg-default':''">
                                                    <td class="text-dark" style="width: 10% !important;">
                                                        <div id="img-product-box">
                                                            <img src="{{asset('public/images/products')}}/@{{item.sp_hinh}}" id="img-product">
                                                        </div>
                                                    </td>
                                                    <td class="text-center"><b>@{{item.sp_ten}}</b></td>
                                                    <td class="text-center"><b>@{{item.ctn_soLuong}}</b></td>
                                                    <td class="text-center"><b>@{{item.ctn_soLuong}}</b></td>
                                                    <td>
                                                        <button class="btn btn-xs btn-flat btn-info btn-detail-2" ng-click="ShowCreateEdit_Item('detail', $index)">
                                                            <i class="fa fa-eye-slash"></i>
                                                        </button>
                                                        <button class="btn btn-xs btn-flat bg-orange btn-edit-2" ng-click="ShowCreateEdit_Item('edit', item.ctn_ma)">
                                                            <i class="fa fa-pencil"></i>
                                                        </button>
                                                        <button class="btn btn-xs btn-flat bg-maroon btn-delete-2" ng-click="ShowCreateEdit_Item('delete', item.ctn_ma)">
                                                            <i class="fa fa-trash" ></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <br/>
                                    <div id="form-addproduct" class="hidden" style="margin-top: 10px;">
                                        <form name="frmaddproduct" id="frmaddproduct">
                                            <div class="form-group">
                                                <label for="ngaythanhtoan" class=""><b>Sản phẩm:</b></label>
                                                <select name="maSP" id="maSP" class="form-control" ng-model="sanpham.maSP">
                                                    <option ng-show="dsSanpham_2.length == 0" value="0" ng-value="0">--Chưa có dữ liệu--</option>
                                                    <option ng-repeat="sp_2 in dsSanpham_2" value="@{{ sp_2.sp_ma }}" ng-value="sp_2.sp_ma">@{{ sp_2.sp_ten }}</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="soluong" class=""><b>Số lượng:</b></label>
                                                <input type="number" id="soluong" name="soluong" ng-model="sanpham.soluong" class="form-control"  min="1" max="999999" value="10" required="" />
                                            </div>
                                            <div class="form-group" ng-if="status == 'edit'">
                                                <label for="tonkho" class=""><b>Tồn kho:</b></label>
                                                <input type="number" id="tonkho" name="tonkho" ng-model="sanpham.tonkho" class="form-control"  min="1" max="999999" value="10" required="" />
                                            </div>
                                            <div class="form-group">
                                                <label for="soluong" class=""><b>Giá nhập:</b></label>
                                                <input type="number" id="gianhap" name="gianhap" ng-model="sanpham.gianhap" class="form-control"  min="1" max="99999999999999999" value="10" required="" />
                                            </div>
                                            <div class="form-group">
                                                <label for="ngaysanxuat" class=""><b>Ngày sản xuất:</b></label>
                                                <input type="date" id="ngaysanxuat" name="ngaysanxuat" ng-model="sanpham.ngaysanxuat" class="form-control " required="">
                                            </div>
                                            <div class="form-group">
                                                <label for="hansudung" class=""><b>Hạn sử dụng:</b></label>
                                                <input type="date" id="hansudung" name="hansudung" ng-model="sanpham.hansudung" class="form-control " required="">
                                            </div>
                                            <div class="form-group"> 
                                                <button type="submit" class="btn bg-maroon btn-block" >@{{dialogButton}}</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
 
            </div>
        </div>

    </section>
</div>

@endsection
