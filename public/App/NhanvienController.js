app.controller('nhanvienController', function($scope, $http, MainURL, DTOptionsBuilder ,DTColumnBuilder, $filter){
	
	$scope.dsNhanvien = [];
	$scope.dsChucvu = [];
	$scope.dataTitle = "nhân viên";
	$scope.status = "edit";
	$scope.frm_details_oldTr = null;
	$scope.newMember_Data = null;
	$scope.isLoading = true;
	$scope.today = new Date();
	
	// Lấy danh sách nhân viên & chuc vụ
	$scope.refresh = function()
	{ 
		var requestURL = MainURL + "nhanvien/danhsach";
		$http.get(requestURL).then(function(response){
			$scope.dsNhanvien = response.data.message.nhanvien;
		});

		var requestURL2 = MainURL + "chucvu/danhsach";
		$http.get(requestURL2).then(function(response){
			$scope.dsChucvu = response.data.message.chucvu;
            $scope.isLoading = false;
		});
	}

	$scope.refresh();

	// Datatable
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
	// End Datatable

	// show staff info detail
	function ShowDetail(member){
		var result = '<tr><td colspan="8" style="padding:5px">'+

		'<table align="center" class="table table-bordered" style="margin:0px"><tbody>'+
		'<tr>'+
		'<td class="text-left bg-info" width="20%"><b>Mã nhân viên:</b></td>'+
		'<td class="text-left">'+member.nv_ma+'</td>'+
		'</tr>'+
		'<tr>'+
		'<td class="text-left bg-info" width="20%"><b>Email:</b></td>'+
		'<td class="text-left">'+member.nv_email+'</td>'+
		'</tr>'+
		'<tr>'+
		'<td class="text-left bg-info" width="20%"><b>Ngày sinh:</b></td>'+
		'<td class="text-left">'+ $filter('date')(new Date(member.nv_ngaySinh),'dd-MM-yyyy') +'</td>'+
		'</tr>'+
		'<tr>'+
		'<td class="text-left bg-info" width="20%"><b>Điện thoại:</b></td>'+
		'<td class="text-left">'+member.nv_dienThoai+'</td>'+
		'</tr>'+
		'<tr>'+
		'<td class="text-left bg-info" width="20%"><b>Địa chỉ:</b></td>'+
		'<td class="text-left">'+member.nv_diaChi+'</td>'+
		'</tr>'+
		'<tr>'+
		'<td class="text-left bg-info" width="20%"><b>Ngày tạo:</b></td>'+
		'<td class="text-left">'+$filter('date')(new Date(member.nv_taoMoi),'dd-MM-yyyy HH:mm:ss')+'</td>'+
		'</tr>'+
		'<tr>'+
		'<td class="text-left bg-info" width="20%"><b>Ngày cập nhật:</b></td>'+
		'<td class="text-left">'+$filter('date')(new Date(member.nv_capNhat),'dd-MM-yyyy HH:mm:ss')+'</td>'+
		'</tr>';
		result += '</tbody></table></td></tr>';

		return result;
	}

	// get location of staff list by id 
	function indexOfMember(id){ 
		for(i=0; i < $scope.dsNhanvien.length; i++){
			if (id == $scope.dsNhanvien[i].nv_ma)
				return i;
		}
		return -1;
	}

	function isMemberDiff(db, frm){
		var d1 = Date.parse(frm.ngaysinh);
		var d2 = Date.parse(db.nv_ngaySinh);
    	return db.nv_hoTen != frm.ten 
    	|| db.cv_ma != frm.chucvu
    	|| db.nv_gioiTinh != frm.gioitinh
    	|| db.nv_email != frm.email
    	|| db.nv_dienThoai != frm.dienthoai
    	|| db.nv_diaChi != frm.diachi
    	|| db.nv_trangThai != frm.trangThai
    	|| d1 != d2;
    }

    $scope.checkInput = function(){
		if($("#chkSelectItems").prop("checked"))
			$("input:checkbox").prop("checked", true);
		else
			$("input:checkbox").prop("checked", false);
	}

	// create_edit_detail show function
	$scope.CreateEdit_show = function(status, id){
		switch(status)
		{
			case "detail":

				i = indexOfMember(id);
				if(id != -1)
				{
					item = $scope.dsNhanvien[i];
					tr = $("#tr_"+id);
					icon = $(tr).find(".btn-detail i");

					if($(icon).prop("class") == "fa fa-eye")
					{
						$(icon).prop("class", "fa fa-eye-slash");
						$(tr).next("tr").remove();
						$scope.frm_details_oldTr = null;
					} 
					else
					{
						if($scope.frm_details_oldTr != null)
						{
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
			break;

			case "create":
				$scope.dialogTiTle = "Thêm nhân viên mới";
				$scope.dialogButton = "Thêm";
				$scope.status = status;
				$scope.nhanvien = {
					ten: null,
					email: null,
					gioitinh: 1,
					diachi: null,
					dienthoai: null,
					chucvu: $scope.dsChucvu[0].cv_ma,
					trangThai: 1,
					ngaysinh: $scope.today
				};
				$("#myModal").modal("show");
			break;

			case "edit":

				$scope.dialogButton = "Sửa";
				$scope.dialogTiTle = "Sửa " + $scope.dataTitle;
				$scope.status = status;
				$scope.id_member = id;
				member = $scope.dsNhanvien[indexOfMember(id)];
				$scope.nhanvien = {
					ten: member.nv_hoTen, 
					trangThai: member.nv_trangThai, 
					gioitinh: member.nv_gioiTinh,
					email: member.nv_email,
					diachi: member.nv_diaChi,
					dienthoai: member.nv_dienThoai,
					chucvu: member.cv_ma,
					ngaysinh: new Date(member.nv_ngaySinh),
				};
				$("#myModal").modal("show");

			break;

			case "resetPass":
				member = $scope.dsNhanvien[indexOfMember(id)];
    			$scope.dialogTiTle = "Cấp lại mật khẩu " + $scope.dataTitle;
        		$scope.dialogButton = "Cấp lại mật khẩu";
        		$scope.status = status;
        		$scope.id_member = id;
        		$("#message").html("Bạn có muốn cấp lại mật khẩu cho \"<b class='text-danger'>"+member.nv_hoTen+"</b>\" ?");
        		$("#myModal2").modal("show");

			break;

			case "delete":

    			member = $scope.dsNhanvien[indexOfMember(id)];
    			$scope.dialogTiTle = "Xóa " + $scope.dataTitle;
        		$scope.dialogButton = "Xóa";
        		$scope.status = status;
        		$scope.id_member = id;
        		$("#message").html("Bạn có muốn xóa \"<b class='text-danger'>"+member.nv_hoTen+"</b>\" ?");
        		$("#myModal2").modal("show");

    		break;

    		case "deleteAll":

    			$scope.dialogTiTle = "Xóa " + $scope.dataTitle;
        		$scope.dialogButton = "Xóa";
        		$scope.status = status;
        		$("#message").html("Bạn có muốn xóa các dòng dữ liệu đã chọn?");
        		$("#myModal2").modal("show");

    		break;
		}
	}

	$("#frmCreatEdit").validate({ // thêm sửa bằng jquery validate
    	rules: {
    		ten: {   
    			required: true,
    		},
    		email: {   
    			required: true,
    			email: true,
    		},
    		dienthoai: {   
    			required: true,
    			number: true,
    			digits: true,
    		},
    		diachi: {   
    			required: true,
    		},

    	}, 
    	messages: {
    		ten: {
    			required: "Xin vui lòng nhập tên nhân viên!",
    		},
    		email: {
    			required: "Xin vui lòng nhập tên nhân viên!",
    			email: "Email không đúng định dạng"
    		},
    		dienthoai: {
    			required: "Xin vui lòng số điện thoại!",
    			number: "Số điện thoại phải nhập là số!",
    			digits : "Số điện thoại không được số âm!",
    		},
    		diachi: {
    			required: "Xin vui lòng nhập địa chỉ!",
    		},
    	},
    	submitHandler: function(form) {
    		switch($scope.status){

	    		case "create": //thêm

	    			$scope.nhanvien.ngaysinh = $filter('date')(new Date($scope.nhanvien.ngaysinh),'yyyy-MM-dd')
		    		var requestURL = MainURL + "nhanvien/store";
		    		var requestData = $.param($scope.nhanvien);

		    		$http.post(requestURL, requestData, {headers: {'Content-Type':'application/x-www-form-urlencoded'}})
		    		.then(function(response){
		    			
		    			if(response.data.error == true){
		    				if(response.data.message.ten != undefined)
		    					$('#dlgExistName').text(response.data.message.ten[0]).show().fadeOut( 4000 );
		    				if(response.data.message.email != undefined)
		    					$('#dlgExistEmail').text(response.data.message.email[0]).show().fadeOut( 4000 );
		    				if(response.data.message.dienthoai != undefined)
		    					$('#dlgExistPhone').text(response.data.message.dienthoai[0]).show().fadeOut( 4000 );
		    			}else{
		    				if(response.data.message.nhanvien != null){
		    					list = [];
		    					
		    					list.push(response.data.message.nhanvien); 
		    					for(i=0; i < $scope.dsNhanvien.length; i++){
		    						list.push($scope.dsNhanvien[i]);
		    					}

		    					$scope.dsNhanvien = list;
		    					$scope.status = 'edit';

		    					$scope.newMember_Data = response.data.message.nhanvien.nv_ma;
		    					setTimeout(function(){ 
		    						$('#tr_'+$scope.newMember_Data).removeClass('bg-default');
		    						$scope.newMember_Data = ""; 

		    					}, 3000);

		    					$('#myModal').modal('hide');
		    					toastr.success("Thêm nhân viên thành công!");
		    					
		    				}else{
		    					$('#myModal').modal('hide');
		    					toastr.error("Thêm nhân viên không thành công!, vui lòng kiểm tra lại");
		    				}
		    			}
		    		}).catch(function(reason){
		    			if(reason.status == 500){
		    				$('#myModal').modal('hide');
		    				toastr.error("Có lỗi xảy ra, vui lòng kiểm tra lại!");
		    			}
		    		});

	    		break;

	    		case "edit": //sửa

	    			i = indexOfMember($scope.id_member);
	    			if(i == -1){
	    				$('#myModal').modal('hide');
	        			toastr.warning("Mã nhân viên không tồn tại, vui lòng kiểm tra lại!");
	    			}else{
	    				member = $scope.dsNhanvien[i];
	    				var diff = isMemberDiff(member, $scope.nhanvien);
	    				if(diff){

	    					$scope.nhanvien.ngaysinh = $filter('date')(new Date($scope.nhanvien.ngaysinh),'yyyy-MM-dd')
	    					var requestURL = MainURL + "nhanvien/update/" + $scope.id_member;
	    					var requestData = $.param($scope.nhanvien);

	    					$http.post(requestURL, requestData, {headers: {'Content-Type':'application/x-www-form-urlencoded'}})
	    					.then(function(response){

	    						if(response.data.error == true){
	    							if(response.data.message.ten != undefined)
	    								$('#dlgExistName').text(response.data.message.ten[0]).show().fadeOut( 4000 );
	    							if(response.data.message.email != undefined)
	    								$('#dlgExistEmail').text(response.data.message.email[0]).show().fadeOut( 4000 );
	    							if(response.data.message.dienthoai != undefined)
	    								$('#dlgExistPhone').text(response.data.message.dienthoai[0]).show().fadeOut( 4000 );
	    						}else{
	    							if(response.data.message.nhanvien != null){
	    								data = response.data.message.nhanvien;
	    								$scope.dsNhanvien[i] = data;

	    								$scope.newMember_Data = response.data.message.nhanvien.nv_ma;
	    								setTimeout(function(){ 
	    									$('#tr_'+$scope.newMember_Data).removeClass('bg-default');
	    									$scope.newMember_Data = ""; 

	    								}, 3000);

	    								$('#myModal').modal('hide');
	    								toastr.success("Sửa nhân viên thành công!");
	    								
	    							}else{
	    								$('#myModal').modal('hide');
	    								toastr.error("Sửa nhân viên không thành công!, vui lòng kiểm tra lại");
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
                    toastr.warning("Mã nhân viên không tồn tại!");
                }else{

                    var requestURL = MainURL + "nhanvien/delete/" + $scope.id_member;

                    $http.delete(requestURL)
                    .then(function(response){

                        if(response.data.message){
                            $scope.dsNhanvien.splice(i, 1);
                            $('#myModal2').modal('hide');
                            toastr.success("Xóa nhân viên thành công!");
                        }else{
                            $('#myModal2').modal('hide');
                            toastr.error("Xóa nhân viên không thành công!");
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
                for(i=1; i<= $scope.dsNhanvien.length; i++){
                    if($('#chk'+i).prop("checked"))
                        dsCheckbox.push($('#chk'+i).val());
                }

                if(dsCheckbox.length > 0){

                    var requestURL = MainURL + 'nhanvien/deleteAll';
                    var requestData = $.param({items: dsCheckbox});

                    $http.post(requestURL, requestData, {headers: {'Content-Type':'application/x-www-form-urlencoded'}})
                    .then(function(response){

                        if(response.data.message){
                            for(i in dsCheckbox){
                                memberKey = dsCheckbox[i];
                                dbMember = indexOfMember(memberKey);
                                if(dbMember != -1){
                                    $scope.dsNhanvien.splice(dbMember, 1);
                                } 
                            }
                            $('#myModal2').modal('hide');
                            toastr.success("Xóa các nhân viên thành công!");
                        }else{
                            $('#myModal2').modal('hide');
                            toastr.error("Xóa các nhân viên thành công!");
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

            case "resetPass" : //xóa

            	$scope.LoadingFrm = true;

                i = indexOfMember($scope.id_member);
                if(i == -1){
                	$('#myModal').modal('hide');
                	toastr.warning("Mã nhân viên không tồn tại, vui lòng kiểm tra lại!");
                }else{
                	member = $scope.dsNhanvien[i];

                	var requestURL = MainURL + "nhanvien/updatePassword/" + $scope.id_member;
                	var requestData = $.param({});

                	$http.post(requestURL, requestData, {headers: {'Content-Type':'application/x-www-form-urlencoded'}})
                	.then(function(response){


                		if(response.data.message.nhanvien != null){
                			data = response.data.message.nhanvien;
                			$scope.dsNhanvien[i] = data;

                			$scope.newMember_Data = response.data.message.nhanvien.nv_ma;
                			setTimeout(function(){ 
                                $('#tr_'+$scope.newMember_Data).removeClass('bg-default');
                                $scope.newMember_Data = ""; 

                            }, 3000);

                			$('#myModal2').modal('hide');
                			toastr.success("Cấp lại mật khẩu nhân viên thành công!");
                			$scope.LoadingFrm = false;

                		}else{
                			$('#myModal2').modal('hide');
                			toastr.error("Cấp lại mật khẩu nhân viên không thành công!, vui lòng kiểm tra lại");
                			$scope.LoadingFrm = false;
                		}


                	}).catch(function(reason){
                		if(reason.status == 500){
                			$('#myModal2').modal('hide');
                			toastr.error("Có lỗi xảy ra, vui lòng kiểm tra lại!");
                			$scope.LoadingFrm = false;
                		}
                	});
                	

                }
            break;
        } 
    });
	
});