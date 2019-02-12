app.controller('khachhangController', function($scope, $http, MainURL, DTOptionsBuilder ,DTColumnBuilder, $filter){
	
	$scope.dsKhachhang = [];

	$scope.dataTitle = "khách hàng";
	$scope.status = "edit";
	$scope.frm_details_oldTr = null;
	$scope.newMember_Data = null;
	$scope.isLoading = true;
	$scope.LoadingFrm = false;

	$scope.refresh = function(){
		var requestURL = MainURL + "khachhang/danhsach";
		$http.get(requestURL).then(function(response){
			$scope.dsKhachhang = response.data.message.khachhang;
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
		'<td class="text-left bg-info" width="20%"><b>Mã khách hàng:</b></td>'+
		'<td class="text-left">'+member.kh_ma+'</td>'+
		'</tr>'+
		'<tr>'+
		'<td class="text-left bg-info" width="20%"><b>Địa chỉ:</b></td>'+
		'<td class="text-left">'+member.kh_diaChi+'</td>'+
		'</tr>'+
		'<tr>'+
		'<td class="text-left bg-info" width="20%"><b>Địện thoại:</b></td>'+
		'<td class="text-left">'+member.kh_dienThoai+'</td>'+
		'</tr>'+
		'<tr>'+
		'<td class="text-left bg-info" width="20%"><b>Ngày tạo:</b></td>'+
		'<td class="text-left">'+$filter('date')(new Date(member.kh_taoMoi),'dd-MM-yyyy HH:mm:ss')+'</td>'+
		'</tr>'+
		'<tr>'+
		'<td class="text-left bg-info" width="20%"><b>Ngày cập nhật:</b></td>'+
		'<td class="text-left">'+$filter('date')(new Date(member.kh_capNhat),'dd-MM-yyyy HH:mm:ss')+'</td>'+
		'</tr>';
		result += '</tbody></table></td></tr>';

		return result;
	}

	// get location of staff list by id 
	function indexOfMember(id){ 
		for(i=0; i < $scope.dsKhachhang.length; i++){
			if (id == $scope.dsKhachhang[i].kh_ma)
				return i;
		}
		return -1;
	}

	function isMemberDiff(db, frm){
    	return db.kh_hoTen != frm.ten 
    	|| db.cv_ma != frm.chucvu
    	|| db.kh_gioiTinh != frm.gioitinh
    	|| db.kh_email != frm.email
    	|| db.kh_dienThoai != frm.dienthoai
    	|| db.kh_diaChi != frm.diachi
    	|| db.kh_trangThai != frm.trangThai;
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
					item = $scope.dsKhachhang[i];
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
				$scope.dialogTiTle = "Thêm khách hàng mới";
				$scope.dialogButton = "Thêm";
				$scope.status = status;
				$scope.khachhang = {
					ten: null, 
					trangThai: 1, 
					gioitinh: 1,
					email: null,
					diachi: null,
					dienthoai: null,
				};
				$("#myModal").modal("show");
			break;

			case "edit":

				$scope.dialogButton = "Sửa";
				$scope.dialogTiTle = "Sửa " + $scope.dataTitle;
				$scope.status = status;
				$scope.id_member = id;
				member = $scope.dsKhachhang[indexOfMember(id)];
				$scope.khachhang = {
					ten: member.kh_hoTen, 
					trangThai: member.kh_trangThai, 
					gioitinh: member.kh_gioiTinh,
					email: member.kh_email,
					diachi: member.kh_diaChi,
					dienthoai: member.kh_dienThoai,
				};

				$("#myModal").modal("show");

			break;

			case "resetPass":
				member = $scope.dsKhachhang[indexOfMember(id)];
    			$scope.dialogTiTle = "Cấp lại mật khẩu " + $scope.dataTitle;
        		$scope.dialogButton = "Cấp lại mật khẩu";
        		$scope.status = status;
        		$scope.id_member = id;
        		$("#message").html("Bạn có muốn cấp lại mật khẩu cho \"<b class='text-danger'>"+member.kh_hoTen+"</b>\" ?");
        		$("#myModal2").modal("show");

			break;

			case "delete":

    			member = $scope.dsKhachhang[indexOfMember(id)];
    			$scope.dialogTiTle = "Xóa " + $scope.dataTitle;
        		$scope.dialogButton = "Xóa";
        		$scope.status = status;
        		$scope.id_member = id;
        		$("#message").html("Bạn có muốn xóa \"<b class='text-danger'>"+member.kh_hoTen+"</b>\" ?");
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
    			required: "Xin vui lòng nhập tên khách hàng!",
    		},
    		email: {
    			required: "Xin vui lòng nhập tên khách hàng!",
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

	    			$scope.LoadingFrm = true;
	    			
		    		var requestURL = MainURL + "khachhang/store";
		    		var requestData = $.param($scope.khachhang);

		    		$http.post(requestURL, requestData, {headers: {'Content-Type':'application/x-www-form-urlencoded'}})
		    		.then(function(response){	
		    		
		    			if(response.data.error == true){
		    				$scope.LoadingFrm = false;
		    				if(response.data.message.email != undefined)
		    					$('#dlgExistEmail').text(response.data.message.email[0]).show().fadeOut( 4000 );
		    				if(response.data.message.dienthoai != undefined)
		    					$('#dlgExistPhone').text(response.data.message.dienthoai[0]).show().fadeOut( 4000 );
		    			}else{
		    				if(response.data.message.khachhang != null){
		    					list = [];
		    					
		    					list.push(response.data.message.khachhang); 
		    					for(i=0; i < $scope.dsKhachhang.length; i++){
		    						list.push($scope.dsKhachhang[i]);
		    					}

		    					$scope.dsKhachhang = list;
		    					$scope.status = 'edit';

		    					$scope.newMember_Data = response.data.message.khachhang.kh_ma;
		    					setTimeout(function(){ $('#tr_'+$scope.newMember_Data).removeClass('bg-default'); }, 3000);
		    					
		    					$('#myModal').modal('hide');
		    					toastr.success("Thêm khách hàng thành công!");
		    					$scope.LoadingFrm = false;
		    				}else{
		    					$('#myModal').modal('hide');
		    					toastr.error("Thêm khách hàng không thành công!, vui lòng kiểm tra lại");
		    					$scope.LoadingFrm = false;
		    				}
		    			}
		    		}).catch(function(reason){
		    			$scope.LoadingFrm = false;
		    			if(reason.status == 500){
		    				$('#myModal').modal('hide');
		    				toastr.error("Có lỗi xảy ra, vui lòng kiểm tra lại!");
		    				console.log(reason);
		    			}
		    		});

	    		break;

	    		case "edit": //sửa

	    			i = indexOfMember($scope.id_member);
	    			if(i == -1){
	    				$('#myModal').modal('hide');
	        			toastr.warning("Mã khách hàng không tồn tại, vui lòng kiểm tra lại!");
	    			}else{
	    				member = $scope.dsKhachhang[i];
	    				var diff = isMemberDiff(member, $scope.khachhang);
	    				if(diff){

	    					var requestURL = MainURL + "khachhang/update/" + $scope.id_member;
	    					var requestData = $.param($scope.khachhang);

	    					$http.post(requestURL, requestData, {headers: {'Content-Type':'application/x-www-form-urlencoded'}})
	    					.then(function(response){

	    						if(response.data.error == true){
	    							if(response.data.message.email != undefined)
	    								$('#dlgExistEmail').text(response.data.message.email[0]).show().fadeOut( 4000 );
	    							if(response.data.message.dienthoai != undefined)
	    								$('#dlgExistPhone').text(response.data.message.dienthoai[0]).show().fadeOut( 4000 );
	    						}else{
	    							if(response.data.message.khachhang != null){
	    								data = response.data.message.khachhang;
	    								$scope.dsKhachhang[i] = data;

	    								$scope.newMember_Data = response.data.message.khachhang.kh_ma;
	    								setTimeout(function(){ $('#tr_'+$scope.newMember_Data).removeClass('bg-default'); }, 3000);

	    								$('#myModal').modal('hide');
	    								toastr.success("Sửa khách hàng thành công!");
	    								
	    							}else{
	    								$('#myModal').modal('hide');
	    								toastr.error("Sửa khách hàng không thành công!, vui lòng kiểm tra lại");
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
                    toastr.warning("Mã khách hàng không tồn tại!");
                }else{

                    var requestURL = MainURL + "khachhang/delete/" + $scope.id_member;

                    $http.delete(requestURL)
                    .then(function(response){

                        if(response.data.message){
                            $scope.dsKhachhang.splice(i, 1);
                            $('#myModal2').modal('hide');
                            toastr.success("Xóa khách hàng thành công!");
                        }else{
                            $('#myModal2').modal('hide');
                            toastr.error("Xóa khách hàng không thành công!");
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
                for(i=1; i<= $scope.dsKhachhang.length; i++){
                    if($('#chk'+i).prop("checked"))
                        dsCheckbox.push($('#chk'+i).val());
                }

                if(dsCheckbox.length > 0){

                    var requestURL = MainURL + 'khachhang/deleteAll';
                    var requestData = $.param({items: dsCheckbox});

                    $http.post(requestURL, requestData, {headers: {'Content-Type':'application/x-www-form-urlencoded'}})
                    .then(function(response){

                        if(response.data.message){
                            for(i in dsCheckbox){
                                memberKey = dsCheckbox[i];
                                dbMember = indexOfMember(memberKey);
                                if(dbMember != -1){
                                    $scope.dsKhachhang.splice(dbMember, 1);
                                } 
                            }
                            $('#myModal2').modal('hide');
                            toastr.success("Xóa các khách hàng thành công!");
                        }else{
                            $('#myModal2').modal('hide');
                            toastr.error("Xóa các khách hàng thành công!");
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
                	toastr.warning("Mã khách hàng không tồn tại, vui lòng kiểm tra lại!");
                }else{
                	member = $scope.dsKhachhang[i];

                	var requestURL = MainURL + "khachhang/updatePassword/" + $scope.id_member;
                	var requestData = $.param({});

                	$http.post(requestURL, requestData, {headers: {'Content-Type':'application/x-www-form-urlencoded'}})
                	.then(function(response){


                		if(response.data.message.khachhang != null){
                			data = response.data.message.khachhang;
                			$scope.dsKhachhang[i] = data;

                			$scope.newMember_Data = response.data.message.khachhang.kh_ma;
                			setTimeout(function(){ $('#tr_'+$scope.newMember_Data).removeClass('bg-default'); }, 3000);

                			$('#myModal2').modal('hide');
                			toastr.success("Cấp lại mật khẩu khách hàng thành công!");
                			$scope.LoadingFrm = false;

                		}else{
                			$('#myModal2').modal('hide');
                			toastr.error("Cấp lại mật khẩu khách hàng không thành công!, vui lòng kiểm tra lại");
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