app.controller('bannerController', function($scope, $http, $filter, MainURL, DTOptionsBuilder ,DTColumnBuilder){
	
	$scope.dsBanner = [];
	$scope.dataTitle = "ảnh quảng cáo";
	$scope.status = "edit";
	$scope.frm_details_oldTr = null;
	$scope.newMember_Data = null;

    $scope.isLoading = true;

	$scope.refresh = function(){ // Lấy danh sách ảnh quảng cáo
		var requestURL = MainURL + "banner/danhsach";
		$http.get(requestURL).then(function(response){
			$scope.dsBanner = response.data.message.banner;
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
		'<td class="text-left bg-info" width="20%"><b>Mã banner:</b></td>'+
		'<td style="text-align: left !important;">'+member.bn_ma+'</td>'+
		'</tr>'+
		'<tr>'+
		'<td class="text-left bg-info" width="20%"><b>Tên banner:</b></td>'+
		'<td style="text-align: left !important;">'+member.bn_hinh+'</td>'+
		'</tr>'+
		// '<tr>'+
		// '<td class="text-left bg-info" width="20%"><b>Khuyến mãi:</b></td>'+
		// '<td style="text-align: left !important;">'+member.bn_km+'</td>'+
		// '</tr>'+
		'<tr>'+
		'<td class="text-left bg-info" width="20%"><b>Ngày tạo:</b></td>'+
		'<td style="text-align: left !important;">'+$filter('date')(new Date(member.bn_taoMoi),'dd-MM-yyyy HH:mm:ss')+'</td>'+
		'</tr>'+
		'<tr>'+
		'<td class="text-left bg-info" width="20%"><b>Ngày cập nhật:</b></td>'+
		'<td style="text-align: left !important;">'+$filter('date')(new Date(member.bn_capNhat),'dd-MM-yyyy HH:mm:ss')+'</td>'+
		'</tr>';


		result += '</tbody></table></td></tr>';

		return result;
	}

	function indexOfMember(id){ // lấy vị trí theo id
		for(i=0; i < $scope.dsBanner.length; i++){
			if (id == $scope.dsBanner[i].bn_ma)
				return i;
		}
		return -1;
	}


	function isMemberDiff(db, frm){ return db.bn_hinh != frm.ten || db.bn_trangThai != frm.trangThai; }


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

        			item = $scope.dsBanner[i];
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
        		$("#bannerFile").val(null);
        		$("#trangthaiKhaDung").prop("checked", true);
        		var output = document.getElementById('output');
				output.src = "";

        		$("#myModal").modal("show");

    		break;

    		case "edit":


    			member = $scope.dsBanner[indexOfMember(id)];
        		$scope.dialogTiTle = "Sửa " + $scope.dataTitle;
        		$scope.dialogButton = "Sửa";
        		$scope.status = status;
        		$scope.id_member = member.bn_ma;

                var requestURL = MainURL + "../public/images/banner/" + member.bn_hinh;
                var output = document.getElementById('output');
                output.src = requestURL;

                if(member.bn_trangThai == 1)
                    $("#trangthaiKhaDung").prop("checked", true);
                else
                    $("#trangthaiKhoa").prop("checked", true);


        		$("#myModal").modal("show");

    		break;

    		case "delete":

    			member = $scope.dsBanner[indexOfMember(id)];
    			$scope.dialogTiTle = "Xóa " + $scope.dataTitle;
        		$scope.dialogButton = "Xóa";
        		$scope.status = status;
        		$scope.id_member = id;
        		$("#message").html("Bạn có muốn xóa \"<b class='text-danger'>"+member.bn_hinh+"</b>\" ?");
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

    

	$("#frmCreatEdit").on("submit", function(event){
		event.preventDefault();

		 switch($scope.status){

            case "create":

            	if($("#bannerFile").val() == ""){
            		$("#error").text("Vui lòng chọn ảnh!").show().fadeOut( 4000 );
            	}else{
            		var requestURL = MainURL + "banner/store";

		            $.ajax({
		                url: requestURL,
		                method: "POST",
		                data:new FormData(this),
		                dataType: 'JSON',
		                contentType: false,
		                cache: false,
		                processData: false,
		                success: function(data)
		                {
		                	if(data.error == true){
		                		if(data.message.bannerFile != undefined)
		                			$('#error').text(data.message.bannerFile[0]).show().fadeOut( 4000 );
		                	}else{
		                		if(data.message.banner != null){

		                			$scope.refresh();
	                                // Hiển thị bg dữ liệu
	                                $scope.newMember_Data = data.message.banner.bn_ma;
	                                setTimeout(function(){ 
                                        $('#tr_'+$scope.newMember_Data).removeClass('bg-default');
                                        $scope.newMember_Data = ""; 

                                    }, 3000);

	                                $('#myModal').modal('hide');
	                                toastr.success("thành công");
	                            }
	                            else{
	                            	toastr.error("Không thành công!");
	                            }
	                        }
		                },
		                error: function(data)
		                {
		                    console.log(data);
		                }

		            });
            	}
	            
            break;

            case "edit":
                var requestURL = MainURL + "banner/update/" + $scope.id_member;
                console.log(requestURL);
                $.ajax({
                    url: requestURL,
                    method: "POST",
                    data:new FormData(this),
                    dataType: 'JSON',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(data)
                    {
                        
                        if(data.message.banner != null){

                            $scope.refresh();
                            // Hiển thị bg dữ liệu
                            $scope.newMember_Data = data.message.banner.bn_ma;
                            setTimeout(function(){ 
                                $('#tr_'+$scope.newMember_Data).removeClass('bg-default');
                                $scope.newMember_Data = ""; 

                            }, 3000);

                            $('#myModal').modal('hide');
                            toastr.success("thành công");
                        }
                        else{
                            toastr.error("Không thành công!");
                        }
                        
                    },
                    error: function(data)
                    {
                        console.log(data);
                    }

                });
            break;
        }
    });


    $("#delte").on("submit", function(event){ // xóa dữ liệu
        switch($scope.status){

            case "delete" : //xóa

                i = indexOfMember($scope.id_member);
                if(i == -1){
                    $('#myModal2').modal('hide');
                    toastr.warning("Mã ảnh quảng cáo không chính xác!");
                }else{

                    var requestURL = MainURL + "banner/delete/" + $scope.id_member;

                    $http.delete(requestURL)
                    .then(function(response){

                        if(response.data.message){
                            $scope.dsBanner.splice(i, 1);
                            $('#myModal2').modal('hide');
                            toastr.success("Xóa ảnh quảng cáo thành công!");
                        }else{
                            $('#myModal2').modal('hide');
                            toastr.error("Xóa ảnh quảng cáo không thành công!");
                        }

                    }).catch(function(reason){
                        if(reason.status == 500){
                            $('#myModal2').modal('hide');
                            toastr.error("Xóa ảnh quảng cáo không thành công!");
                        }
                    });

                }
            break;

            case "deleteAll":

                dsCheckbox = [];
                for(i=1; i<= $scope.dsBanner.length; i++){
                    if($('#chk'+i).prop("checked"))
                        dsCheckbox.push($('#chk'+i).val());
                }

                if(dsCheckbox.length > 0){

                    var requestURL = MainURL + 'banner/deleteAll';
                    var requestData = $.param({items: dsCheckbox});

                    $http.post(requestURL, requestData, {headers: {'Content-Type':'application/x-www-form-urlencoded'}})
                    .then(function(response){

                        if(response.data.message){
                            for(i in dsCheckbox){
                                memberKey = dsCheckbox[i];
                                dbMember = indexOfMember(memberKey);
                                if(dbMember != -1){
                                    $scope.dsBanner.splice(dbMember, 1);
                                } 
                            }
                            $('#myModal2').modal('hide');
                            toastr.success("Xóa các ảnh quảng cáo thành công!");
                        }else{
                            $('#myModal2').modal('hide');
                            toastr.error("Xóa các ảnh quảng cáo không thành công!");
                        }

                    }).catch(function(reason){
                        if(reason.status == 500){
                            $('#myModal2').modal('hide');
                            toastr.error("Có lỗi xảy ra, vui lòng kiểm tra lại!");
                            console.log(reason);
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