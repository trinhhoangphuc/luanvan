
@extends('layouts.admin.master')

@section('title')
    Redshop - Quản lý Đơn hàng
@endsection

@section("donhang")
    active
@endsection

@section('noidung')
<script src="{{asset('public/App/DonhangController.js')}}"></script>
<div class="content-wrapper" ng-controller="donhangController">

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

                    <div class="box-body" class="">
                        <table width="100%" ng-show="isLoading">
                            <tr>
                                <td width="45%" class="text-right">Dữ liệu đang được tải về</td>
                                <td width="150" class="text-center">
                                    <md-progress-circular class="md-warn" md-diameter="100" md-mode="indeterminate"></md-progress-circular>
                                </td>
                                <td width="45% " style="text-align: left !important;">Xin chờ trong giây lát...</td>
                            </tr>
                        </table>
                        <div class="table-responsive" style="padding: 0px 15px" ng-show="!isLoading && dsDonhang.length != 0">
                            <table id="example1" class="table table-bordered table-hover" datatable="ng" dt-options="dtOptions" dt-columns="dtColumns">
                                <thead class="text-center">
                                    <tr >
                                        <th>STT</th>
                                        <th>Mã đơn</th>
                                        <th>Ngày đặt</th>
                                        <th>Thanh toán</th>
                                        <th>Trạng Thái</th>
                                        <th>
                                            <button class="btn   btn-sm btn-flat btn-primary btn-refresh" ng-click="refresh()"><i class="fa fa-refresh"></i></button>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody ng-if="dsDonhang.length > 0">
                                	<script type="text/javascript" >
                                		app.filter("asDate", function () {
                                			return function (input) {
                                				return new Date(input);
                                			}
                                		});
                                	</script>
                                    <tr  ng-repeat="item in dsDonhang" id="tr_@{{item.dh_ma}}" ng-class="item.dh_ma == newMember_Data? 'bg-default':''">
                                                                                
                                        <td class="text-dark"><b>@{{$index+1}}</b></td>
                                        <td class="text-dark"><b>#@{{item.dh_ma}}</b></td>

                                        <td class="text-dark">@{{ item.dh_taoMoi | asDate | date:'dd-MM-yyyy HH:mm:ss' }}</td>
                                        <td>
                                            <span ng-if="item.dh_daThanhToan == 1" class="label bg-green">Đã thanh toán</span>
                                            <span ng-if="item.dh_daThanhToan == 0" class="label bg-warning">Chưa thanh toán</span>
                                            <span ng-if="item.dh_trangThai == 2" class="label bg-red">Hủy đơn</span>
                                        </td>
                                        <td>
                                            <span ng-if="item.dh_trangThai == 0" class="label bg-orange">Chờ xác nhận</span>
                                            <span ng-if="item.dh_trangThai == 1" class="label label-info">Đã xác nhận</span>
                                            <span ng-if="item.dh_trangThai == 2" class="label label-danger">Hủy đơn</span>
                                            <span ng-if="item.dh_trangThai == 3" class="label bg-olive">Hoàn tất</span>
                                        </td>
                                        <td >
                                             <button class="btn btn-sm btn-flat bg-olive btn-print" ng-if="item.dh_trangThai != 0" ng-click="xuatHoaDonLe(item.dh_ma)">
                                                <i class="fa fa-print" aria-hidden="true"></i>
                                            </button>
                                            <button class="btn btn-sm btn-flat btn-info btn-detail" ng-click="CreateEdit_show('detail', item.dh_ma)">
                                                <i class="fa fa-eye-slash"></i></button>
                                            <button class="btn btn-sm btn-flat bg-orange btn-edit" ng-click="CreateEdit_show('edit', item.dh_ma)"><i class="fa fa-pencil"></i></button>
                                            <button class="btn btn-sm btn-flat btn-danger btn-flat btn-delete" ng-click="CreateEdit_show('delete', item.dh_ma)"><i class="fa fa-trash" ></i></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="" ng-show="!isLoading && dsDonhang.length == 0 ">
                            <table id="example1" class="table table-bordered table-hover" >
                                <thead class="text-center">
                                    <tr >

                                        <th>STT</th>
                                        <th>Mã đơn</th>
                                        <th>Ngày đặt</th>
                                        <th>Thanh toán</th>
                                        <th>Trạng Thái</th>
                                        <th>
                                            <button class="btn btn-sm btn-flat btn-primary btn-refresh" ng-click="refresh()"><i class="fa fa-refresh"></i></button>
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
            <div class="modal-dialog modal-lg">
                
                <div class="modal-content">
                    <div class="imgcontainer">
                            <span class="close" data-dismiss="modal" title="Close Modal">&times;</span>
                            <div class="title">@{{dialogTiTle}}</div>
                        </div>
                    <div class="modal-body">
                        <div class="order-title">
                            <p>Chi tiết đơn hàng #@{{ itemDH.dh_ma }}
                            </p>
                            <p style="font-size: 15px;">Ngày đặt hàng: @{{ itemDH.dh_taoMoi | asDate | date:'dd-MM-yyyy HH:mm:ss' }}</p>
                        </div>

                        <div class="row">

                            <div class="col-sm-6"><br/>
                                <p style="font-size: 16px;">ĐỊA CHỈ NGƯỜI ĐẶT</p>
                                <div class="box-info">
                                    <p><b>@{{ dsKhachhang.dbFind("kh_ma", itemDH.kh_ma).kh_hoTen}}</b></p>
                                    <p>Địa chỉ: @{{ dsKhachhang.dbFind("kh_ma", itemDH.kh_ma).kh_diaChi}}</p>
                                    <p>Điện thoại: @{{ dsKhachhang.dbFind("kh_ma", itemDH.kh_ma).kh_dienThoai}}</p>
                                </div>
                            </div>

                            <div class="col-sm-6"><br/>
                                <p style="font-size: 16px;">ĐỊA CHỈ NGƯỜI NHẬN</p>
                                <div class="box-info">
                                    <p><b> @{{ itemDH.dh_nguoiNhan }}</b></p>
                                    <p>Địa chỉ:  @{{ itemDH.dh_diaChi }}</p>
                                    <p>Điện thoại:  @{{ itemDH.dh_dienThoai }}</p>
                                </div>
                            </div>

                            <div class="col-sm-6"><br/>
                                <p style="font-size: 16px;">HÌNH THỨC GIAO HÀNG</p>
                                <div class="box-info">
                                    <p>@{{ itemDH.vc_ten }} </p>
                                    <p>Phí vận chuyển: @{{ itemDH.vc_gia | number : 0 }} ₫</p>
                                </div>
                            </div>

                            <div class="col-sm-6"><br/>
                                <p style="font-size: 16px;">HÌNH THỨC THANH TOÁN</p>
                                <div class="box-info">
                                    <p>@{{ itemDH.tt_ten }}</p>
                                    <p>
                                        <span ng-if="itemDH.dh_daThanhToan == 1" class="label bg-green">Đã thanh toán</span>
                                        <span ng-if="itemDH.dh_daThanhToan == 0" class="label bg-red">Chưa thanh toán</span>
                                    </p>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="order-product table-responsive">
                                    <table class="table table-order">
                                        <thead>
                                            <tr>
                                                <th width="8%">Ảnh</th>
                                                <th class="text-center">Sản phẩm</th>
                                                <th class="text-center">Hương vị</th>
                                                <th class="text-center">Giá</th>
                                                <th class="text-center">Số lượng</th>
                                                <th class="text-right">Thành tiền</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php  $tamtinh = 0;  ?>
                                           
                                            <tr ng-repeat="itemCTDH in dsCTDH">
                                                <td class="text-center">
                                                   <img src="{{asset('public/images/products')}}/@{{ itemCTDH.sp_hinh }}" width="100%">
                                                </td>
                                                <td class="text-center"><a href="" style="color: #333"><b>@{{ itemCTDH.sp_ten }}</b></a></td>
                                                <td class="text-center"><b>@{{ itemCTDH.hv_ten }}</b></td>
                                                <td class="text-center">@{{ itemCTDH.ctdh_donGia | number:0 }} đ</td>
                                                <td class="text-center">@{{ itemCTDH.ctdh_soluong }}</td>
                                                <td class="text-right">@{{ itemCTDH.ctdh_donGia * itemCTDH.ctdh_soluong | number:0 }} đ</td>
                                            </tr>


                                            <tr>
                                                <td class="text-right" colspan="6" style="font-size: 18px;">
                                                    <br/>
                                                    <p style="font-size: 15px;">Tổng tạm tính <span style="margin-left: 50px">@{{ itemDH.dh_tongTien - itemDH.vc_gia | number:0 }} đ</span></p>
                                                    <p style="font-size: 15px;">Phí vận chuyển <span style="margin-left: 50px">@{{ itemDH.vc_gia| number:0 }} đ</span></p>
                                                    <p>Tổng cộng <span style="margin-left: 50px; color: red" >@{{ itemDH.dh_tongTien | number:0 }} đ</span></p>
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
                                    <button type="submit" class="btn bg-red btn-block">@{{dialogButton}}</button>
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
                        <form name="frmCreatEdit" id="frmCreatEdit" method="POST">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <label for="status2" class="control-label"> Tình trạng thanh toán:</label>
                                <select name="thanhToan" id="status2" class="form-control input-rounded" ng-model="donhang.thanhToan" ng-required="true">
                                    <option  value="1" ng-value="1">Đã thanh toán</option>
                                    <option  value="0" ng-value="0">Chưa thanh toán</option>
                                    <option  value="2" ng-value="2">Hủy</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="trangthaiKhoa" class="control-label"> Trạng Thái:</label>
                              <div>
                                &nbsp;
                                <label class="radio-content">
                                    <input type="radio" name="trangThai"  ng-model="donhang.trangThai" ng-value="1" value="1">
                                    <span class="label label-info">Đã xác nhận</span>  
                                </label>&nbsp;&nbsp;&nbsp;&nbsp;
                                <label class="radio-content">
                                    <input type="radio" name="trangThai"  ng-model="donhang.trangThai" ng-value="2" value="2">
                                    <span class="label label-danger">Hủy đơn</span>    
                                </label>&nbsp;&nbsp;&nbsp;&nbsp;
                                <label class="radio-content">
                                    <input type="radio" name="trangThai"  ng-model="donhang.trangThai" ng-value="3" value="3">
                                    <span class="label bg-olive">Hoàn tất</span>   
                                </label>&nbsp;&nbsp;&nbsp;&nbsp;
                            </div>
                            <br>
                            <div class="form-group"> 
                                <button type="submit" class="btn btn-flat bg-red btn-block">@{{dialogButton}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection
