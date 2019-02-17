app.controller('gopyController', function($scope, $http, $filter, MainURL, DTOptionsBuilder ,DTColumnBuilder){
	
	$scope.dsGopy = [];
	$scope.dataTitle = "bình luận";
	$scope.status = "edit";
	$scope.frm_details_oldTr = null;
	$scope.newMember_Data = null;
    $scope.isLoading = true;

	$scope.refresh = function(){ // Lấy danh sách bình luận
		var requestURL = MainURL + "gopy/danhsach";
		$http.get(requestURL).then(function(response){
			$scope.dsGopy = response.data.message.gopy;
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
		'<td class="text-left bg-info" width="20%"><b>Mã bình luận:</b></td>'+
		'<td style="text-align: left !important;">'+member.gy_ma+'</td>'+
		'</tr>'+
			'<tr>'+
		'<td class="text-left bg-info" width="20%"><b>Mã bình luận:</b></td>'+
		'<td style="text-align: left !important;">'+member.gy_noiDung+'</td>'+
		'</tr>'+
		'<tr>'+
		'<td class="text-left bg-info" width="20%"><b>Ngày tạo:</b></td>'+
		'<td style="text-align: left !important;">'+$filter('date')(new Date(member.gy_taoMoi),'dd-MM-yyyy HH:mm:ss')+'</td>'+
		'</tr>'+
		'<tr>'+
		'<td class="text-left bg-info" width="20%"><b>Ngày cập nhật:</b></td>'+
		'<td style="text-align: left !important;">'+$filter('date')(new Date(member.gy_capNhat),'dd-MM-yyyy HH:mm:ss')+'</td>'+
		'</tr>';


		result += '</tbody></table></td></tr>';

		return result;
	}

	function indexOfMember(id){ // lấy vị trí theo id
		for(i=0; i < $scope.dsGopy.length; i++){
			if (id == $scope.dsGopy[i].gy_ma)
				return i;
		}
		return -1;
	}


	function isMemberDiff(db, frm){ return db.gy_ten != frm.ten || db.gy_trangThai != frm.trangThai; }


	$scope.checkInput = function(){ // lấy tất cả dòng dữ liệu
		if($("#chkSelectItems").prop("checked"))
			$("input:checkbox").prop("checked", true);
		else
			$("input:checkbox").prop("checked", false);
	}

	$scope.CreateEdit_show = function (status, id){ // hiển thị chi tiết và modal thêm sửa xóa

    	switch(status){

    		case "detail": // Hiển thị chi tiết

        		i = indexOfMember(id);
        		if(i != -1){

        			item = $scope.dsGopy[i];
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
    			toastr.warning("vui lòng kiểm tra lại thông tin!");

    		break;

    		case "create":

        		$scope.dialogTiTle = "Thêm " + $scope.dataTitle + " mới";
        		$scope.dialogButton = "Thêm";
        		$scope.status = status;
        		$scope.gopy = {ten: null, trangThai: 1};
        		
        		$("#myModal").modal("show");

    		break;

    		case "edit":

    			member = $scope.dsGopy[indexOfMember(id)];
        		$scope.dialogTiTle = "Sửa " + $scope.dataTitle;
        		$scope.dialogButton = "Sửa";
        		$scope.status = status;
        		$scope.id_member = member.gy_ma;
        		$scope.gopy = {
        			ten: member.gy_ten, 
        			trangThai: member.gy_trangThai
        		};
        		$scope.frm_ten           = member.gy_ten;
                $scope.la_ten_moi        = true;
                $scope.isNewMember       = true;
        		$("#myModal").modal("show");

    		break;

    		case "delete":

    			member = $scope.dsGopy[indexOfMember(id)];
    			$scope.dialogTiTle = "Xóa " + $scope.dataTitle;
        		$scope.dialogButton = "Xóa";
        		$scope.status = status;
        		$scope.id_member = id;
        		$("#message").html("Bạn có muốn xóa \"<b class='text-danger'>"+member.gy_ten+"</b>\" ?");
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
            }
        }, 
        messages: {
            ten: {
                required: "Xin vui lòng nhập tên loại!",
            }
        },
        submitHandler: function(form) {
            switch($scope.status){

                case "edit": //sửa

                    i = indexOfMember($scope.id_member);
                    if(i == -1){
                        $('#myModal').modal('hide');
                        toastr.warning("Mã bình luận không chính xác!");
                    }else{
                        member = $scope.dsGopy[i];
                        var diff = isMemberDiff(member, $scope.gopy);
                        if(diff){

                            var requestURL = MainURL + "gopy/update/" + $scope.id_member;
                            var requestData = $.param($scope.gopy);

                            $http.post(requestURL, requestData, {headers: {'Content-Type':'application/x-www-form-urlencoded'}})
                            .then(function(response){
                                
                                if(response.data.message.gopy != null){
                                    data = response.data.message.gopy;
                                    $scope.dsGopy[i] = data;

                                    $scope.newMember_Data = response.data.message.gopy.gy_ma;
                                    setTimeout(function(){ $('#tr_'+$scope.newMember_Data).removeClass('bg-default'); }, 3000);

                                    $('#myModal').modal('hide');
                                    toastr.success("Sửa bình luận thành công!");

                                }

                            }).catch(function(reason){
                                if(reason.status == 500){
                                    $('#myModal').modal('hide');
                                    toastr.error("Sửa bình luận không thành công!");
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
                    toastr.warning("Mã bình luận không chính xác!");
                }else{

                    var requestURL = MainURL + "gopy/delete/" + $scope.id_member;

                    $http.delete(requestURL)
                    .then(function(response){

                        if(response.data.message){
                            $scope.dsGopy.splice(i, 1);
                            $('#myModal2').modal('hide');
                            toastr.success("Xóa bình luận thành công!");
                        }else{
                            $('#myModal2').modal('hide');
                            toastr.error("Xóa bình luận không thành công!");
                        }

                    }).catch(function(reason){
                        if(reason.status == 500){
                            $('#myModal2').modal('hide');
                            toastr.error("Xóa bình luận không thành công!");
                        }
                    });

                }
            break;

            case "deleteAll":

                dsCheckbox = [];
                for(i=1; i<= $scope.dsGopy.length; i++){
                    if($('#chk'+i).prop("checked"))
                        dsCheckbox.push($('#chk'+i).val());
                }

                if(dsCheckbox.length > 0){

                    var requestURL = MainURL + 'gopy/deleteAll';
                    var requestData = $.param({items: dsCheckbox});

                    $http.post(requestURL, requestData, {headers: {'Content-Type':'application/x-www-form-urlencoded'}})
                    .then(function(response){

                        if(response.data.message){
                            for(i in dsCheckbox){
                                memberKey = dsCheckbox[i];
                                dbMember = indexOfMember(memberKey);
                                if(dbMember != -1){
                                    $scope.dsGopy.splice(dbMember, 1);
                                } 
                            }
                            $('#myModal2').modal('hide');
                            toastr.success("Xóa các bình luận thành công!");
                        }else{
                            $('#myModal2').modal('hide');
                            toastr.error("Xóa các bình luận không thành công!");
                        }

                    }).catch(function(reason){
                        if(reason.status == 500){
                            $('#myModal2').modal('hide');
                            toastr.error("Có lỗi xảy ra, vui lòng kiểm tra lại!");
                        }
                    });

                }else{
                    $('#myModal2').modal('hide');
                    toastr.warning("Vui lòng chọn các dữ liệu cần xoá!");
                }

            break;
        } 
    });
});