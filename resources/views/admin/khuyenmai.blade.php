
@extends('layouts.admin.master')

@section('title')
    Redshop - Quản lý Khuyến mãi
@endsection

@section("dontu")
    active
@endsection

@section("khuyemai")
    active
@endsection

@section('noidung')
<script src="{{asset('public/App/KhuyenmaiController.js')}}"></script>
<div class="content-wrapper" ng-controller="khuyenmaiController">

    <section class="content-header">
        <h1>
            Đơn hàng - Khuyến mãi
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
                        <div class="" ng-show="!isLoading && dsKhuyenmai.length != 0">
                            <table id="example1" class="table table-bordered table-hover" datatable="ng" dt-options="dtOptions" dt-columns="dtColumns">
                                <thead class="text-center">
                                    <tr >
                                        <th>Mã đơn</th>
                                        <th>Tên</th>
                                        <th>Bắt đầu</th>
                                        <th>Kết thúc</th>
                                        <th>Trạng Thái</th>
                                        <th>
                                            <button class="btn   btn-sm btn-flat btn-primary btn-refresh" ng-click="refresh()"><i class="fa fa-refresh"></i></button>
                                            <button class="btn   btn-sm btn-flat bg-olive btn-add" ng-click="CreateEdit_show('create', -1)"><i class="fa fa-plus"></i></button>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody ng-if="dsKhuyenmai.length > 0">
                                	<script type="text/javascript" >
                                		app.filter("asDate", function () {
                                			return function (input) {
                                				return new Date(input);
                                			}
                                		});
                                	</script>
                                    <tr  ng-repeat="item in dsKhuyenmai" id="tr_@{{item.km_ma}}" ng-class="item.km_ma == newMember_Data? 'bg-default':''">
                                                                                
                                        <td>#@{{ item.km_ma }}</td>
                                        <th class="text-center">@{{ item.km_ten }}</th class="text-center">
                                        <td>@{{ item.km_batDau| asDate | date:'dd-MM-yyyy' }}</td>
                                        <td>@{{ item.km_ketThuc| asDate | date:'dd-MM-yyyy' }}</td>
                                        <td>
                                        	<span ng-if="item.km_trangThai == 1" class="label bg-green">Hiển thị</span>
                                            <span ng-if="item.km_trangThai == 0" class="label bg-red">Khóa</span>
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-flat btn-info btn-detail" ng-click="CreateEdit_show('detail', item.km_ma)"><i class="fa fa-eye-slash"></i></button>
                                            <button  class="btn  btn-sm btn-flat bg-purple" ng-if="item.km_trangThai == 1" ng-click="CreateEdit_show('addProduct', item.km_ma)"><i class="fa fa-sliders"></i></button>
                                            <button class="btn btn-sm btn-flat bg-orange btn-edit" ng-click="CreateEdit_show('edit', item.km_ma)"><i class="fa fa-pencil"></i></button>
                                            <button class="btn btn-sm btn-flat bg-maroon btn-delete" ng-click="CreateEdit_show('delete', item.km_ma)"><i class="fa fa-trash" ></i></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="" ng-show="!isLoading && dsKhuyenmai.length == 0 ">
                            <table id="example1" class="table table-bordered table-hover" >
                                <thead class="text-center">
                                    <tr >

                                        <th>Mã đơn</th>
                                        <th>Ngày đặt</th>
                                        <th>Thanh toán</th>
                                        <th>Trạng Thái</th>
                                        <th>
                                            <button class="btn   btn-sm btn-flat btn-primary btn-refresh" ng-click="refresh()"><i class="fa fa-refresh"></i></button>
                                            <button class="btn   btn-sm btn-flat bg-olive btn-add" ng-click="CreateEdit_show('create', -1)"><i class="fa fa-plus"></i></button>
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
                                <label for="name" class=""><b>Tiêu đề:</b></label>
                                <input type="text" id="name" name="ten" ng-model="khuyenmai.ten" class="form-control " placeholder="Nhập tiêu đề khuyến mãi" ng-required="true"autocomplete="off">
                                <span class="error" id="dlgExistName"></span>
                            </div>
                            <div class="form-group">
                                <label for="noiDung" class=""><b>Mô tả ngắn:</b></label>
                                <textarea id="moTaNgan" name="moTaNgan" rows="5"  class="form-control" ng-model="khuyenmai.moTaNgan"></textarea>
                               
                            </div>
                            <div class="form-group">
                                <label for="noiDung" class=""><b>Nội dung:</b></label>
                               <!--  <textarea ckeditor="formData.ckeditorOptions"  ng-model="khuyenmai.thongTin" name="thongTin" id="thongTin"></textarea> -->
                                    <textarea id="editor1"rows="10" cols="80" ckeditor="formData.ckeditorOptions" ng-model="khuyenmai.noiDung" name="noiDung">
                                     
                                    </textarea>
                               
                            </div>
                            <div class="form-group">
                                <label for="ngayBD" class=""><b>Ngày bắt đầu:</b></label>
                                <input type="date" id="ngayBD" name="ngayBD" ng-model="khuyenmai.ngayBD" class="form-control " required="">
                            </div>
                            <div class="form-group">
                                <label for="ngayKT" class=""><b>Ngày kết thúc:</b></label>
                                <input type="date" id="ngayKT" name="ngayKT" ng-model="khuyenmai.ngayKT" class="form-control " required="">
                            </div>
                            <div class="form-group">
                                <label for="trangthaiKhoa" class="control-label"><b>Trạng Thái:</b></label>
                                <div>
                                    &nbsp;
                                    <label class="radio-content">
                                        <input type="radio" name="trangThai" id="trangthaiKhaDung" ng-model="khuyenmai.trangThai" ng-value="1" value="1">
                                        <i class="fa fa-heart text-danger"></i> Hiển thị
                                    </label>&nbsp;&nbsp;&nbsp;&nbsp;
                                    <label class="radio-content">
                                        <input type="radio" name="trangThai" id="trangthaiKhoa" ng-model="khuyenmai.trangThai" ng-value="0" value="0">
                                        <i class="fa fa-lock text-blue"></i> Tạm khóa
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
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="imgcontainer">
                            <span class="close" data-dismiss="modal" title="Close Modal">&times;</span>
                       </div>
                   </div>
                   <div class="modal-body">
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#IMAGES" data-toggle="tab"><span class="glyphicon glyphicon-picture"></span> Danh sách</a></li>
                                <li><a href="#QUNTITY" data-toggle="tab"><span class="glyphicon glyphicon-tag"></span> Thêm sản phẩm</a></li>
                            </ul>
                            <div class="tab-content" style="padding: 0px !important;">
                                <div class="tab-pane active" id="IMAGES">
                                    <form method="POST" name="frmUpdateDiscount" id="frmUpdateDiscount">
                                   <table class="table" id="tableSoLuong" datatable="ng" dt-options="dtOptions" dt-columns="dtColumns">
                                    <thead>
                                        <tr>
                                            <th>Ảnh</th>
                                            <th>Tên sản phẩm</th>
                                            <th>Giá gốc</th>
                                            <th>Giảm giá</th>
                                            <th>
                                                <button type="submit" class="btn btn-xs btn-flat bg-olive">Cập nhật</button>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr ng-repeat="item in dsChitietKhuyenMai">
                                            <script type="text/javascript" >
                                                app.filter("asDate", function () {
                                                    return function (input) {
                                                        return new Date(input);
                                                    }
                                                });
                                            </script>
                                            <td width="10%"><img src="{{asset('public/images/products')}}/@{{ item.sp_hinh }}" alt="@{{ item.sp_ten }}" width="100%"></td>
                                            <td>@{{ item.sp_ten }}</td>
                                            <td>@{{ item.sp_giaBan | number: 0 }} ₫</td>
                                            <td width="20%">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                                <input type="number" min="0" max="99999999999" value="@{{ item.kmsp_giaTri }}" class="form-control" name="discount_@{{ item.sp_ma }}" id="discount_@{{ item.sp_ma }}" />
                                            </td>
                                            <td>
                                                
                                                <button type="button" class="btn btn-xs btn-flat btn-danger" ng-click="Product_Delete( item.ctkm_ma)"><i class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>         
                                    </table>
                                </form>
                                </div>

                                <div class="tab-pane" id="QUNTITY" >
                                    <br/>
                                    <table class="table table-bordered table-responsive">
                                        <thead>
                                            <tr>
                                                <th class="text-left">
                                                    <input type="checkbox" id="chkSelectItems" ng-click="checkInput()"/> Chọn tất cả &nbsp;&nbsp;
                                                    <button type="button" class="btn btn-sm btn-flat btn-danger" ng-click="saveProduct()">Chọn sản phẩm</button>
                                                </th>
                                                <th>
                                                    <select name="" class="form-control" ng-model="loai.l_ma" ng-change="changeProduct()">
                                                        <option value="0" ng-value="0">Tất cả sản phẩm</option>
                                                        <option ng-repeat="item in dsLoai" ng-value="@{{ item.l_ma }}" value="@{{ item.l_ma }}" >@{{ item.l_ten }}</option>
                                                    </select>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr ng-if="dsSanPhamTheoLoai.length != 0">
                                                <td colspan="2" >
                                                    <div class="box-promotion">

                                                        <div class="col-sm-2" ng-repeat="item in dsSanPhamTheoLoai">
                                                            <div class="box-product-km">
                                                                <div class="input-asol"><input type="checkbox" id="chk@{{ $index+1 }}" value="@{{item.sp_ma}}" /></div>
                                                                <img src="{{asset('public/images/products')}}/@{{ item.sp_hinh }}" alt="@{{ item.sp_ten }}" width="100%">
                                                                <p>@{{ item.sp_ten }}</p>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </td>
                                            </tr>
                                            <tr ng-if="dsSanPhamTheoLoai.length <= 0">
                                                <td colspan="2" class="text-center">
                                                    <h1>Chưa có dữ liệu</h1>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        
                   </div>
               </div>
            </div>
        </div>

        <div class="modal fade" id="myModal3">
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
