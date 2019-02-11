app.controller('nhacungcapController', function($scope, $http, $filter, MainURL, DTOptionsBuilder ,DTColumnBuilder){
	
	$scope.dsNhacungcap            = [];
	$scope.dataTitle         = "nhà cung cấp";
	$scope.status            = "edit";

	$scope.frm_details_oldTr = null;
	$scope.newMember_Data    = null;

    $scope.isLoading         = true;

	$scope.refresh = function(){ // Lấy danh sách nhà cung cấp
		var requestURL = MainURL + "nhacungcap/danhsach";
		$http.get(requestURL).then(function(response){
			$scope.dsNhacungcap = response.data.message.nhacungcap;
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
		var result = '<tr><td colspan="8" style="padding:5px">'+

		'<table align="center" class="table table-bordered" style="margin:0px"><tbody>'+
		'<tr>'+
		'<td class="text-left bg-info" width="20%"><b>Mã nhà cung cấp:</b></td>'+
		'<td style="text-align: left !important;">'+member.ncc_ma+'</td>'+
		'</tr>'+
		'<tr>'+
		'<td class="text-left bg-info" width="20%"><b>Tên nhà cung cấp:</b></td>'+
		'<td style="text-align: left !important;">'+member.ncc_ten+'</td>'+
		'</tr>'+
		'<tr>'+
		'<td class="text-left bg-info" width="20%"><b>Email:</b></td>'+
		'<td style="text-align: left !important;">'+member.ncc_email+'</td>'+
		'</tr>'+
		'<tr>'+
		'<td class="text-left bg-info" width="20%"><b>Đia chỉ:</b></td>'+
		'<td style="text-align: left !important;">'+member.ncc_diaChi+'</td>'+
		'</tr>'+
		'<tr>'+
		'<td class="text-left bg-info" width="20%"><b>Điện thoại:</b></td>'+
		'<td style="text-align: left !important;">'+member.ncc_dienThoai+'</td>'+
		'</tr>'+
		'<tr>'+
		'<td class="text-left bg-info" width="20%"><b>Ngày tạo:</b></td>'+
		'<td style="text-align: left !important;">'+$filter('date')(new Date(member.ncc_taoMoi),'dd-MM-yyyy HH:mm:ss')+'</td>'+
		'</tr>'+
		'<tr>'+
		'<td class="text-left bg-info" width="20%"><b>Ngày cập nhật:</b></td>'+
		'<td style="text-align: left !important;">'+$filter('date')(new Date(member.ncc_capNhat),'dd-MM-yyyy HH:mm:ss')+'</td>'+
		'</tr>';


		result += '</tbody></table></td></tr>';

		return result;
	}


	function indexOfMember(id){ // lấy vị trí theo id
		for(i=0; i < $scope.dsNhacungcap.length; i++){
			if (id == $scope.dsNhacungcap[i].ncc_ma)
				return i;
		}
		return -1;
	}

    function updateIsNewMember() {
       $scope.isNewMember = $scope.la_ten_moi;
    }

	$scope.checkInput = function(){
		if($("#chkSelectItems").prop("checked"))
			$("input:checkbox").prop("checked", true);
		else
			$("input:checkbox").prop("checked", false);
	}

	function isMemberDiff(db, frm){ 
		return db.ncc_ten != frm.ten 
		|| db.ncc_email != frm.email
		|| db.ncc_dienThoai != frm.dienthoai
		|| db.ncc_diaChi != frm.diachi
		|| db.ncc_trangThai != frm.trangThai; 
	}

	$scope.CreateEdit_show = function (status, id){ // hiển thị chi tiết và modal thêm sửa xóa

    	switch(status){

    		case "detail": // Hiển thị chi tiết

        		i = indexOfMember(id);
        		if(i != -1){

        			item = $scope.dsNhacungcap[i];
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
    			toastr.warning("Vui lòng kiểm tra lại!");

    		break;

    		case "create":

        		$scope.dialogTiTle = "Thêm " + $scope.dataTitle + " mới";
        		$scope.dialogButton = "Thêm";
        		$scope.status = status;
        		$scope.nhacungcap = {
        			ten: "", 
        			email: null,
        			dienthoai: null,
        			diachi: null,
        			trangThai: 1
        		};

        		$("#myModal").modal("show");

    		break;

    		case "edit":

                 member = $scope.dsNhacungcap[indexOfMember(id)];
                 $scope.dialogTiTle = "Sửa " + $scope.dataTitle;
                 $scope.dialogButton = "Sửa";
                 $scope.status = status;
                 $scope.id_member = member.ncc_ma;
                 $scope.nhacungcap = {
                     ten: member.ncc_ten, 
                     email: member.ncc_email,
        			 dienthoai: member.ncc_dienThoai,
        			 diachi: member.ncc_diaChi,
                     trangThai: member.ncc_trangThai,
                 };
                 $scope.frm_ten           = member.ncc_ten;
                 $("#myModal").modal("show");

    		break;

    		case "delete":

    			member = $scope.dsNhacungcap[indexOfMember(id)];
    			$scope.dialogTiTle = "Xóa " + $scope.dataTitle;
        		$scope.dialogButton = "Xóa";
        		$scope.status = status;
        		$scope.id_member = id;
        		$("#message").html("Bạn có muốn xóa \"<b class='text-danger'>"+member.ncc_ten+"</b>\" ?");
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

		    		var requestURL = MainURL + "nhacungcap/store";
		    		var requestData = $.param($scope.nhacungcap);

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
    		    			if(response.data.message.nhacungcap != null){
    		    				list = [];
    		    				list.push(response.data.message.nhacungcap); 

    		    				for(i=0; i < $scope.dsNhacungcap.length; i++){
    		    					list.push($scope.dsNhacungcap[i]);
    		    				}

    		    				$scope.dsNhacungcap = list;
    		    				$scope.status = 'edit';

    		        			// Hiển thị bg dữ liệu
    		        			$scope.newMember_Data = response.data.message.nhacungcap.ncc_ma;
    		        			setTimeout(function(){ $('#tr_'+$scope.newMember_Data).removeClass('bg-default'); }, 3000);

    		        			$('#myModal').modal('hide');
    		        			toastr.success("Thêm nhà cung cấp thành công");
    		        			
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
	        			toastr.warning("Mã nhà cung cấp không chính xác!");
	    			}else{
	    				member = $scope.dsNhacungcap[i];
	    				var diff = isMemberDiff(member, $scope.nhacungcap);
	    				if(diff){

	    					var requestURL = MainURL + "nhacungcap/update/" + $scope.id_member;
	    					var requestData = $.param($scope.nhacungcap);

	    					$http.post(requestURL, requestData, {headers: {'Content-Type':'application/x-www-form-urlencoded'}})
	    					.then(function(response){

	    						if(response.data.error == true){
                                    if(response.data.message.ten != undefined)
                                        $('#dlgExistName').text(response.data.message.ten[0]).show().fadeOut( 4000 );
                                }else{
    	    						if(response.data.message.nhacungcap != null){
    	    							data = response.data.message.nhacungcap;
    	    							$scope.dsNhacungcap[i] = data;

    	    							$scope.newMember_Data = response.data.message.nhacungcap.ncc_ma;
    	    							setTimeout(function(){ $('#tr_'+$scope.newMember_Data).removeClass('bg-default'); }, 3000);

    	    							$('#myModal').modal('hide');
    	    							toastr.success("Sửa nhà cung cấp thành công!");
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
        			toastr.warning("Mã nhà cung cấp không chính xác!");
    			}else{

    				var requestURL = MainURL + "nhacungcap/delete/" + $scope.id_member;

    				$http.delete(requestURL)
    				.then(function(response){

    					if(response.data.message){
    						$scope.dsNhacungcap.splice(i, 1);
    						$('#myModal2').modal('hide');
    						toastr.success("Xóa nhà cung cấp thành công!");
    					}else{
    						$('#myModal2').modal('hide');
    						toastr.error("Xóa nhà cung cấp không thành công!");
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
    			for(i=1; i<= $scope.dsNhacungcap.length; i++){
    				if($('#chk'+i).prop("checked"))
    					dsCheckbox.push($('#chk'+i).val());
    			}

    			if(dsCheckbox.length > 0){

    				var requestURL = MainURL + 'nhacungcap/deleteAll';
    				var requestData = $.param({items: dsCheckbox});

    				$http.post(requestURL, requestData, {headers: {'Content-Type':'application/x-www-form-urlencoded'}})
    				.then(function(response){

    					if(response.data.message){
    						for(i in dsCheckbox){
    							memberKey = dsCheckbox[i];
    							dbMember = indexOfMember(memberKey);
    							if(dbMember != -1){
    								$scope.dsNhacungcap.splice(dbMember, 1);
    							} 
    						}
    						$('#myModal2').modal('hide');
    						toastr.success("Xóa các nhà cung cấp thành công!");
    					}else{
    						$('#myModal2').modal('hide');
    						toastr.error("Xóa các nhà cung cấp không thành công");
    					}

    				}).catch(function(reason){
    					if(reason.status == 500){
    						$('#myModal2').modal('hide');
    						toastr.error("Có lỗi xảy ra, vui lòng kiểm tra lại!");
    					}
    				});

    			}else{
    				$('#myModal2').modal('hide');
    				toastr.warning("Vui lòng chọn các dữ liệu cần xóa");
    			}

    		break;
    	} 
    });

});