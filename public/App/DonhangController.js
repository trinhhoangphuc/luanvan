app.controller('donhangController', function($scope, $http, $filter, MainURL, DTOptionsBuilder ,DTColumnBuilder){
	
	$scope.dsDonhang = [];
    $scope.dsNhanvien = [];
    $scope.dsSanpham = [];
    $scope.dsKhachhang = [];

	$scope.dataTitle = "đơn hàng";
	$scope.status = "edit";
	$scope.frm_details_oldTr = null;
	$scope.newMember_Data = null;
    $scope.isLoading = true;

	$scope.refresh = function(){ // Lấy danh sách đơn hàng
		var requestURL = MainURL + "donhang/danhsach";
		$http.get(requestURL).then(function(response){
			$scope.dsDonhang = response.data.message.donhang;
            
		});

        var requestURL_2 = MainURL + "nhanvien/danhsach";
        $http.get(requestURL_2).then(function(response){
            $scope.dsNhanvien = response.data.message.nhanvien;
        });

        var requestURL_3 = MainURL + "khachhang/danhsach";
        $http.get(requestURL_3).then(function(response){
            $scope.dsKhachhang = response.data.message.khachhang;
        });

        var requestURL_4 = MainURL + "sanpham/danhsach";
        $http.get(requestURL_3).then(function(response){
            $scope.dsSanpham = response.data.message.sanpham;
            $scope.isLoading = false;
        });
	}
    $scope.getCTDHbyId = function (id) {
        
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

	// function ShowDetail(member){
	// 	var result = '<tr><td colspan="8" style="padding:5px">'+

	// 	'<table align="center" class="table table-bordered" style="margin:0px"><tbody>'+
	// 	'<tr>'+
	// 	'<td class="text-left bg-info" width="20%"><b>Mã nhà sản xuât:</b></td>'+
	// 	'<td style="text-align: left !important;">'+member.dh_ma+'</td>'+
	// 	'</tr>'+
	// 	'<tr>'+
	// 	'<td class="text-left bg-info" width="20%"><b>Tên nhà sản xuât:</b></td>'+
	// 	'<td style="text-align: left !important;">'+member.dh_ten+'</td>'+
	// 	'</tr>'+
	// 	'<tr>'+
	// 	'<td class="text-left bg-info" width="20%"><b>Ngày tạo:</b></td>'+
	// 	'<td style="text-align: left !important;">'+$filter('date')(new Date(member.dh_taoMoi),'dd-MM-yyyy HH:mm:ss')+'</td>'+
	// 	'</tr>'+
	// 	'<tr>'+
	// 	'<td class="text-left bg-info" width="20%"><b>Ngày cập nhật:</b></td>'+
	// 	'<td style="text-align: left !important;">'+$filter('date')(new Date(member.dh_capNhat),'dd-MM-yyyy HH:mm:ss')+'</td>'+
	// 	'</tr>';


	// 	result += '</tbody></table></td></tr>';

	// 	return result;
	// }

	function indexOfMember(id){ // lấy vị trí theo id
		for(i=0; i < $scope.dsDonhang.length; i++){
			if (id == $scope.dsDonhang[i].dh_ma)
				return i;
		}
		return -1;
	}


	function isMemberDiff(db, frm){ return db.dh_daThanhToan != frm.thanhToan || db.dh_trangThai != frm.trangThai; }


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

                    var requestURL = MainURL + "donhang/danhsachchitiet/" + id;
                    $http.get(requestURL).then(function(response){
                        $scope.dsCTDH = response.data.message.chitietdon;

                        $scope.itemDH = $scope.dsDonhang[i];
                        $scope.getCTDHbyId($scope.itemDH.dh_ma);

                        $scope.dialogTiTle = "Thông tin đơn hàng";
                        $scope.status = status;
                        $scope.id_member = id;

                        $("#myModal").modal("show");

                    });
        			
        		}
    		else
    			toastr.warning("vui lòng kiểm tra lại thông tin!");

    		break;

    		case "edit":

    			member = $scope.dsDonhang[indexOfMember(id)];
        		$scope.dialogTiTle = "Cập nhật đơn hàng số #" + id;
        		$scope.status = status;
        		$scope.id_member = member.dh_ma;
                $scope.dialogButton = "Cập nhật";
        		$scope.donhang = {
        			thanhToan: member.dh_daThanhToan, 
        			trangThai: member.dh_trangThai
        		};
        		$("#myModal3").modal("show");

    		break;

    		case "delete":

    			member = $scope.dsDonhang[indexOfMember(id)];
    			$scope.dialogTiTle = "Xóa " + $scope.dataTitle;
        		$scope.dialogButton = "Xóa";
        		$scope.status = status;
        		$scope.id_member = id;
        		$("#message").html("Bạn có muốn xóa \"<b class='text-danger'>#"+member.dh_ma+"</b>\" ?");
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
                        toastr.warning("Mã đơn hàng không chính xác!");
                    }else{
                        member = $scope.dsDonhang[i];
                        var diff = isMemberDiff(member, $scope.donhang);
                        if(diff){

                            var requestURL = MainURL + "donhang/update/" + $scope.id_member;
                            var requestData = $.param($scope.donhang);

                            $http.post(requestURL, requestData, {headers: {'Content-Type':'application/x-www-form-urlencoded'}})
                            .then(function(response){
                                

                                if(response.data.message.donhang != null){
                                    data = response.data.message.donhang;
                                    $scope.dsDonhang[i] = data;

                                    $scope.newMember_Data = response.data.message.donhang.dh_ma;
                                    setTimeout(function(){ 
                                        $('#tr_'+$scope.newMember_Data).removeClass('bg-default');
                                        $scope.newMember_Data = ""; 

                                    }, 3000);

                                    $('#myModal3').modal('hide');
                                    toastr.success("Sửa đơn hàng thành công!");

                                }else{
                                    $('#myModal3').modal('hide');
                                    toastr.error("Sửa đơn hàng không thành công!");
                                }
                                

                            }).catch(function(reason){
                                if(reason.status == 500){
                                    console.log(reason);
                                    $('#myModal3').modal('hide');
                                    toastr.error("Sửa đơn hàng không thành công!");
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
                    toastr.warning("Mã đơn hàng không chính xác!");
                }else{

                    var requestURL = MainURL + "donhang/delete/" + $scope.id_member;

                    $http.delete(requestURL)
                    .then(function(response){

                        if(response.data.message){
                            $scope.dsDonhang.splice(i, 1);
                            $('#myModal2').modal('hide');
                            toastr.success("Xóa đơn hàng thành công!");
                        }else{
                            $('#myModal2').modal('hide');
                            toastr.error("Xóa đơn hàng không thành công!");
                        }

                    }).catch(function(reason){
                        if(reason.status == 500){
                            $('#myModal2').modal('hide');
                             console.log(reason);
                            toastr.error("Xóa đơn hàng không thành công!");
                        }
                    });

                }
            break;

            case "deleteAll":

                dsCheckbox = [];
                for(i=1; i<= $scope.dsDonhang.length; i++){
                    if($('#chk'+i).prop("checked"))
                        dsCheckbox.push($('#chk'+i).val());
                }

                if(dsCheckbox.length > 0){

                    var requestURL = MainURL + 'donhang/deleteAll';
                    var requestData = $.param({items: dsCheckbox});

                    $http.post(requestURL, requestData, {headers: {'Content-Type':'application/x-www-form-urlencoded'}})
                    .then(function(response){

                        if(response.data.message){
                            for(i in dsCheckbox){
                                memberKey = dsCheckbox[i];
                                dbMember = indexOfMember(memberKey);
                                if(dbMember != -1){
                                    $scope.dsDonhang.splice(dbMember, 1);
                                } 
                            }
                            $('#myModal2').modal('hide');
                            toastr.success("Xóa các đơn hàng thành công!");
                        }else{
                            $('#myModal2').modal('hide');
                            toastr.error("Xóa các đơn hàng không thành công!");
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