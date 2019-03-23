app.controller('khuyenmaiController', function($scope, $http, $filter, MainURL, DTOptionsBuilder ,DTColumnBuilder){
	
	$scope.dsKhuyenmai         =  [];
    $scope.dsLoai              =  [];
    $scope.dsSanPhamTheoLoai   =  [];
    $scope.dsChitietKhuyenMai  =  [];
	$scope.dataTitle           =  "khuyến mãi";
	$scope.status              =  "edit";
	$scope.frm_details_oldTr   =  null;
	$scope.newMember_Data      =  null;
    $scope.isLoading = true;
    $scope.isLoading2 = true;
    $scope.today = new Date();

	$scope.refresh = function(){ // Lấy danh sách khuyến mãi sản phẩm

		var requestURL = MainURL + "khuyenmai/danhsach";
		$http.get(requestURL).then(function(response){
			$scope.dsKhuyenmai = response.data.message.khuyenmai;
            
		});

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
		'<td class="text-left bg-info" width="20%"><b>Mã khuyến mãi:</b></td>'+
		'<td style="text-align: left !important;">'+member.km_ma+'</td>'+
		'</tr>'+
        '<tr>'+
        '<td class="text-left bg-info" width="20%"><b>Mô tả ngắn:</b></td>'+
        '<td style="text-align: left !important;">'+member.km_moTaNgan+'</td>'+
        '</tr>'+
		'<tr>'+
		'<td class="text-left bg-info" width="20%"><b>Nội dung:</b></td>'+
		'<td style="text-align: left !important;">'+member.km_noiDung+'</td>'+
		'</tr>'+
		'<tr>'+
		'<td class="text-left bg-info" width="20%"><b>Nhân viên lập:</b></td>'+
		'<td style="text-align: left !important;">'+member.nv_hoTen+'</td>'+
		'</tr>'+
		'<tr>'+
		'<td class="text-left bg-info" width="20%"><b>Ngày tạo:</b></td>'+
		'<td style="text-align: left !important;">'+$filter('date')(new Date(member.km_ngayLap),'dd-MM-yyyy HH:mm:ss')+'</td>'+
		'</tr>';


		result += '</tbody></table></td></tr>';

		return result;
	}


	function indexOfMember(id){ // lấy vị trí theo id
		for(i=0; i < $scope.dsKhuyenmai.length; i++){
			if (id == $scope.dsKhuyenmai[i].km_ma)
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

	function isMemberDiff(db, frm){ 

        return db.km_ten != frm.ten 
            || db.km_moTaNgan != frm.moTaNgan
            || db.km_noiDung != frm.noiDung
            || Date.parse(db.km_batDau) != Date.parse(frm.ngayBD)
            || Date.parse(db.km_ketThuc) != Date.parse(frm.ngayKT)
            || db.km_trangThai != frm.trangThai; 
    }

    $scope.changeProduct = function(){

        var id = $scope.loai.l_ma;
        var requestURL = MainURL + "khuyenmai/danhsachSPbyIdLoai/" + id;
        $http.get(requestURL).then(function(response){
            $scope.dsSanPhamTheoLoai = response.data.message.sanpham;
            $scope.isLoading2 = false;
        });
    }

    $scope.CreateEdit_show = function (status, id){ // hiển thị chi tiết và modal thêm sửa xóa

    	switch(status){

    		case "detail": // Hiển thị chi tiết

        		i = indexOfMember(id);
        		if(i != -1){

        			item = $scope.dsKhuyenmai[i];
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
    			toastr.warning("Mã khuyến mãi không tồn tại!");

    		break;

    		case "create":

        		$scope.dialogTiTle = "Thêm " + $scope.dataTitle + " mới";
        		$scope.dialogButton = "Thêm";
        		$scope.status = status;
        		$scope.khuyenmai = {
                    ten: null, 
                    trangThai: 1,
                    ngayBD: $scope.today,
                    ngayKT: $scope.today,
                    noiDung: null,
                    moTaNgan: null
                };
        		
        		$("#myModal").modal("show");

    		break;

            case "addProduct":
                $scope.id_member = id;
                $scope.status = status;
                var requestURL = MainURL + "khuyenmai/chitietkhuyenmai/" + id;
                $http.get(requestURL).then(function(response){
                    $scope.dsChitietKhuyenMai = response.data.message.chitietkhuyenmai;
                });
                $scope.loai = {l_ma:0};
                $scope.changeProduct();
                $("#myModal2").modal("show");

            break;

    		case "edit":

                 member = $scope.dsKhuyenmai[indexOfMember(id)];
                 $scope.dialogTiTle = "Sửa " + $scope.dataTitle;
                 $scope.dialogButton = "Sửa";
                 $scope.status = status;
                 $scope.id_member = member.km_ma;
                 $scope.khuyenmai = {
                     ten: member.km_ten, 
                     trangThai: member.km_trangThai,
                     ngayBD:  new Date(member.km_batDau),
                     ngayKT: new Date(member.km_ketThuc),
                     noiDung: member.km_noiDung,
                     moTaNgan: member.km_moTaNgan,
                 };
                 $scope.frm_ten           = member.km_ten;
                 $scope.la_ten_moi        = true;
                 $scope.isNewMember       = true;
                 $("#myModal").modal("show");

    		break;

    		case "delete":

    			member = $scope.dsKhuyenmai[indexOfMember(id)];
    			$scope.dialogTiTle = "Xóa " + $scope.dataTitle;
        		$scope.dialogButton = "Xóa";
        		$scope.status = status;
        		$scope.id_member = id;
        		$("#message").html("Bạn có muốn xóa \"<b class='text-danger'>"+member.km_ten+"</b>\" ?");
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
            ten: { required: true, },
            ngayBD: { required: true, },
            ngayKT: { required: true, },
        }, 
        messages: {
            ten: { required: "Xin vui lòng nhập tiêu đề khuyến mãi!", },
            ngayBD: { required: "Xin vui lòng nhập ngày bắt đầu!", },
            ngayKT: { required: "Xin vui lòng nhập ngày kết thúc!", },
        },
        submitHandler: function(form) {
            switch($scope.status){

                case "create": //thêm
                    $scope.khuyenmai.ngayBD = $filter('date')(new Date($scope.khuyenmai.ngayBD),'yyyy-MM-dd');
                    $scope.khuyenmai.ngayKT = $filter('date')(new Date($scope.khuyenmai.ngayKT),'yyyy-MM-dd');

                    var d1 = Date.parse($scope.khuyenmai.ngayBD);
                    var d2 = Date.parse($scope.khuyenmai.ngayKT);

                    if( d1 >= d2){
                        alert('Ngày bắt đầu không được lớn hoặc bằng ngày kết thúc!');
                    }else{
                        var requestURL = MainURL + "khuyenmai/store";
                        var requestData = $.param($scope.khuyenmai);

                        $http.post(requestURL, requestData, {headers: {'Content-Type':'application/x-www-form-urlencoded'}})
                        .then(function(response){

                            if(response.data.error == true){
                                if(response.data.message.ten != undefined)
                                    $('#dlgExistName').text(response.data.message.ten[0]).show().fadeOut( 4000 );
                            }else{
                                if(response.data.message.khuyenmai != null){
                                    list = [];
                                    list.push(response.data.message.khuyenmai); 

                                    for(i=0; i < $scope.dsKhuyenmai.length; i++){
                                        list.push($scope.dsKhuyenmai[i]);
                                    }

                                    $scope.dsKhuyenmai = list;
                                    $scope.status = 'edit';

                                    // Hiển thị bg dữ liệu
                                    $scope.newMember_Data = response.data.message.khuyenmai.km_ma;
                                    setTimeout(function(){ 
                                        $('#tr_'+$scope.newMember_Data).removeClass('bg-default');
                                        $scope.newMember_Data = ""; 

                                    }, 3000);

                                    $('#myModal').modal('hide');     
                                    toastr.success("Thêm khuyến mãi sản phẩm thành công!");
                                        
                                }
                            }

                        }).catch(function(reason){
                            if(reason.status == 500){
                                $('#myModal').modal('hide');
                                toastr.error("Có lỗi xảy ra, vui lòng kiểm tra lại!");
                                console.log(reason);
                            }
                        });
                    }

                break;

                case "edit": //sửa

                    i = indexOfMember($scope.id_member);
                    if(i == -1){
                        $('#myModal').modal('hide');
                        toastr.warning("Mã khuyến mãi sản phẩm không tồn tại!");
                    }else{
                        member = $scope.dsKhuyenmai[i];
                        var diff = isMemberDiff(member, $scope.khuyenmai);
                        if(diff){
                            $scope.khuyenmai.ngayBD = $filter('date')(new Date($scope.khuyenmai.ngayBD),'yyyy-MM-dd');
                            $scope.khuyenmai.ngayKT = $filter('date')(new Date($scope.khuyenmai.ngayKT),'yyyy-MM-dd');

                            var d1 = Date.parse($scope.khuyenmai.ngayBD);
                            var d2 = Date.parse($scope.khuyenmai.ngayKT);

                            if( d1 >= d2){
                                alert('Ngày bắt đầu không được lớn hoặc bằng ngày kết thúc!');
                            }else{
                                var requestURL = MainURL + "khuyenmai/update/" + $scope.id_member;
                                var requestData = $.param($scope.khuyenmai);

                                $http.post(requestURL, requestData, {headers: {'Content-Type':'application/x-www-form-urlencoded'}})
                                .then(function(response){
                                    if(response.data.error == true){
                                        if(response.data.message.ten != undefined)
                                            $('#dlgExistName').text(response.data.message.ten[0]).show().fadeOut( 4000 );
                                    }else{
                                        if(response.data.message.khuyenmai != null){
                                            data = response.data.message.khuyenmai;
                                            $scope.dsKhuyenmai[i] = data;

                                            $scope.newMember_Data = response.data.message.khuyenmai.km_ma;
                                            setTimeout(function(){ 
                                                $('#tr_'+$scope.newMember_Data).removeClass('bg-default');
                                                $scope.newMember_Data = ""; 

                                            }, 3000);

                                            $('#myModal').modal('hide');
                                            toastr.success("Sửa khuyến mãi sản phẩm thành công!");

                                        }
                                    }
                                }).catch(function(reason){
                                    if(reason.status == 500){
                                        $('#myModal').modal('hide');
                                        toastr.error("Có lỗi xảy ra, vui lòng kiểm tra lại!");
                                         console.log(reason);
                                    }
                                });
                            }
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
                    toastr.warning("Mã khuyến mãi không tồn tại!");
                }else{

                    var requestURL = MainURL + "khuyenmai/delete/" + $scope.id_member;

                    $http.delete(requestURL)
                    .then(function(response){

                        if(response.data.message){
                            $scope.dsKhuyenmai.splice(i, 1);
                            $('#myModal2').modal('hide');
                            toastr.success("Xóa khuyến mãi sản phẩm thành công!");
                        }else{
                            $('#myModal2').modal('hide');
                            toastr.error("Xóa khuyến mãi sản phẩm không thành công!");
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
                for(i=1; i<= $scope.dsKhuyenmai.length; i++){
                    if($('#chk'+i).prop("checked"))
                        dsCheckbox.push($('#chk'+i).val());
                }

                if(dsCheckbox.length > 0){

                    var requestURL = MainURL + 'khuyenmai/deleteAll';
                    var requestData = $.param({items: dsCheckbox});

                    $http.post(requestURL, requestData, {headers: {'Content-Type':'application/x-www-form-urlencoded'}})
                    .then(function(response){

                        if(response.data.message){
                            for(i in dsCheckbox){
                                memberKey = dsCheckbox[i];
                                dbMember = indexOfMember(memberKey);
                                if(dbMember != -1){
                                    $scope.dsKhuyenmai.splice(dbMember, 1);
                                } 
                            }
                            $('#myModal2').modal('hide');
                            toastr.success("Xóa các khuyến mãi sản phẩm thành công!");
                        }else{
                            $('#myModal2').modal('hide');
                            toastr.error("Xóa các khuyến mãi sản phẩm thành công!");
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

    $scope.saveProduct = function () {
        dsCheckbox = [];
        for(i=1; i<= $scope.dsSanPhamTheoLoai.length; i++){
            if($('#chk'+i).prop("checked"))
                dsCheckbox.push($('#chk'+i).val());
        }

        if(dsCheckbox.length > 0){

            var requestURL = MainURL + 'khuyenmai/storeChitietkhuyenmai/' + $scope.id_member;
            var requestData = $.param({items: dsCheckbox});

            $http.post(requestURL, requestData, {headers: {'Content-Type':'application/x-www-form-urlencoded'}})
            .then(function(response){

                if(response.data.message){
                    $scope.CreateEdit_show("addProduct", $scope.id_member);
                     alert("Chọn sản phẩm thành công!");
                }else{
                    alert("Có lỗi xảy ra!");
                }

            }).catch(function(reason){
                if(reason.status == 500){
                    $('#myModal2').modal('hide');
                    toastr.error("Có lỗi xảy ra, vui lòng kiểm tra lại!");
                    console.log(reason);
                }
            });

        }else{
           alert("Vui lòng chọn sản phẩm!");
        }

    }

});