app.controller('loaiController', function($scope, $http, $filter, MainURL, DTOptionsBuilder ,DTColumnBuilder){
	
	$scope.dsLoai            = [];
	$scope.dataTitle         = "loại sản phẩm";
	$scope.status            = "edit";
	$scope.frm_details_oldTr = null;
	$scope.newMember_Data    = null;
    $scope.frm_ten           = "";
    $scope.la_ten_moi        = true;
    $scope.isNewMember       = true;
    $scope.isLoading = true;

	$scope.refresh = function(){ // Lấy danh sách loại sản phẩm
		var requestURL = MainURL + "loai/danhsach";
		$http.get(requestURL).then(function(response){
			$scope.dsLoai = response.data.message.loai;
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
		'<td style="text-align: left !important;">'+member.l_ma+'</td>'+
		'</tr>'+
		'<tr>'+
		'<td class="text-left bg-info" width="20%"><b>Tên loại:</b></td>'+
		'<td style="text-align: left !important;">'+member.l_ten+'</td>'+
		'</tr>'+
		'<tr>'+
		'<td class="text-left bg-info" width="20%"><b>Ngày tạo:</b></td>'+
		'<td style="text-align: left !important;">'+$filter('date')(new Date(member.l_taoMoi),'dd-MM-yyyy HH:mm:ss')+'</td>'+
		'</tr>'+
		'<tr>'+
		'<td class="text-left bg-info" width="20%"><b>Ngày cập nhật:</b></td>'+
		'<td style="text-align: left !important;">'+$filter('date')(new Date(member.l_capNhat),'dd-MM-yyyy HH:mm:ss')+'</td>'+
		'</tr>';


		result += '</tbody></table></td></tr>';

		return result;
	}


	function indexOfMember(id){ // lấy vị trí theo id
		for(i=0; i < $scope.dsLoai.length; i++){
			if (id == $scope.dsLoai[i].l_ma)
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

	function isMemberDiff(db, frm){ return db.l_ten != frm.ten || db.l_trangThai != frm.trangThai; }

    $scope.CreateEdit_show = function (status, id){ // hiển thị chi tiết và modal thêm sửa xóa

    	switch(status){

    		case "detail": // Hiển thị chi tiết

        		i = indexOfMember(id);
        		if(i != -1){

        			item = $scope.dsLoai[i];
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
        		$scope.loai = {ten: null, trangThai: 1};
        		
        		$("#myModal").modal("show");

    		break;

    		case "edit":

                 member = $scope.dsLoai[indexOfMember(id)];
                 $scope.dialogTiTle = "Sửa " + $scope.dataTitle;
                 $scope.dialogButton = "Sửa";
                 $scope.status = status;
                 $scope.id_member = member.l_ma;
                 $scope.loai = {
                     ten: member.l_ten, 
                     trangThai: member.l_trangThai
                 };
                 $scope.frm_ten           = member.l_ten;
                 $scope.la_ten_moi        = true;
                 $scope.isNewMember       = true;
                 $("#myModal").modal("show");

    		break;

    		case "delete":

    			member = $scope.dsLoai[indexOfMember(id)];
    			$scope.dialogTiTle = "Xóa " + $scope.dataTitle;
        		$scope.dialogButton = "Xóa";
        		$scope.status = status;
        		$scope.id_member = id;
        		$("#message").html("Bạn có muốn xóa \"<b class='text-danger'>"+member.l_ten+"</b>\" ?");
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

                    var requestURL = MainURL + "loai/store";
                    var requestData = $.param($scope.loai);

                    $http.post(requestURL, requestData, {headers: {'Content-Type':'application/x-www-form-urlencoded'}})
                    .then(function(response){

                        if(response.data.error == true){
                            if(response.data.message.ten != undefined)
                                $('#dlgExistName').text(response.data.message.ten[0]).show().fadeOut( 4000 );
                        }else{
                            if(response.data.message.loai != null){
                                list = [];
                                list.push(response.data.message.loai); 

                                for(i=0; i < $scope.dsLoai.length; i++){
                                    list.push($scope.dsLoai[i]);
                                }

                                $scope.dsLoai = list;
                                $scope.status = 'edit';

                                    // Hiển thị bg dữ liệu
                                    $scope.newMember_Data = response.data.message.loai.l_ma;
                                    setTimeout(function(){ 
                                        $('#tr_'+$scope.newMember_Data).removeClass('bg-default');
                                        $scope.newMember_Data = ""; 

                                    }, 3000);

                                    $('#myModal').modal('hide');     
                                    toastr.success("Thêm loại sản phẩm thành công!");
                                    
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
                        toastr.warning("Mã loại sản phẩm không tồn tại!");
                    }else{
                        member = $scope.dsLoai[i];
                        var diff = isMemberDiff(member, $scope.loai);
                        if(diff){

                            var requestURL = MainURL + "loai/update/" + $scope.id_member;
                            var requestData = $.param($scope.loai);

                            $http.post(requestURL, requestData, {headers: {'Content-Type':'application/x-www-form-urlencoded'}})
                            .then(function(response){
                                if(response.data.error == true){
                                    if(response.data.message.ten != undefined)
                                        $('#dlgExistName').text(response.data.message.ten[0]).show().fadeOut( 4000 );
                                }else{
                                    if(response.data.message.loai != null){
                                        data = response.data.message.loai;
                                        $scope.dsLoai[i] = data;

                                        $scope.newMember_Data = response.data.message.loai.l_ma;
                                        setTimeout(function(){ 
                                            $('#tr_'+$scope.newMember_Data).removeClass('bg-default');
                                            $scope.newMember_Data = ""; 

                                        }, 3000);

                                        $('#myModal').modal('hide');
                                        toastr.success("Sửa loại sản phẩm thành công!");
                                        
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

                    var requestURL = MainURL + "loai/delete/" + $scope.id_member;

                    $http.delete(requestURL)
                    .then(function(response){

                        if(response.data.message){
                            $scope.dsLoai.splice(i, 1);
                            $('#myModal2').modal('hide');
                            toastr.success("Xóa loại sản phẩm thành công!");
                        }else{
                            $('#myModal2').modal('hide');
                            toastr.error("Xóa loại sản phẩm không thành công!");
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
                for(i=1; i<= $scope.dsLoai.length; i++){
                    if($('#chk'+i).prop("checked"))
                        dsCheckbox.push($('#chk'+i).val());
                }

                if(dsCheckbox.length > 0){

                    var requestURL = MainURL + 'loai/deleteAll';
                    var requestData = $.param({items: dsCheckbox});

                    $http.post(requestURL, requestData, {headers: {'Content-Type':'application/x-www-form-urlencoded'}})
                    .then(function(response){

                        if(response.data.message){
                            for(i in dsCheckbox){
                                memberKey = dsCheckbox[i];
                                dbMember = indexOfMember(memberKey);
                                if(dbMember != -1){
                                    $scope.dsLoai.splice(dbMember, 1);
                                } 
                            }
                            $('#myModal2').modal('hide');
                            toastr.success("Xóa các loại sản phẩm thành công!");
                        }else{
                            $('#myModal2').modal('hide');
                            toastr.error("Xóa các loại sản phẩm thành công!");
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

});