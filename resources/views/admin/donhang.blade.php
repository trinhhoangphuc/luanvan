
@extends('layouts.admin.master')

@section('title')
    Redshop - Quản lý Đơn hàng
@endsection

@section("dontu")
    active
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
                        <div class="" ng-show="!isLoading && dsDonhang.length != 0">
                            <table id="example1" class="table table-bordered table-hover" datatable="ng" dt-options="dtOptions" dt-columns="dtColumns">
                                <thead class="text-center">
                                    <tr >
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
                                	<script ="text/javascript" >
                                		app.filter("asDate", function () {
                                			return function (input) {
                                				return new Date(input);
                                			}
                                		});
                                	</script>
                                    <tr  ng-repeat="item in dsDonhang" id="tr_@{{item.dh_ma}}" ng-class="item.dh_ma == newMember_Data? 'bg-default':''">
                                                                                
                                        <td class="text-dark"><b>#@{{item.dh_ma}}</b></td>
                                        <td class="text-dark">@{{ item.dh_taoMoi | asDate | date:'dd-MM-yyyy HH:mm:ss' }}</td>
                                        <td>
                                            <span ng-if="item.dh_daThanhToan == 1" class="label bg-green">Đã thanh toán</span>
                                            <span ng-if="item.dh_daThanhToan == 0" class="label bg-red">Chưa thanh toán</span>
                                        </td>
                                        <td>
                                            <span ng-if="item.dh_trangThai == 0" class="label bg-orange">Chờ xác nhận</span>
                                            <span ng-if="item.dh_trangThai == 1" class="label label-info">Đã xác nhận</span>
                                            <span ng-if="item.dh_trangThai == 2" class="label bg-primary">Đang vận chuyển</span>
                                            <span ng-if="item.dh_trangThai == 3" class="label bg-olive">Hoàn tất</span>
                                            <span ng-if="item.dh_trangThai == 4" class="label bg-red">Hủy đơn</span>
                                        </td>
                                        <td >
                                            <button class="btn btn-sm btn-flat btn-info btn-detail" ng-click="CreateEdit_show('detail', item.dh_ma)">
                                                <i class="fa fa-eye-slash"></i></button>
                                            <button class="btn btn-sm btn-flat bg-orange btn-edit" ng-click="CreateEdit_show('edit', item.dh_ma)"><i class="fa fa-pencil"></i></button>
                                            <button class="btn btn-sm btn-flat bg-maroon btn-delete" ng-click="CreateEdit_show('delete', item.dh_ma)"><i class="fa fa-trash" ></i></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="" ng-show="!isLoading && dsDonhang.length == 0 ">
                            <table id="example1" class="table table-bordered table-hover" >
                                <thead class="text-center">
                                    <tr >

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
                    	<p><b>Mã đơn hàng: </b> #@{{ itemDH.dh_ma }}</p>
                    	<p><b>Ngày đặt: </b> @{{ itemDH.dh_taoMoi | asDate | date:'dd-MM-yyyy HH:mm:ss' }}</p>
                    	<p><b>Hinh thúc thanh toán: </b> @{{ itemDH.tt_ten }}</p>
                    	<p><b>Hình thức vận chuyển: </b> @{{ itemDH.vc_ten }}</p>
                    	<p><b>Thanh toán: </b> 
                    		<span ng-if="itemDH.dh_daThanhToan == 1" class="label bg-green">Đã thanh toán</span>
                    		<span ng-if="itemDH.dh_daThanhToan == 0" class="label bg-red">Chưa thanh toán</span>
                    	</p> 
                    	<p><b>Tình trạng: </b> 
                    		<span ng-if="itemDH.dh_trangThai == 0" class="label bg-orange">Chờ xác nhận</span>
                    		<span ng-if="itemDH.dh_trangThai == 1" class="label label-info">Đã xác nhận</span>
                    		<span ng-if="itemDH.dh_trangThai == 2" class="label bg-primary">Đang vận chuyển</span>
                    		<span ng-if="itemDH.dh_trangThai == 3" class="label bg-olive">Hoàn tất</span>
                    	</p> 
                    	<hr/>

                        <p><b>Người mua: </b> @{{ dsKhachhang.dbFind("kh_ma", itemDH.kh_ma).kh_hoTen  }}</p>
                        <p><b>Số điện thoại: </b> @{{ dsKhachhang.dbFind("kh_ma", itemDH.kh_ma).kh_dienThoai  }}</p>
                        <hr/>

                        <p><b>Người nhận: </b> @{{ itemDH.dh_nguoiNhan }}</p>
                        <p><b>Số điện thoại: </b> @{{ itemDH.dh_dienThoai }}</p>
                        <p><b>Địa chỉ: </b> @{{ itemDH.dh_diaChi }}</p>
                        <hr/>

                        <p><b>Nhân viên xử lý: </b> 
                        	<span ng-if="itemDH.dh_nguoiXuLy != null">@{{ itemDH.dh_nguoiXuLy }}</span>
                        	<span ng-if="itemDH.dh_nguoiXuLy == null">Chờ xử lý</span>
                        </p>
                        <p><b>Ngày xử lý: </b>  
	                        <span ng-if="itemDH.dh_ngayXuLy != null">@{{ itemDH.dh_ngayXuLy| asDate | date:'dd-MM-yyyy HH:mm:ss' }}</span>
	                        <span ng-if="itemDH.dh_ngayXuLy == null">Chờ xử lý</span>
	                    </p>
                        <hr/>

                        <table class="table table-bordered table-hover">
                        	<tr ng-repeat="itemCTDH in dsCTDH">
                        		<td>
                        			<img src="{{asset('public/images/products')}}/@{{ itemCTDH.sp_hinh }}" width="60px">
                        		</td>
                        		<td>
                        			<table class="table table-bordered" style="margin-bottom: -2px;">
                        				<tr>
                        					<td class="text-center" colspan="4" style="background: #FAFAFA;">
                        						<div class="product-name">@{{ itemCTDH.sp_ten }} </div>
                        					</td>
                        				</tr>
                        				<tr>
                        					<td class="text-left"><b>Giá bán:</b></td>
                        					<td class="text-right  text-danger">@{{ itemCTDH.ctdh_donGia | number:0 }} đ</td>
                        					<td class="text-left"><b>Số lượng:</b></td>
                        					<td class="text-right">@{{ itemCTDH.ctdh_soluong }}</td>
                        				</tr>
                        				<tr>
                        					<td colspan="2" class="text-left"><b>Thành tiền:</b></td>
                        					<td colspan="2" class="text-right text-danger">@{{ itemCTDH.ctdh_donGia * itemCTDH.ctdh_soluong | number:0 }} đ</td>
                        				</tr>
                        					
                        			</table>
                        		</td>
                        	</tr>
                        	<tr>
                        		<td colspan="2"><b>Tạm tính:</b> <span class="text-danger">@{{ itemDH.dh_tongTien - itemDH.vc_gia | number:0 }} đ</span></td>
                        	</tr>
                        	<tr>
                        		<td colspan="2"><b>Vận chuyển:</b> <span class="text-danger">@{{ itemDH.vc_gia | number:0 }} đ</span></td>
                        	</tr>
                        	<tr>
                        		<td colspan="2">
                        			<span style="font-size: 18px;"><b>Tổng tiền:</b> <span class="text-danger">@{{ itemDH.dh_tongTien | number:0 }} đ</span></span>
                        		</td>
                        	</tr>
                        </table>
                    </div>
                </div>

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
                    <div class="modal-header">
                        <div class="imgcontainer">
                            <span class="close" data-dismiss="modal" title="Close Modal">&times;</span>
                            <div class="logo-login-register">
                                 <h3 class="title-comm" style="margin-top: 0; margin-bottom: 0;"><span class="title-holder">@{{dialogTiTle}}</span></h3>
                            </div>
                        </div>
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
                                    <input type="radio" name="trangThai"  ng-model="donhang.trangThai" ng-value="0" value="0">
                                    <span class="label bg-orange">Chờ xác nhận</span>
                                </label>&nbsp;&nbsp;&nbsp;&nbsp;
                                <label class="radio-content">
                                    <input type="radio" name="trangThai"  ng-model="donhang.trangThai" ng-value="1" value="1">
                                    <span class="label label-info">Đã xác nhận</span>  
                                </label>&nbsp;&nbsp;&nbsp;&nbsp;
                                <label class="radio-content">
                                    <input type="radio" name="trangThai"  ng-model="donhang.trangThai" ng-value="2" value="2">
                                    <span class="label bg-primary">Đang vận chuyển</span>    
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
