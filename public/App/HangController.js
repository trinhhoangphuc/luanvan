app.controller('hangController', function($scope, $http, $filter, MainURL, DTOptionsBuilder ,DTColumnBuilder){
	
	$scope.dsHang = [];
	$scope.dataTitle = "nhà sản xuất";
	$scope.status = "edit";
	$scope.frm_details_oldTr = null;
	$scope.newMember_Data = null;
    $scope.frm_ten           = "";
    $scope.la_ten_moi        = true;
    $scope.isNewMember       = true;
    $scope.isLoading = true;

	$scope.refresh = function(){ // Lấy danh sách nhà sản xuất
		var requestURL = MainURL + "hang/danhsach";
		$http.get(requestURL).then(function(response){
			$scope.dsHang = response.data.message.hang;
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
		'<td class="text-left bg-info" width="20%"><b>Mã nhà sản xuât:</b></td>'+
		'<td style="text-align: left !important;">'+member.h_ma+'</td>'+
		'</tr>'+
		'<tr>'+
		'<td class="text-left bg-info" width="20%"><b>Tên nhà sản xuât:</b></td>'+
		'<td style="text-align: left !important;">'+member.h_ten+'</td>'+
		'</tr>'+
		'<tr>'+
		'<td class="text-left bg-info" width="20%"><b>Ngày tạo:</b></td>'+
		'<td style="text-align: left !important;">'+$filter('date')(new Date(member.h_taoMoi),'dd-MM-yyyy HH:mm:ss')+'</td>'+
		'</tr>'+
		'<tr>'+
		'<td class="text-left bg-info" width="20%"><b>Ngày cập nhật:</b></td>'+
		'<td style="text-align: left !important;">'+$filter('date')(new Date(member.h_capNhat),'dd-MM-yyyy HH:mm:ss')+'</td>'+
		'</tr>';


		result += '</tbody></table></td></tr>';

		return result;
	}

	function indexOfMember(id){ // lấy vị trí theo id
		for(i=0; i < $scope.dsHang.length; i++){
			if (id == $scope.dsHang[i].h_ma)
				return i;
		}
		return -1;
	}


	function isMemberDiff(db, frm){ return db.h_ten != frm.ten || db.h_trangThai != frm.trangThai; }


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

        			item = $scope.dsHang[i];
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
        		$scope.hang = {ten: null, trangThai: 1};
        		
        		$("#myModal").modal("show");

    		break;

    		case "edit":

    			member = $scope.dsHang[indexOfMember(id)];
        		$scope.dialogTiTle = "Sửa " + $scope.dataTitle;
        		$scope.dialogButton = "Sửa";
        		$scope.status = status;
        		$scope.id_member = member.h_ma;
        		$scope.hang = {
        			ten: member.h_ten, 
        			trangThai: member.h_trangThai
        		};
        		$scope.frm_ten           = member.h_ten;
                $scope.la_ten_moi        = true;
                $scope.isNewMember       = true;
        		$("#myModal").modal("show");

    		break;

    		case "delete":

    			member = $scope.dsHang[indexOfMember(id)];
    			$scope.dialogTiTle = "Xóa " + $scope.dataTitle;
        		$scope.dialogButton = "Xóa";
        		$scope.status = status;
        		$scope.id_member = id;
        		$("#message").html("Bạn có muốn xóa \"<b class='text-danger'>"+member.h_ten+"</b>\" ?");
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

                case "create": //thêm

                    var requestURL = MainURL + "hang/store";
                    var requestData = $.param($scope.hang);

                    $http.post(requestURL, requestData, {headers: {'Content-Type':'application/x-www-form-urlencoded'}})
                    .then(function(response){
                        if(response.data.error == true){
                            if(response.data.message.ten != undefined)
                               $('#dlgExistName').text(response.data.message.ten[0]).show().fadeOut( 4000 );
                        }else{
                            if(response.data.message.hang != null){
                                list = [];
                                list.push(response.data.message.hang); 

                                for(i=0; i < $scope.dsHang.length; i++){
                                    list.push($scope.dsHang[i]);
                                }

                                $scope.dsHang = list;
                                $scope.status = 'edit';

                                // Hiển thị bg dữ liệu
                                $scope.newMember_Data = response.data.message.hang.h_ma;
                                setTimeout(function(){ 
                                    $('#tr_'+$scope.newMember_Data).removeClass('bg-default');
                                    $scope.newMember_Data = ""; 

                                }, 3000);

                                $('#myModal').modal('hide');
                                toastr.success("Thêm nhà sản xuất thành công!");
                                
                            }
                        }

                        }).catch(function(reason){
                            if(reason.status == 500){
                                $('#myModal').modal('hide');
                                toastr.error("Thêm nhà sản xuất không thành công!");
                            }
                        });

                break;

                case "edit": //sửa

                    i = indexOfMember($scope.id_member);
                    if(i == -1){
                        $('#myModal').modal('hide');
                        toastr.warning("Mã nhà sanr xuất không chính xác!");
                    }else{
                        member = $scope.dsHang[i];
                        var diff = isMemberDiff(member, $scope.hang);
                        if(diff){

                            var requestURL = MainURL + "hang/update/" + $scope.id_member;
                            var requestData = $.param($scope.hang);

                            $http.post(requestURL, requestData, {headers: {'Content-Type':'application/x-www-form-urlencoded'}})
                            .then(function(response){
                                
                                if(response.data.error == true){
                                    if(response.data.message.ten != undefined)
                                       $('#dlgExistName').text(response.data.message.ten[0]).show().fadeOut( 4000 );
                                }else{
                                    if(response.data.message.hang != null){
                                        data = response.data.message.hang;
                                        $scope.dsHang[i] = data;

                                        $scope.newMember_Data = response.data.message.hang.h_ma;
                                        setTimeout(function(){ 
                                            $('#tr_'+$scope.newMember_Data).removeClass('bg-default');
                                            $scope.newMember_Data = ""; 

                                        }, 3000);

                                        $('#myModal').modal('hide');
                                        toastr.success("Sửa nhà sản xuất thành công!");
                                        
                                    }
                                }

                            }).catch(function(reason){
                                if(reason.status == 500){
                                    $('#myModal').modal('hide');
                                    toastr.error("Sửa nhà sản xuất không thành công!");
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
                    toastr.warning("Mã nhà sản xuất không chính xác!");
                }else{

                    var requestURL = MainURL + "hang/delete/" + $scope.id_member;

                    $http.delete(requestURL)
                    .then(function(response){

                        if(response.data.message){
                            $scope.dsHang.splice(i, 1);
                            $('#myModal2').modal('hide');
                            toastr.success("Xóa nhà sản xuất thành công!");
                        }else{
                            $('#myModal2').modal('hide');
                            toastr.error("Xóa nhà sản xuất không thành công!");
                        }

                    }).catch(function(reason){
                        if(reason.status == 500){
                            $('#myModal2').modal('hide');
                            toastr.error("Xóa nhà sản xuất không thành công!");
                        }
                    });

                }
            break;

            case "deleteAll":

                dsCheckbox = [];
                for(i=1; i<= $scope.dsHang.length; i++){
                    if($('#chk'+i).prop("checked"))
                        dsCheckbox.push($('#chk'+i).val());
                }

                if(dsCheckbox.length > 0){

                    var requestURL = MainURL + 'hang/deleteAll';
                    var requestData = $.param({items: dsCheckbox});

                    $http.post(requestURL, requestData, {headers: {'Content-Type':'application/x-www-form-urlencoded'}})
                    .then(function(response){

                        if(response.data.message){
                            for(i in dsCheckbox){
                                memberKey = dsCheckbox[i];
                                dbMember = indexOfMember(memberKey);
                                if(dbMember != -1){
                                    $scope.dsHang.splice(dbMember, 1);
                                } 
                            }
                            $('#myModal2').modal('hide');
                            toastr.success("Xóa các nhà sản xuất thành công!");
                        }else{
                            $('#myModal2').modal('hide');
                            toastr.error("Xóa các nhà sản xuất không thành công!");
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