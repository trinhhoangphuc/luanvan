
@extends('layouts.admin.master')

@section('title')
    Redshop - Thông tin cá nhân
@endsection

@section('noidung')

<div class="content-wrapper">

    <section class="content-header">
        <h1>
			Thông tin cá nhân
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
            <li class="active">thông tin cá nhân</li>
        </ol>
    </section>

    <section class="content">

    	<div class="row">
    		<div class="col-sm-2"></div>
    		<div class="col-sm-8">
    			<div class="box" >
    				<div class="box-body">
    					<form name="frmCreatEdit" id="frmCreatEdit">
    						<input type="hidden" name="_token" value="{{ csrf_token() }}">
    						<div class="form-group text-center">
    							<img class="user_avatar" id="output" src="{{asset('public/images/avatar/staff/'.$nhanvien->nv_hinh)}}">
    							<label for="avtuser" class="labelforfile"><i class="fas fa-file-image"></i> Chọn ảnh</label>
    							<input class="form-control" name="avtuser" id="avtuser" type="file" accept="image/*" onchange="loadFile(event)" style="display: none">
    							<script>
    								var loadFile = function(event) {
    									var output = document.getElementById('output');
    									output.src = URL.createObjectURL(event.target.files[0]);
    								};
    							</script>
    						</div>
    						<div class="form-group">
    							<label for="name" class=""><b>Họ & Tên:</b></label>
    							<input type="text" id="name" name="name" class="form-control" placeholder="Nhập tên sản phẩm" value="{{$nhanvien->nv_hoTen}}" />
    						</div>
    						<div class="form-group">
    							<label for="email" class=""><b>Email:</b></label>
    							<input type="email" id="email" name="email" class="form-control" placeholder="Nhập địa chỉ email" readonly value="{{$nhanvien->nv_email}}" />
    						</div>
    						<div class="form-group">
                                <label for="gioitinh" class="control-label"><b>Giới tính:</b></label>
                                <div>
                                    &nbsp;
                                    <label class="radio-content">
                                        <input type="radio" name="gioitinh" id="gioitinhnam" <?php if($nhanvien->nv_gioiTin == 1) echo "checked"; ?>  value="1"> <i class="fa fa-mars text-primary" aria-hidden="true"></i> Nam
                                    </label>&nbsp;&nbsp;&nbsp;&nbsp;
                                    <label class="radio-content">
                                        <input type="radio" name="gioitinh" id="gioitinhnu" <?php if($nhanvien->nv_gioiTin == 0) echo "checked"; ?> value="0"> <i class="fa fa-venus text-danger" aria-hidden="true"></i> Nữ
                                    </label>

                                </div>
                            </div>
    						<div class="form-group">
    							
                                <label for="ngaysinh" class=""><b>Ngày sinh:</b></label>
                                <input type="date" id="ngaysinh" name="ngaysinh" class="form-control " placeholder="Nhập ngày sinh" ng-required="true" value="{{ date_format($nhanvien->nv_ngaySinh, 'Y-m-d')}}">
                            </div>
    						<div class="form-group">
    							<label for="phone" class=""><b>Số điện thoại:</b></label>
    							<input type="text" id="phone" name="phone" class="form-control" placeholder="Nhập số điện thoại" value="{{$nhanvien->nv_dienThoai}}" />
    						</div>
    						<div class="form-group">
    							<label for="address" class=""><b>Địa chỉ:</b></label>
    							<input type="text" id="address" name="address" class="form-control" placeholder="Nhập địa chỉ" value="{{$nhanvien->nv_diaChi}}" />
    						</div>
    						<div class="form-group">
    							<label for="position" class=""><b>Chức vụ:</b></label>
    							<input type="text" id="position" name="position" class="form-control" placeholder="Nhập địa chỉ email" readonly value="{{$nhanvien->cv_ten}}" />
    						</div>

    						<div class="form-group">
    							<label for="newPass" class=""><b>Mật khẩu mới:</b></label>
    							<input type="password" id="newPass" name="newPass" class="form-control" placeholder="Nhập Mật khẩu mới" />
    						</div>
    						<div class="form-group">
    							<label for="rePass" class=""><b>Nhập lại mật khẩu:</b></label>
    							<input type="password" id="rePass" name="rePass" class="form-control" placeholder="Nhậplại mật khẩu" />
    						</div>
    						
    						<div class="col-sm-6">
    							<div class="form-group"> 
    								<button type="submit" class="btn btn-flat btn-danger btn-block" >Cập nhật</button>
    							</div>
    						</div>
    						<div class="col-sm-6">
    							<div class="form-group"> 
    								<button type="reset" class="btn btn-flat btn-default btn-block" >Nhập lại</button>
    							</div>
    						</div>
    						</div>
    					</form>
    				</div>
    			</div>
    		</div>
    		<div class="col-sm-2"></div>
    	</div>

    </section>
</div>
<script>
	 $("#frmCreatEdit").validate({ 
        rules: {
            name:       { required: true, },
            phone:      { required: true, number: true, maxlength: 10, minlength: 10 },
            ngaysinh:   { required: true, },
            address:    {  required: true },
            newPass:    { minlength: 6, maxlength: 32 },
            rePass:     { equalTo: "#newPass" },
        }, 
        messages: {
            name:       { required: "Xin vui lòng nhập họ tên.", },
            ngaysinh:   { required: "Xin vui lòng nhập ngày sinh.", },
            phone:      {
                required: "Xin vui lòng nhập số điện thoại.", 
                number: "Số điện thoại không đúng định dạng.",  
                maxlength: "Số điện thoại vượt quá 10 số.",
                minlength: "Số điện thoại phải đủ 10 sô."
             },
            address:    { required: "Xin vui lòng nhập địa chỉ.", },
            newPass:   { minlength: "Mật khẩu phải lớn hơn 6 ký tự", maxlength: "Mật khẩu phải nhỏ hơn 32 ký tự" },
            rePass:     { equalTo: "Mật khẩu không trung khớp." },
        },
        
    });
</script>
@endsection
