
app.controller('phieunhapController', function($scope, $http, $filter, MainURL, DTOptionsBuilder ,DTColumnBuilder){
	
	$scope.dsPhieunhap            =     [];
    $scope.dsNhacungcap           =     [];
    $scope.dsNhanvien             =     [];
    $scope.dsSanpham              =     [];
    $scope.dsSanpham_2            =     [];

    $scope.today = new Date();

	$scope.dataTitle              =    "phiếu nhập hàng";
	$scope.status                 =    "edit";
	$scope.frm_details_oldTr      =    null;
	$scope.newMember_Data         =    null;
    $scope.today = new Date();

    $scope.isLoading = true;

	$scope.refresh = function(){ // Lấy danh sách phiếu nhập hàng
		var requestURL = MainURL + "phieunhap/danhsach";
		$http.get(requestURL).then(function(response){
			$scope.dsPhieunhap = response.data.message.phieunhap;
		});

        var requestURL2 = MainURL + "nhacungcap/danhsach";
        $http.get(requestURL2).then(function(response){
            $scope.dsNhacungcap = response.data.message.nhacungcap;
        });

        var requestURL3 = MainURL + "nhanvien/danhsach";
        $http.get(requestURL3).then(function(response){
            $scope.dsNhanvien = response.data.message.nhanvien;
            $scope.isLoading = false;
        });

        var requestURL5 = MainURL + "sanpham/danhsach";
        $http.get(requestURL5).then(function(response){
            $scope.dsSanpham_2 = response.data.message.sanpham;
            $scope.isLoading = false;
        });
	}

	$scope.refresh();

	var language = {
		"sEmptyTable":     "Chưa có dữ liệu",
		"sInfo":           "Hiển thị từ _START_ đến _END_ trong tổng số _TOTAL_ dòng dữ liệu",
		"sInfoEmpty":      "Dữ liệu rỗng",
		"sInfoFiltered":   "Dữ liệu lọc được từ tổng số _MAX_ dòng dữ liệu",
		"sInfoPostFix":    "",
		"sInfoThousands":  ",",
		"sLengthMenu":     "Hiển thị _MENU_ ",
		"sLoadingRecords": "Đang nạp dữ liệu...",
		"sProcessing":     "Đang xử lý...",
		"sSearch":         "Tìm kiếm:",
		"sZeroRecords":    "Không tìm thấy dữ liệu",
		"oPaginate": {
			"sFirst":    "|<",
			"sLast":     ">|",
			"sNext":     ">",
			"sPrevious": "<"
		}
	};

	$scope.dtOptions = DTOptionsBuilder.newOptions()
	.withOption("lengthMenu",[[10,15,20,25,50,100,-1],[10,15,20,25,50,100,"Tất cả"]])
	.withLanguage(language);

	function ShowDetail(member){

        if(member.nv_xuLy != null) 
            var nhanvienthanhtoan = member.nv_xuLy;
        else
            var nhanvienthanhtoan = "Chưa có nhân viên";

        if(member.pn_ngayXacNhan != null)
            var ngayxacnhan = $filter('date')(new Date(member.pn_ngayXacNhan),'dd-MM-yyyy HH:mm:ss');
        else 
            var ngayxacnhan = "Chưa thanh toán";

		var result = '<tr><td colspan="8" style="padding:5px">'+

		'<table align="center" class="table table-bordered" style="margin:0px"><tbody>'+
		'<tr>'+
		'<td class="text-left bg-info" width="20%"><b>Mã loại:</b></td>'+
		'<td class="text-left">'+member.pn_ma+'</td>'+
		'</tr>'+
		'<tr>'+
		'<td class="text-left bg-info" width="20%"><b>Người lấp phiếu:</b></td>'+
		'<td class="text-left">'+ $scope.dsNhanvien.dbFind("nv_ma", member.nv_lapPhieu).nv_hoTen +'</td>'+
		'</tr>'+
        '<tr>'+
        '<td class="text-left bg-info" width="20%"><b>Ngày lập:</b></td>'+
        '<td class="text-left">'+$filter('date')(new Date(member.pn_taoMoi),'dd-MM-yyyy HH:mm:ss')+'</td>'+
        '</tr>'+
        '<tr>'+
        '<td class="text-left bg-info" width="20%"><b>Người thanh toán:</b></td>'+
        '<td class="text-left">'+ nhanvienthanhtoan +'</td>'+
        '</tr>'+
        '<tr>'+
        '<td class="text-left bg-info" width="20%"><b>Ngày thanh toán:</b></td>'+
        '<td class="text-left">'+ngayxacnhan+'</td>'+
        '</tr>'+
        '<tr>'+
        '<td class="text-left bg-info" width="20%"><b>Ghi chú:</b></td>'+
        '<td class="text-left">'+ member.pn_ghiChu +'</td>'+
        '</tr>';

		result += '</tbody></table></td></tr>';

		return result;
	}

    function ShowDetailProduct(member){

        var result = '<tr><td colspan="8" style="padding:5px">'+

        '<table align="center" class="table table-bordered" style="margin:0px"><tbody>'+
        '<tr>'+
        '<td class="text-left bg-info" width="20%"><b>Mã loại:</b></td>'+
        '<td class="text-left">'+member.pn_ma+'</td>'+
        '</tr>'+
        '<tr>'+
        '<td class="text-left bg-info" width="20%"><b>Mã loại:</b></td>'+
        '<td class="text-left">'+member.sp_ma+'</td>'+
        '</tr>'+
        '<tr>'+
        '<td class="text-left bg-info" width="20%"><b>Ngày sản xuất:</b></td>'+
        '<td class="text-left">'+$filter('date')(new Date(member.sp_ngaySX),'dd-MM-yyyy')+'</td>'+
        '</tr>'+
        '<tr>'+
        '<td class="text-left bg-info" width="20%"><b>Hạn sử dụng:</b></td>'+
        '<td class="text-left">'+$filter('date')(new Date(member.sp_hanSD),'dd-MM-yyyy')+'</td>'+
        '</tr>'+
        '<tr>'+
        '<td class="text-left bg-info" width="20%"><b>Giá nhập:</b></td>'+
        '<td class="text-left" style="color: red;">'+$filter('number')(member.ctn_donGia, '0') +'đ</td>'+
        '</tr>'+
        '<tr>'+
        '<td class="text-left bg-info" width="20%"><b>Số lượng nhập:</b></td>'+
        '<td class="text-left">'+ member.ctn_soLuong +'</td>'+
        '</tr>'+
        '<tr>'+
        '<td class="text-left bg-info" width="20%"><b>Tồn kho:</b></td>'+
        '<td class="text-left">'+ member.sp_tonKho +'</td>'+
        '</tr>';
        result += '</tbody></table></td></tr>';

        return result;
    }


	function indexOfMember(id){ // lấy vị trí theo id
		for(i=0; i < $scope.dsPhieunhap.length; i++){
			if (id == $scope.dsPhieunhap[i].pn_ma)
				return i;
		}
		return -1;
	}

    function indexOfProduct(id){ // lấy vị trí theo id
        for(i=0; i < $scope.dsSanpham.length; i++){
            if (id == $scope.dsSanpham[i].ctn_ma)
                return i;
        }
        return -1;
    }

	$scope.checkInput = function(){
		if($("#chkSelectItems").prop("checked"))
			$("input:checkbox").prop("checked", true);
		else
			$("input:checkbox").prop("checked", false);
	}

	function isMemberDiff(db, frm){
        var d1 = Date.parse(frm.ngayxuathoadon);
        var d2 = Date.parse(db.pn_ngayXuatHoaDon);

        if(frm.ngaythanhtoan != null)
            var d3 = Date.parse(frm.ngaythanhtoan);
        else
            var d3 = null;

        if(db.pn_ngayXacNhan)
            var d4 = Date.parse(db.pn_ngayXacNhan);
        else
            var d4 = null;

        return db.pn_soHoaDon != frm.sohoadon 
        || db.ncc_ma != frm.maNCC
        || db.nv_lapPhieu != frm.maNV
        || db.nv_xuLy != frm.maNVTT
        || db.pn_ghiChu != frm.ghichu
        || db.pn_trangThai != frm.trangThai
        || d3 != d4
        || d1 != d2;
    }

    $scope.loadProductByIdPN = function(id){
        var requestURL4 = MainURL + "phieunhap/sanphamByIdpn/" + id;
        $http.get(requestURL4).then(function(response){
            $scope.dsSanpham = response.data.message.sanpham;
            $scope.isLoading = false;
        });
    }

    $scope.CreateEdit_show = function (status, id){ // hiển thị chi tiết và modal thêm sửa xóa

    	switch(status){

    		case "detail": // Hiển thị chi tiết

        		i = indexOfMember(id);
        		if(i != -1){

        			item = $scope.dsPhieunhap[i];
        			tr = $("#tr_"+id);
        			icon = $(tr).find(".btn-detail i"); 

        			if($(icon).prop("class") == "fa fa-eye"){

        				$(icon).prop("class", "fa fa-eye-slash");
        				$(tr).next('tr').remove();
        				$scope.frm_details_oldTr = null;

        			}else{

        				if($scope.frm_details_oldTr != null){

        					oldtr = $($scope.frm_details_oldTr);
        					oldIcon = $(oldtr).find(".btn-detail i");
        					oldIcon.prop("class", "fa fa-eye-slash");
        					$(oldtr).next("tr").remove();

        				}

        				$(icon).prop("class", "fa fa-eye");
        				$(tr).after(ShowDetail(item));
        				$scope.frm_details_oldTr = $(tr);

        			}
        		}
    		else
    			toastr.warning("Mã loại không tồn tại!");

    		break;

    		case "create":

        		$scope.dialogTiTle = "Thêm " + $scope.dataTitle + " mới";
        		$scope.dialogButton = "Thêm";
        		$scope.status = status;
        		$scope.phieunhap = {
                    sohoadon: null, 
                    maNCC : $scope.dsNhacungcap[0].ncc_ma,
                    maNV : $scope.dsNhanvien[0].nv_ma,
                    ngayxuathoadon : $scope.today,
                    ngaythanhtoan : null,
                    maNVTT: null,
                    ghichu: null,
                    trangThai: 1,
                };
        		
        		$("#myModal").modal("show");

    		break;

    		case "edit":



                 member = $scope.dsPhieunhap[indexOfMember(id)];
                 $scope.dialogTiTle = "Sửa " + $scope.dataTitle;
                 $scope.dialogButton = "Sửa";
                 $scope.status = status;
                 $scope.id_member = member.pn_ma;

                 if(member.pn_ngayXacNhan!= null)
                    var ngaythanhtoan_2 = new Date(member.pn_ngayXacNhan);
                else
                    var ngaythanhtoan_2 = member.pn_ngayXacNhan;

                 $scope.phieunhap = {
                    sohoadon:  member.pn_soHoaDon, 
                    maNCC :  member.ncc_ma,
                    maNV :  member.nv_lapPhieu,
                    ngayxuathoadon :  new Date(member.pn_ngayXuatHoaDon),
                    ngaythanhtoan :  ngaythanhtoan_2,
                    maNVTT:  member.nv_xuLy,
                    ghichu:  member.pn_ghiChu,
                    trangThai:  member.pn_trangThai,
                };

                 $("#myModal").modal("show");

    		break;

    		case "delete":

    			member = $scope.dsPhieunhap[indexOfMember(id)];
    			$scope.dialogTiTle = "Xóa " + $scope.dataTitle;
        		$scope.dialogButton = "Xóa";
        		$scope.status = status;
        		$scope.id_member = id;
        		$("#message").html("Bạn có muốn xóa \"<b class='text-danger'>"+member.pn_soHoaDon+"</b>\" ?");
        		$("#myModal2").modal("show");

    		break;

    		case "deleteAll":

    			$scope.dialogTiTle = "Xóa " + $scope.dataTitle;
        		$scope.dialogButton = "Xóa";
        		$scope.status = status;
        		$("#message").html("Bạn có muốn xóa các dòng dữ liệu đã chọn?");
        		$("#myModal2").modal("show");

    		break;

            case "addProduct":

                $scope.id_member = id;

                $scope.loadProductByIdPN($scope.id_member);

                $scope.dialogTiTle = "Nhập sản phẩm";
                $scope.dialogButton = "Lưu";

                $("#table-addproduct").removeClass("hidden");
                $("#form-addproduct").addClass("hidden");

                $('#myModal3').modal("show");

            break;

    	}
    }

    $scope.ShowCreateEdit_Item = function (status, id) {
        switch(status){
            case "detail": // Hiển thị chi tiết

                    item = $scope.dsSanpham[id];
                    tr = $("#trpn_"+id);
                    icon = $(tr).find(".btn-detail-2 i"); 

                    if($(icon).prop("class") == "fa fa-eye"){

                        $(icon).prop("class", "fa fa-eye-slash");
                        $(tr).next('tr').remove();
                        $scope.frm_details_oldTr = null;

                    }else{

                        if($scope.frm_details_oldTr != null){

                            oldtr = $($scope.frm_details_oldTr);
                            oldIcon = $(oldtr).find(".btn-detail i");
                            oldIcon.prop("class", "fa fa-eye-slash");
                            $(oldtr).next("tr").remove();

                        }

                        $(icon).prop("class", "fa fa-eye");
                        $(tr).after(ShowDetailProduct(item));
                        $scope.frm_details_oldTr = $(tr);

                    }
                

            break;

            case "list":

                $("#table-addproduct").removeClass("hidden");
                $("#form-addproduct").addClass("hidden");

            break;

            case "create":

                $scope.status = status;
                $scope.id_pn = id;
                $scope.sanpham = {
                    maSP: $scope.dsSanpham_2[0].sp_ma,
                    soluong: 10,
                    gianhap: 1000000,
                    ngaysanxuat:  $scope.today,
                    hansudung:  $scope.today
                }
                $("#table-addproduct").addClass("hidden");
                $("#form-addproduct").removeClass("hidden");

            break;

            case "delete":
                if(confirm("Bạn có thật sự muốn xóa dữ liệu???")){
                    var requestURL = MainURL + "phieunhap/deleteProduct/" + id;
                    $http.delete(requestURL).then(function(response){
                        if(response.data.message){
                            $scope.loadProductByIdPN($scope.id_member);
                        }else{
                            alert("Xóa không thành công!");
                        }
                    }).catch(function(reason){alert("Có lỗi xảy ra!");});
                }else{
                    return;
                }
            break;

            case "edit":
                member = $scope.dsSanpham[indexOfProduct(id)];
                $scope.status = status;
                $scope.id_member = id;
                $scope.id_pn = member.pn_ma;
                $scope.sanpham = {
                    maSP: member.sp_ma,
                    soluong: member.ctn_soLuong,
                    gianhap: member.ctn_donGia,
                    ngaysanxuat:  new Date(member.sp_ngaySX),
                    hansudung:  new Date(member.sp_hanSD),
                    tonkho: member.sp_tonKho
                }
                $("#table-addproduct").addClass("hidden");
                $("#form-addproduct").removeClass("hidden");

            break;
        }
    }

   

    $("#frmCreatEdit").validate({ // thêm sửa bằng jquery validate
        rules: {
            sohoadon: {   
                required: true,
            }
        }, 
        messages: {
            sohoadon: {
                required: "Xin vui lòng nhập tên loại!",
            }
        },
        submitHandler: function(form) {
            switch($scope.status){

                case "create": //thêm
                    if($scope.phieunhap.ngaythanhtoan != null)
                        $scope.phieunhap.ngaythanhtoan = $filter('date')(new Date($scope.phieunhap.ngaythanhtoan),'yyyy-MM-dd');

                    $scope.phieunhap.ngayxuathoadon = $filter('date')(new Date($scope.phieunhap.ngayxuathoadon),'yyyy-MM-dd');
                    var requestURL = MainURL + "phieunhap/store";
                    var requestData = $.param($scope.phieunhap);

                    $http.post(requestURL, requestData, {headers: {'Content-Type':'application/x-www-form-urlencoded'}})
                    .then(function(response){

                        if(response.data.error == true){
                            if(response.data.message.sohoadon != undefined)
                                $('#dlgExistName').text(response.data.message.sohoadon[0]).show().fadeOut( 4000 );
                        }else{
                            if(response.data.message.phieunhap != null){
                                list = [];
                                list.push(response.data.message.phieunhap); 

                                for(i=0; i < $scope.dsPhieunhap.length; i++){
                                    list.push($scope.dsPhieunhap[i]);
                                }

                                $scope.dsPhieunhap = list;
                                $scope.status = 'edit';

                                    // Hiển thị bg dữ liệu
                                    $scope.newMember_Data = response.data.message.phieunhap.pn_ma;
                                    setTimeout(function(){ $('#tr_'+$scope.newMember_Data).removeClass('bg-default'); }, 3000);

                                    $('#myModal').modal('hide');     
                                    toastr.success("Thêm phiếu nhập hàng thành công!");
                                    
                            }
                        }

                    }).catch(function(reason){
                        if(reason.status == 500){
                            console.log(reason);
                            $('#myModal').modal('hide');
                            toastr.error("Có lỗi xảy ra, vui lòng kiểm tra lại!");
                        }
                    });

                break;

                case "edit": //sửa

                    i = indexOfMember($scope.id_member);
                    if(i == -1){
                        $('#myModal').modal('hide');
                        toastr.warning("Mã phiếu nhập hàng không tồn tại!");
                    }else{
                        member = $scope.dsPhieunhap[i];
                        var diff = isMemberDiff(member, $scope.phieunhap);
                        if(diff){

                            if($scope.phieunhap.ngaythanhtoan != null)
                                $scope.phieunhap.ngaythanhtoan = $filter('date')(new Date($scope.phieunhap.ngaythanhtoan),'yyyy-MM-dd');
                            
                            $scope.phieunhap.ngayxuathoadon = $filter('date')(new Date($scope.phieunhap.ngayxuathoadon),'yyyy-MM-dd');
                            var requestURL = MainURL + "phieunhap/update/" + $scope.id_member;
                            var requestData = $.param($scope.phieunhap);

                            $http.post(requestURL, requestData, {headers: {'Content-Type':'application/x-www-form-urlencoded'}})
                            .then(function(response){
                                if(response.data.error == true){
                                    if(response.data.message.ten != undefined)
                                        $('#dlgExistName').text(response.data.message.ten[0]).show().fadeOut( 4000 );
                                }else{
                                    if(response.data.message.phieunhap != null){
                                        data = response.data.message.phieunhap;
                                        $scope.dsPhieunhap[i] = data;

                                        $scope.newMember_Data = response.data.message.phieunhap.pn_ma;
                                        setTimeout(function(){ $('#tr_'+$scope.newMember_Data).removeClass('bg-default'); }, 3000);

                                        $('#myModal').modal('hide');
                                        toastr.success("Sửa phiếu nhập hàng thành công!");
                                        
                                    }
                                }
                            }).catch(function(reason){
                                if(reason.status == 500){
                                    $('#myModal').modal('hide');
                                    toastr.error("Có lỗi xảy ra, vui lòng kiểm tra lại!");
                                }
                            });
                        }

                    }

                break;
            }
        }
    });

    $("#delte").on("submit", function(event){ // xóa dữ liệu
        switch($scope.status){

            case "delete" : //xóa

                i = indexOfMember($scope.id_member);
                if(i == -1){
                    $('#myModal2').modal('hide');
                    toastr.warning("Mã loại không tồn tại!");
                }else{

                    var requestURL = MainURL + "phieunhap/delete/" + $scope.id_member;

                    $http.delete(requestURL)
                    .then(function(response){

                        if(response.data.message){
                            $scope.dsPhieunhap.splice(i, 1);
                            $('#myModal2').modal('hide');
                            toastr.success("Xóa phiếu nhập hàng thành công!");
                        }else{
                            $('#myModal2').modal('hide');
                            toastr.error("Xóa phiếu nhập hàng không thành công!");
                        }

                    }).catch(function(reason){
                        if(reason.status == 500){
                            $('#myModal2').modal('hide');
                            toastr.error("Có lỗi xảy ra, vui lòng kiểm tra lại!");
                        }
                    });

                }
            break;

            case "deleteAll":

                dsCheckbox = [];
                for(i=1; i<= $scope.dsPhieunhap.length; i++){
                    if($('#chk'+i).prop("checked"))
                        dsCheckbox.push($('#chk'+i).val());
                }

                if(dsCheckbox.length > 0){

                    var requestURL = MainURL + 'phieunhap/deleteAll';
                    var requestData = $.param({items: dsCheckbox});

                    $http.post(requestURL, requestData, {headers: {'Content-Type':'application/x-www-form-urlencoded'}})
                    .then(function(response){

                        if(response.data.message){
                            for(i in dsCheckbox){
                                memberKey = dsCheckbox[i];
                                dbMember = indexOfMember(memberKey);
                                if(dbMember != -1){
                                    $scope.dsPhieunhap.splice(dbMember, 1);
                                } 
                            }
                            $('#myModal2').modal('hide');
                            toastr.success("Xóa các phiếu nhập hàng thành công!");
                        }else{
                            $('#myModal2').modal('hide');
                            toastr.error("Xóa các phiếu nhập hàng thành công!");
                        }

                    }).catch(function(reason){
                        if(reason.status == 500){
                            $('#myModal2').modal('hide');
                            toastr.error("Có lỗi xảy ra, vui lòng kiểm tra lại!");
                        }
                    });

                }else{
                    $('#myModal2').modal('hide');
                    toastr.warning("Vui lòng chọn dữ liệu trước khi xóa!");
                }

            break;
        } 
    });

    $("#frmaddproduct").on("submit", function(event){ // xóa dữ liệu
        switch($scope.status){

            case "create":


                $scope.sanpham.ngaysanxuat = $filter('date')(new Date($scope.sanpham.ngaysanxuat),'yyyy-MM-dd');
                $scope.sanpham.hansudung = $filter('date')(new Date($scope.sanpham.hansudung),'yyyy-MM-dd');

                var requestURL = MainURL + "phieunhap/storeProduct/" + $scope.id_pn;
                var requestData = $.param($scope.sanpham);
                $http.post(requestURL, requestData, {headers: {'Content-Type':'application/x-www-form-urlencoded'}})
                .then(function (response) {
                    if(response.data.message)
                    {   
                        $scope.loadProductByIdPN($scope.id_member);
                        $("#table-addproduct").removeClass("hidden");
                        $("#form-addproduct").addClass("hidden");
                    }else{
                        alert('Thêm sản phẩm vào phiếu nhập không thành công!');
                    }
                    
                }).catch(function(reason) {
                     alert('Có lỗi xảy ra vui lòng kiểm tra lại!')
                });
                
            break;

            case "edit":
                i = indexOfProduct($scope.id_member);
                if(i != -1){

                    $scope.sanpham.ngaysanxuat = $filter('date')(new Date($scope.sanpham.ngaysanxuat),'yyyy-MM-dd');
                    $scope.sanpham.hansudung = $filter('date')(new Date($scope.sanpham.hansudung),'yyyy-MM-dd');

                    var requestURL = MainURL + "phieunhap/updateProduct/" + $scope.id_member;
                    var requestData = $.param($scope.sanpham);
                    $http.post(requestURL, requestData, {headers: {'Content-Type':'application/x-www-form-urlencoded'}})
                    .then(function (response) {
                        if(response.data.message)
                        {   
                            $scope.loadProductByIdPN($scope.id_pn);
                            $("#table-addproduct").removeClass("hidden");
                            $("#form-addproduct").addClass("hidden");
                        }else{
                            alert('Thêm sản phẩm vào phiếu nhập không thành công!');
                        }
                        
                    }).catch(function(reason) {
                         alert('Có lỗi xảy ra vui lòng kiểm tra lại!');
                         console.log(reason);
                    });
                }
            break;
        } 
    });
});