app.controller('vanchuyenController', function($scope, $http, $filter, MainURL, DTOptionsBuilder, DTColumnBuilder){
		
	$scope.dsVanchuyen 		 = [];
	$scope.isLoading		 = true;

	$scope.dataTitle         = "vận chuyển";
	$scope.status            = "edit";

	$scope.newMember_Data 	 = false;
	$scope.frm_details_oldTr = null;

	$scope.refresh = function() { 
		var requestURL = MainURL + "vanchuyen/danhsach";
		$http.get(requestURL).then(function(response){
			$scope.dsVanchuyen = response.data.message.vanchuyen;
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


	function ShowDetail(member) { //hiển thị chi tiêt vận chuyển

		var result = '<tr><td colspan="8" style="padding:5px">'+
		'<table align="center" class="table table-bordered" style="margin:0px"><tbody>'+
		'<tr>'+
		'<td class="text-left bg-info" width="20%"><b>Mã vận chuyển:</b></td>'+
		'<td style="text-align: left !important;">'+member.vc_ma+'</td>'+
		'</tr>'+
		'<tr>'+
		'<td class="text-left bg-info" width="20%"><b>Tên vận chuyển:</b></td>'+
		'<td style="text-align: left !important;">'+member.vc_ten+'</td>'+
		'</tr>'+
		'<tr>'+
		'<td class="text-left bg-info" width="20%"><b>Ngày tạo:</b></td>'+
		'<td style="text-align: left !important;">'+$filter('date')(new Date(member.vc_taoMoi),'dd-MM-yyyy HH:mm:ss')+'</td>'+
		'</tr>'+
		'<tr>'+
		'<td class="text-left bg-info" width="20%"><b>Ngày cập nhật:</b></td>'+
		'<td style="text-align: left !important;">'+$filter('date')(new Date(member.vc_capNhat),'dd-MM-yyyy HH:mm:ss')+'</td>'+
		'</tr>';

		result += '</tbody></table></td></tr>';

		return result;
	}

	function indexOfMember(id){ // lấy vị trí theo id
		for(i=0; i < $scope.dsVanchuyen.length; i++){
			if (id == $scope.dsVanchuyen[i].vc_ma)
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

	function isMemberDiff(db, frm){ return db.vc_ten != frm.ten || db.vc_gia != frm.gia || db.vc_trangThai != frm.trangThai; }

	$scope.CreateEdit_show = function (status, id) {
		
		switch(status){

			case "detail":
				i = indexOfMember(id);
				if(i != -1){

					item = $scope.dsVanchuyen[i];
					tr = $("#tr_"+id);
					icon = $(tr).find(".btn-detail i");

					if($(icon).prop("class") == "fa fa-eye"){

						$(icon).prop("class", "fa fa-eye-slash");
						$(tr).next("tr").remove();
						$scope.frm_details_oldTr = null;
					}else{

						if($scope.frm_details_oldTr != null){
							oldtr = $scope.frm_details_oldTr;
							oldicon = $(oldtr).find(".btn-detail i");
							$(oldicon).prop("class", "fa fa-eye-slash");
							$(oldtr).next("tr").remove();
						}

						icon.prop("class", "fa fa-eye");
						$(tr).after(ShowDetail(item));
						$scope.frm_details_oldTr = $(tr);

					}
				}
			break;

			case "create":

				$scope.dialogTiTle = "Thêm " + $scope.dataTitle + " mới";
				$scope.dialogButton = "Thêm";
				$scope.status = status;
				$scope.vanchuyen = { ten: "", trangThai: 1, gia: 100000};
				$("#myModal").modal("show");

			break;

			case "edit":

                 member = $scope.dsVanchuyen[indexOfMember(id)];
                 $scope.dialogTiTle = "Sửa " + $scope.dataTitle;
                 $scope.dialogButton = "Sửa";
                 $scope.status = status;
                 $scope.id_member = member.vc_ma;
                 $scope.vanchuyen = {
                     ten: member.vc_ten, 
                     trangThai: member.vc_trangThai,
                     gia: member.vc_gia
                 };
                 $scope.frm_ten           = member.vc_ten;
                 $scope.la_ten_moi        = true;
                 $scope.isNewMember       = true;
                 $("#myModal").modal("show");

    		break;

    		case "delete":

    			member = $scope.dsVanchuyen[indexOfMember(id)];
    			$scope.dialogTiTle = "Xóa " + $scope.dataTitle;
        		$scope.dialogButton = "Xóa";
        		$scope.status = status;
        		$scope.id_member = id;
        		$("#message").html("Bạn có muốn xóa \"<b class='text-danger'>"+member.vc_ten+"</b>\" ?");
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
    		gia: {   
    			required: true,
    			number: true,
    			digits: true,
    		}
    	}, 
    	messages: {
    		ten: {
    			required: "Xin vui lòng nhập tên loại!",
    		},
    		gia: {
    			required: "Xin vui lòng nhập chi phí!",
    			number: "Chi phí tiền bắt buộc là số!",
    			digits : "Không được nhập số âm!",
    		}
    	},
		submitHandler: function(form) {
			switch($scope.status){

	    		case "create": //thêm

		    		var requestURL = MainURL + "vanchuyen/store";
		    		var requestData = $.param($scope.vanchuyen);

		    		$http.post(requestURL, requestData, {headers: {'Content-Type':'application/x-www-form-urlencoded'}})
		    		.then(function(response){

		    			if(response.data.error == true){
                            if(response.data.message.ten != undefined)
                               $('#dlgExistName').text(response.data.message.ten[0]).show().fadeOut( 4000 );
                        }else{
			    			if(response.data.message.vanchuyen != null){
			    				list = [];
			    				list.push(response.data.message.vanchuyen); 

			    				for(i=0; i < $scope.dsVanchuyen.length; i++){
			    					list.push($scope.dsVanchuyen[i]);
			    				}

			    				$scope.dsVanchuyen = list;
			    				$scope.status = 'edit';

			        			// Hiển thị bg dữ liệu
			        			$scope.newMember_Data = response.data.message.vanchuyen.vc_ma;
			        			setTimeout(function(){ $('#tr_'+$scope.newMember_Data).removeClass('bg-default'); }, 3000);

			        			$('#myModal').modal('hide');
			        			toastr.success("Thêm vận chuyển thành công!");
			        			
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
	        			toastr.warning("Mã vận chuyển không chính xác!");
	    			}else{
	    				member = $scope.dsVanchuyen[i];
	    				var diff = isMemberDiff(member, $scope.vanchuyen);
	    				if(diff){

	    					var requestURL = MainURL + "vanchuyen/update/" + $scope.id_member;
	    					var requestData = $.param($scope.vanchuyen);

	    					$http.post(requestURL, requestData, {headers: {'Content-Type':'application/x-www-form-urlencoded'}})
	    					.then(function(response){
	    						
	    						if(response.data.error == true){
	    							if(response.data.message.ten != undefined)
	    								$('#dlgExistName').text(response.data.message.ten[0]).show().fadeOut( 4000 );
	    						}else{
	    							if(response.data.message.vanchuyen != null){
	    								data = response.data.message.vanchuyen;
	    								$scope.dsVanchuyen[i] = data;

	    								$scope.newMember_Data = response.data.message.vanchuyen.vc_ma;
	    								setTimeout(function(){ $('#tr_'+$scope.newMember_Data).removeClass('bg-default'); }, 3000);

	    								$('#myModal').modal('hide');
	    								toastr.success("Sửa vận chuyển thành công!");

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
        			toastr.warning("Mã vận chuyển không tồn tại!");
    			}else{

    				var requestURL = MainURL + "vanchuyen/delete/" + $scope.id_member;

    				$http.delete(requestURL)
    				.then(function(response){

    					if(response.data.message){
    						$scope.dsVanchuyen.splice(i, 1);
    						$('#myModal2').modal('hide');
    						toastr.success("Xóa vận chuyển thành công!");
    					}else{
    						$('#myModal2').modal('hide');
    						toastr.error("Xóa vận chuyển không thành công!");
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
    			for(i=1; i<= $scope.dsVanchuyen.length; i++){
    				if($('#chk'+i).prop("checked"))
    					dsCheckbox.push($('#chk'+i).val());
    			}

    			if(dsCheckbox.length > 0){

    				var requestURL = MainURL + 'vanchuyen/deleteAll';
    				var requestData = $.param({items: dsCheckbox});

    				$http.post(requestURL, requestData, {headers: {'Content-Type':'application/x-www-form-urlencoded'}})
    				.then(function(response){

    					if(response.data.message){
    						for(i in dsCheckbox){
    							memberKey = dsCheckbox[i];
    							dbMember = indexOfMember(memberKey);
    							if(dbMember != -1){
    								$scope.dsVanchuyen.splice(dbMember, 1);
    							} 
    						}
    						$('#myModal2').modal('hide');
    						toastr.success("Xóa các dòng dữ liệu thành công!");
    					}else{
    						$('#myModal2').modal('hide');
    						toastr.error("Xóa vận chuyển không thành công!");
    					}

    				}).catch(function(reason){
    					if(reason.status == 500){
    						$('#myModal2').modal('hide');
    						toastr.error("Có lỗi xảy ra, vui lòng kiểm tra lại!");
    					}
    				});

    			}else{
    				$('#myModal2').modal('hide');
    				toastr.warning("Vui lòng chọn dữ liệu cần xóa!");
    			}

    		break;
    	} 
    });

});