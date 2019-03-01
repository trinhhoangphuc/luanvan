app.controller('chucvuController', function($scope, $http, $filter, MainURL, DTOptionsBuilder ,DTColumnBuilder){
	
	$scope.dsChucvu          = [];
    $scope.dsQuyen           = [];
	$scope.dataTitle         = "chức vụ";
	$scope.status            = "edit";
	$scope.frm_details_oldTr = null;
	$scope.newMember_Data    = null;
    $scope.isLoading = true;

	$scope.refresh = function(){ // Lấy danh sách chức vụ
		
        var requestURL = MainURL + "chucvu/danhsach";
		$http.get(requestURL).then(function(response){
			$scope.dsChucvu = response.data.message.chucvu;
            $scope.isLoading = false;
		});

        var requestURL_2 = MainURL + "chucvu/danhsachquyen";
        $http.get(requestURL_2).then(function(response){
            $scope.dsQuyen = response.data.message.quyen;
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
		'<td class="text-left bg-info" width="20%"><b>Mã loại:</b></td>'+
		'<td style="text-align: left !important;">'+member.cv_ma+'</td>'+
		'</tr>'+
		'<tr>'+
		'<td class="text-left bg-info" width="20%"><b>Tên loại:</b></td>'+
		'<td style="text-align: left !important;">'+member.cv_ten+'</td>'+
		'</tr>'+
		'<tr>'+
		'<td class="text-left bg-info" width="20%"><b>Ngày tạo:</b></td>'+
		'<td style="text-align: left !important;">'+$filter('date')(new Date(member.cv_taoMoi),'dd-MM-yyyy HH:mm:ss')+'</td>'+
		'</tr>'+
		'<tr>'+
		'<td class="text-left bg-info" width="20%"><b>Ngày cập nhật:</b></td>'+
		'<td style="text-align: left !important;">'+$filter('date')(new Date(member.cv_capNhat),'dd-MM-yyyy HH:mm:ss')+'</td>'+
		'</tr>';


		result += '</tbody></table></td></tr>';

		return result;
	}


	function indexOfMember(id){ // lấy vị trí theo id
		for(i=0; i < $scope.dsChucvu.length; i++){
			if (id == $scope.dsChucvu[i].cv_ma)
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

	function isMemberDiff(db, frm){ return db.cv_ten != frm.ten || db.cv_trangThai != frm.trangThai; }

    $scope.CreateEdit_show = function (status, id){ // hiển thị chi tiết và modal thêm sửa xóa

    	switch(status){

    		case "detail": // Hiển thị chi tiết

        		i = indexOfMember(id);
        		if(i != -1){

        			item = $scope.dsChucvu[i];
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
    			toastr.warning("Vui lòng kiểm tra lại thông tin!");

    		break;

    		case "create":

        		$scope.dialogTiTle = "Thêm " + $scope.dataTitle + " mới";
        		$scope.dialogButton = "Thêm";
        		$scope.status = status;
        		$scope.chucvu = {ten: null, trangThai: 1};
        		$('#dlgExistName').addClass('d-none');
        		$("#myModal").modal("show");

    		break;

    		case "edit":

                 member = $scope.dsChucvu[indexOfMember(id)];
                 $scope.dialogTiTle = "Sửa " + $scope.dataTitle;
                 $scope.dialogButton = "Sửa";
                 $scope.status = status;
                 $scope.id_member = member.cv_ma;
                 $scope.chucvu = {
                     ten: member.cv_ten, 
                     trangThai: member.cv_trangThai
                 };
                 
                 $("#myModal").modal("show");

            break;
            
            case "role":

                 member = $scope.dsChucvu[indexOfMember(id)];
                 $scope.dialogTiTle = "Cấp quyền " + $scope.dataTitle;
                 $scope.dialogButton = "Xác nhận";
                 $scope.status = status;
                 $scope.id_member = member.cv_ma;

                 var requestURL = MainURL + "chucvu/chitietquyen/" + member.cv_ma;
                 $http.get(requestURL).then(function(response){

                    if(response.data.message.ctquyen.length == 0)
                    {
                        $("#myModal3").modal("show");
                        for(i=0; i<$scope.dsQuyen.length; i++){
                            $("#quyen_"+$scope.dsQuyen[i].q_ma).prop("checked", false);
                        }

                    }else{

                        $("#myModal3").modal("show");
                        $scope.dsCTQ = response.data.message.ctquyen;

                        for(i=0; i<$scope.dsQuyen.length; i++){
                            $("#quyen_"+$scope.dsQuyen[i].q_ma).prop("checked", false);
                        }
                        
                        for(i=0; i<$scope.dsQuyen.length; i++){
                            for(j=0; j<$scope.dsCTQ.length; j++){
                                if( $scope.dsCTQ[j].q_ma == $("#quyen_"+$scope.dsQuyen[i].q_ma).val() ){
                                    $("#quyen_"+$scope.dsQuyen[i].q_ma).prop("checked", true);
                                    break;
                                }
                            }
                        }
                    }

                 });
    
    		break;

    		case "delete":

    			member = $scope.dsChucvu[indexOfMember(id)];
    			$scope.dialogTiTle = "Xóa " + $scope.dataTitle;
        		$scope.dialogButton = "Xóa";
        		$scope.status = status;
        		$scope.id_member = id;
        		$("#message").html("Bạn có muốn xóa \"<b class='text-danger'>"+member.cv_ten+"</b>\" ?");
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

                    var requestURL = MainURL + "chucvu/store";
                    var requestData = $.param($scope.chucvu);

                    $http.post(requestURL, requestData, {headers: {'Content-Type':'application/x-www-form-urlencoded'}})
                    .then(function(response){
                    	if(response.data.error == true){
		    				if(response.data.message.ten != undefined)
		    					$('#dlgExistName').removeClass("d-none").text(response.data.message.ten[0]);
		    			}else{
	                        if(response.data.message.chucvu != null){
	                            list = [];
	                            list.push(response.data.message.chucvu); 

	                            for(i=0; i < $scope.dsChucvu.length; i++){
	                                list.push($scope.dsChucvu[i]);
	                            }

	                            $scope.dsChucvu = list;
	                            $scope.status = 'edit';

	                            // Hiển thị bg dữ liệu
	                            $scope.newMember_Data = response.data.message.chucvu.cv_ma;
	                            setTimeout(function(){ 
                                    $('#tr_'+$scope.newMember_Data).removeClass('bg-default');
                                    $scope.newMember_Data = ""; 

                                }, 3000);

	                            $('#myModal').modal('hide');
	                            toastr.success("Thêm chức vụ thành công!");

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
                        toastr.warning("Mã chức vụ không chính xác!");
                    }else{
                        member = $scope.dsChucvu[i];
                        var diff = isMemberDiff(member, $scope.chucvu);
                        if(diff){

                            var requestURL = MainURL + "chucvu/update/" + $scope.id_member;
                            var requestData = $.param($scope.chucvu);

                            $http.post(requestURL, requestData, {headers: {'Content-Type':'application/x-www-form-urlencoded'}})
                            .then(function(response){
                                
                                if(response.data.message.chucvu != null){
                                    data = response.data.message.chucvu;
                                    $scope.dsChucvu[i] = data;

                                    $scope.newMember_Data = response.data.message.chucvu.cv_ma;
                                    setTimeout(function(){ 
                                        $('#tr_'+$scope.newMember_Data).removeClass('bg-default');
                                        $scope.newMember_Data = ""; 

                                    }, 3000);

                                    $('#myModal').modal('hide');
                                    toastr.success("Sửa chức vụ thành công!");
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
                    toastr.warning("Mã chức vụ không chính xác!");
                }else{

                    var requestURL = MainURL + "chucvu/delete/" + $scope.id_member;

                    $http.delete(requestURL)
                    .then(function(response){

                        if(response.data.message){
                            $scope.dsChucvu.splice(i, 1);
                            $('#myModal2').modal('hide');
                            toastr.success("Xóa chức vụ thành công!");
                        }else{
                            $('#myModal2').modal('hide');
                           toastr.error("Xóa chức vụ không thành công");
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
                for(i=1; i<= $scope.dsChucvu.length; i++){
                    if($('#chk'+i).prop("checked"))
                        dsCheckbox.push($('#chk'+i).val());
                }

                if(dsCheckbox.length > 0){

                    var requestURL = MainURL + 'chucvu/deleteAll';
                    var requestData = $.param({items: dsCheckbox});

                    $http.post(requestURL, requestData, {headers: {'Content-Type':'application/x-www-form-urlencoded'}})
                    .then(function(response){

                        if(response.data.message){
                            for(i in dsCheckbox){
                                memberKey = dsCheckbox[i];
                                dbMember = indexOfMember(memberKey);
                                if(dbMember != -1){
                                    $scope.dsChucvu.splice(dbMember, 1);
                                } 
                            }
                            $('#myModal2').modal('hide');
                            toastr.success("Xóa các chức vụ thành công!");
                        }else{
                            $('#myModal2').modal('hide');
                            toastr.error("Xóa các chức vụ không thành công!");
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

    $("#frmRole").on("submit", function(event){ // thêm quyên cho chức vụ

        dsCheck = [];
        for(i=0; i<$scope.dsQuyen.length; i++){
            if( $("#quyen_"+$scope.dsQuyen[i].q_ma).prop("checked") ){
                dsCheck.push($("#quyen_"+$scope.dsQuyen[i].q_ma).val());
            }
        }
      
        console.log(dsCheck);
        if(dsCheck.length > 0){
            i = indexOfMember($scope.id_member);
            if(i == -1){
                $("#myModal3").modal("hide");
                showAlert("danger", "fa fa-ban", "Mã chức vụ không tồn tại");
            }else{
                var requestURL = MainURL + "chucvu/themquyen/" + $scope.id_member;
                var requestData = $.param({items: dsCheck});
                $http.post(requestURL, requestData, {headers: {'Content-Type':'application/x-www-form-urlencoded'}})
                .then(function(response){
                    if(response.data.message){
                        $("#myModal3").modal("hide");
                       toastr.success("Cấp quyền cho chức vụ thành công!");
                    }

                }).catch(function(reason){
                    if(reason.status == 500){
                        $("#myModal3").modal("hide");
                        toastr.error("Có lỗi xảy ra, vui lòng kiểm tra lại!");
                    }
                })
            }
        }else{
            $("#myModal3").modal("hide");
            toastr.warning("Vui lòng chọn quyền trước khi cấp!");
        }
    });

});