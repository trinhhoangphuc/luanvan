app.controller('sanphamController', function($scope, $http, $timeout, $filter, MainURL, DTOptionsBuilder, DTColumnBuilder, FileUploader){

	$scope.dsSanpham		 = [];
	$scope.dsLoai			 = [];
	$scope.dsHang			 = [];
	$scope.dsHinh			 = [];
	$scope.dsHuong 			 = [];
	$scope.isLoading		 = true;

	$scope.dataTitle         = "sản phẩm";
	$scope.status            = "edit";
	$scope.newMember_Data	 = "";

	$scope.formData = {

		upload_sp_ma  : "",
        upload_l_ma   : "",
        upload_sp_ten : "",

		ckeditorOptions  : {
			language    : 'en',
			allowedContent  : true,
			entities    : false,
			height      : 150
		},

	};

	$scope.generateRating = function(id, rateValue){
    	$timeout(function(){
    		rate = rateValue;
    		$("#rt"+id).starrr({
    			rating: rate,
    			readOnly: true
    		})
    		
    	}, 1);
    }

	$scope.refresh = function() { 
		var requestURL = MainURL + "loai/danhsach";
		$http.get(requestURL).then(function(response){
			$scope.dsLoai = response.data.message.loai;
		});

		var requestURL_3 = MainURL + "hang/danhsach";
		$http.get(requestURL_3).then(function(response){
			$scope.dsHang = response.data.message.hang;
		});

		var requestURL_2 = MainURL + "sanpham/danhsach";
		$http.get(requestURL_2).then(function(response){
			$scope.dsSanpham = response.data.message.sanpham;
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

	function ShowDetail (member){
		var result = '<tr><td colspan="8" style="padding:5px">'+
		'<table align="center" class="table table-bordered" style="margin:0px"><tbody>'+
		'<tr>'+
		'<td class="text-left bg-info" width="20%"><b>Mã:</b></td>'+
		'<td class="text-left">'+member.sp_ma+'</td>'+
		'</tr>'+
		'<tr>'+
		'<td class="text-left bg-info" width="20%"><b>Mô tả:</b></td>'+
		'<td class="text-left"><div class="content-detail">'+member.sp_thongTin+'</div></td>'+
		'</tr>'+
		'<tr>'+
		'<td class="text-left bg-info" width="20%"><b>Ngày tạo:</b></td>'+
		'<td class="text-left">'+$filter('date')(new Date(member.sp_taoMoi),'dd-MM-yyyy HH:mm:ss')+'</td>'+
		'</tr>'+
		'<tr>'+
		'<td class="text-left bg-info" width="20%"><b>Ngày cập nhật:</b></td>'+
		'<td class="text-left">'+$filter('date')(new Date(member.sp_capNhat),'dd-MM-yyyy HH:mm:ss')+'</td>'+
		'</tr>';

		result += '</tbody></table></td></tr>';

		return result;
	} 

	function indexOfMember(id){ // lấy vị trí theo id
		for(i=0; i < $scope.dsSanpham.length; i++){
			if (id == $scope.dsSanpham[i].sp_ma)
				return i;
		}
		return -1;
	}


	function isMemberDiff(db, frm){
    	return db.sp_ten != frm.ten 
    	|| db.h_ma != frm.maHang 
    	|| db.l_ma != frm.maLoai
    	|| db.sp_giaBan != frm.gia
    	|| db.sp_soLuong != frm.soluong
    	|| db.sp_thongTin != frm.thongTin
    	|| db.sp_tinhTrang != frm.tinhTrang
    	|| db.sp_trangThai != frm.trangThai;
    }

	$scope.CreateEdit_show = function (status, id) {
		
		switch(status){

			case "detail":
				i = indexOfMember(id);
				if(i != -1){

					item = $scope.dsSanpham[i];
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
				if($scope.dsLoai.length > 0)
					ma_loai = $scope.dsLoai[0].l_ma;
				else
					ma_loai = 0;
				if($scope.dsHang.length > 0)
					ma_hang = $scope.dsHang[0].h_ma;
				else
					ma_hang = 0;
				$scope.sanpham = { 
					ten: "", 
					trangThai: 1, 
					gia: 100000,
					soluong: 20,
					maLoai: ma_loai,
					maHang: ma_hang,
					thongTin: "",
				};
				$("#myModal").modal("show");

			break;

			case "edit":

				$scope.dialogButton = "Sửa";
				$scope.dialogTiTle = "Sửa " + $scope.dataTitle;
				$scope.status = status;
				$scope.id_member = id;
				member = $scope.dsSanpham[indexOfMember(id)];
				$scope.sanpham = {
					ten: member.sp_ten, 
					trangThai: member.sp_trangThai, 
					tinhTrang: member.sp_tinhTrang,
					gia: member.sp_giaBan,
					soluong: member.sp_soLuong,
					maLoai: member.l_ma,
					maHang: member.h_ma,
					thongTin: member.sp_thongTin,
				};
				$("#myModal").modal("show");

			break;

			case "colorOrstate":
				$scope.id_member = id;
				 $http.get(MainURL + "huongvi/danhsach/" + id).then(function (response) {
					$scope.dsHuong = response.data.message.huong;
					$scope.dialogTiTle = "Thêm các lựa chọn";
					$("#myModal4").modal("show");
				});
				

			break;

			case "delete":

    			member = $scope.dsSanpham[indexOfMember(id)];
    			$scope.dialogTiTle = "Xóa " + $scope.dataTitle;
        		$scope.dialogButton = "Xóa";
        		$scope.status = status;
        		$scope.id_member = id;
        		$("#message").html("Bạn có muốn xóa \"<b class='text-danger'>"+member.sp_ten+"</b>\" ?");
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
    		},
    		giamgia: {   
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
    			required: "Xin vui lòng nhập giá!",
    			number: "Giá sản phẩm bắt buộc là số!",
    			digits : "Không được nhập số âm!",
    		},
    		giamgia: {
    			required: "Xin vui lòng nhập chi phí!",
    			number: "Chi phí tiền bắt buộc là số!",
    			digits : "Không được nhập số âm!",
    		}
    	},
    	submitHandler: function(form) {
    		switch($scope.status){

	    		case "create": //thêm

		    		var requestURL = MainURL + "sanpham/store";
		    		var requestData = $.param($scope.sanpham);

		    		$http.post(requestURL, requestData, {headers: {'Content-Type':'application/x-www-form-urlencoded'}})
		    		.then(function(response){

		    			if(response.data.error == true){
		    				if(response.data.message.ten != undefined)
		    					$('#dlgExistName').text(response.data.message.ten[0]).show().fadeOut( 4000 );
		    			}else{
		    				if(response.data.message.sanpham != null){
		    					list = [];
		    					
		    					list.push(response.data.message.sanpham); 
		    					for(i=0; i < $scope.dsSanpham.length; i++){
		    						list.push($scope.dsSanpham[i]);
		    					}

		    					$scope.dsSanpham = list;
		    					$scope.status = 'edit';

		    					$scope.newMember_Data = response.data.message.sanpham.sp_ma;
		    					setTimeout(function(){ $('#tr_'+$scope.newMember_Data).removeClass('bg-default'); }, 3000);

		    					$('#myModal').modal('hide');
		    					toastr.success("Thêm sản phẩm thành công!");
		    					
		    				}else{
		    					$('#myModal').modal('hide');
		    					toastr.error("Thêm sản phẩm không thành công!, vui lòng kiểm tra lại");
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
	        			toastr.warning("Mã sản phẩm không tồn tại, vui lòng kiểm tra lại!");
	    			}else{
	    				member = $scope.dsSanpham[i];
	    				var diff = isMemberDiff(member, $scope.sanpham);
	    				if(diff){

	    					var requestURL = MainURL + "sanpham/update/" + $scope.id_member;
	    					var requestData = $.param($scope.sanpham);

	    					$http.post(requestURL, requestData, {headers: {'Content-Type':'application/x-www-form-urlencoded'}})
	    					.then(function(response){

	    						if(response.data.error == true){
	    							if(response.data.message.ten != undefined)
	    								$('#dlgExistName').text(response.data.message.ten[0]).show().fadeOut( 4000 );
	    						}else{
	    							if(response.data.message.sanpham != null){
	    								data = response.data.message.sanpham;
	    								$scope.dsSanpham[i] = data;

	    								$scope.newMember_Data = response.data.message.sanpham.sp_ma;
	    								setTimeout(function(){ $('#tr_'+$scope.newMember_Data).removeClass('bg-default'); }, 3000);

	    								$('#myModal').modal('hide');
	    								toastr.success("Sửa sản phẩm thành công!");
	    								
	    							}else{
	    								$('#myModal').modal('hide');
	    								toastr.error("sửa sản phẩm không thành công!, vui lòng kiểm tra lại");
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

	$("#createHuongVi").validate({ // thêm sửa bằng jquery validate
    	rules: {
    		hv_ten: {   
    			required: true,
    		}
    	}, 
    	messages: {
    		hv_ten: {
    			required: "Xin vui lòng nhập màu sắc hoặc hương vị!",
    		}
    		
    	},
    	submitHandler: function(form) {
    		i = indexOfMember($scope.id_member);
    		if(i == -1){
    			$('#myModal4').modal('hide');
    			toastr.warning("Mã sản phẩm không tồn tại, vui lòng kiểm tra lại!");
    		}else{

    			var requestURL = MainURL + "huongvi/store/" + $scope.id_member;
    			var requestData = $.param($scope.huongvi);

    			$http.post(requestURL, requestData, {headers: {'Content-Type':'application/x-www-form-urlencoded'}})
    			.then(function(response){

    					if(response.data.message == false)
    						$('#dlgExistNameHV').removeClass("d-none").text(response.data.message.ten[0]);

    					else{
    						$scope.huongvi.hv_ten = "";
    						$scope.dsHuong = response.data.message.huong;
    						$('#dlgExistNameHV').addClass('d-none');
    					}

    			}).catch(function(reason){
    				if(reason.status == 500){
    					$('#myModal4').modal('hide');
    					toastr.error("Có lỗi xảy ra, vui lòng kiểm tra lại!");    				}
    			});
    			

    		}
	    }
    });

	$("#delte").on("submit", function(event){ // xóa dữ liệu
    	switch($scope.status){

    		case "delete" : //xóa

    			i = indexOfMember($scope.id_member);
    			if(i == -1){
    				$('#myModal2').modal('hide');
        			toastr.warning("Mã sản phẩm không tồn tại, vui lòng kiểm tra lại!");
    			}else{

    				var requestURL = MainURL + "sanpham/delete/" + $scope.id_member;

    				$http.delete(requestURL)
    				.then(function(response){

    					if(response.data.message){
    						$scope.dsSanpham.splice(i, 1);
    						$('#myModal2').modal('hide');
    						toastr.success("Xóa sản phẩm thành công!");
    					}else{
    						$('#myModal2').modal('hide');
    						toastr.error("Xóa sản phẩm không thành công!, vui lòng kiểm tra lại");
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
    			for(i=1; i<= $scope.dsSanpham.length; i++){
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
    								$scope.dsSanpham.splice(dbMember, 1);
    							} 
    						}
    						$('#myModal2').modal('hide');
    						toastr.success("Xóa các dòng dữ liệu thành công!");
    					}else{
    						$('#myModal2').modal('hide');
    						toastr.error("Xóa không thành công!, vui lòng kiểm tra lại");
    					}

    				}).catch(function(reason){
    					if(reason.status == 500){
    						$('#myModal2').modal('hide');
    						toastr.error("Có lỗi xảy ra, vui lòng kiểm tra lại!");
    					}
    				});

    			}else{
    				$('#myModal2').modal('hide');
    				toastr.error("Vui lòng chọn dữ liệu trước khi xóa!");
    			}

    		break;
    	} 
    });

    $scope.dsHuong_Delete = function(hv_ma){
    	for (i = 0; i < $scope.dsHuong.length ; i++) {
    		if(hv_ma == $scope.dsHuong[i].hv_ma){
    			vitri = i;
    			break;
    		}
    	}
		var required = MainURL + "huongvi/delete/" + hv_ma;
		$http.delete(required).then(function(response){
			if(response.data.message){
				$scope.dsHuong.splice(vitri, 1);
			}
		});
	}

	$scope.ClickShowImg = function(sp_ma){
		i = indexOfMember(sp_ma);
		if(i != -1){
			$scope.showimg = $scope.dsSanpham[i].sp_hinh;
		 	$('#myModal3').modal('show');
		}	
	}

	//Hình ảnh
    $scope.frmUpload_Show = function(sp_ma) {
      sp_idx = indexOfMember(sp_ma);
      if (sp_idx != -1) {
        $http.get(MainURL + 'hinhanh/images/'+sp_ma).then(function (response) {
          $scope.dsHinh = response.data.message.hinhanh;
          sp = $scope.dsSanpham[sp_idx];
          $scope.formData.upload_sp_ma  = sp.sp_ma;
          $scope.formData.upload_l_ma   = sp.l_ma;
          $scope.formData.upload_sp_ten = sp.sp_ten;
          $("#frmUpload").modal("show");
        });
      }
    }

    $scope.frmUpload_setMainImage = function(sp_ma, ha_ma){
        var requestURL = MainURL + 'hinhanh/updateImages';
        var refreshData = $.param({sp_ma: sp_ma, ha_ma: ha_ma});

        $http.post(requestURL, refreshData, {headers: {'Content-Type':'application/x-www-form-urlencoded'}}).then(function(response){
            img = response.data;
            i = indexOfMember(sp_ma);
            $scope.dsSanpham[i].sp_hinh = img;
        });

        $("#frmUpload").modal("hide");

        toastr.success("Cập nhật ảnh đại diện sản phẩm thành công!");
    }

    $scope.frmUpload_Delete = function(sp_ma, ha_ma){
        var requestURL = MainURL + 'hinhanh/deleteImages';
        var refreshData = $.param({sp_ma: sp_ma, ha_ma: ha_ma});

        $http.post(requestURL, refreshData, {headers: {'Content-Type':'application/x-www-form-urlencoded'}}).then(function(response){
             img = response.data;
             if(img != ''){
                i = indexOfMember(sp_ma);
                $scope.dsSanpham[i].sp_hinh = img;
             }
             for ( i = 0; i < $scope.dsHinh.length; i++) {
                if($scope.dsHinh[i].ha_ma == ha_ma){
                    $scope.dsHinh.splice(i, 1);
                    break;
                }
             }
             
        });
    }

     function generateImageName(sp_ma,sp_ten, ext) {
          return sp_ma + "_" + En2Vn(sp_ten, true) + ext;
     }

    $scope.uploader = new FileUploader({
        url:  MainURL + 'hinhanh/imagesUpload',
        
    });

      
      $scope.uploader.filters.push({
          name: 'syncFilter',
          fn: function(item /*{File|FileLikeObject}*/, options) {
                // console.log('syncFilter');
                return this.queue.length < 10;
              }
        });

    $scope.uploader.filters.push({
      name: 'asyncFilter',
      fn: function(item /*{File|FileLikeObject}*/, options, deferred) {
            // console.log('asyncFilter');
            setTimeout(deferred.resolve, 1e3);
          }
        });



    $scope.uploader.onWhenAddingFileFailed = function(item /*{File|FileLikeObject}*/, filter, options) {
        // console.info('onWhenAddingFileFailed', item, filter, options);
      };
      $scope.uploader.onAfterAddingFile = function(fileItem) {

        var fileTmp = fileItem.file.name.split('.');
        var fileExtension = '.' + fileTmp.pop();
        var fileName = fileTmp.shift();

        fileItem.file.name = generateImageName($scope.formData.upload_sp_ma, $scope.formData.upload_sp_ten,
         fileExtension);

        // console.info('onAfterAddingFile', fileItem);
      };
      $scope.uploader.onAfterAddingAll = function(addedFileItems) {
        // console.info('onAfterAddingAll', addedFileItems);
      };
      $scope.uploader.onBeforeUploadItem = function(item) {
      };
      $scope.uploader.onProgressItem = function(fileItem, progress) {
        // console.info('onProgressItem', fileItem, progress);
      };
      $scope.uploader.onProgressAll = function(progress) {
        // console.info('onProgressAll', progress);
      };
      $scope.uploader.onSuccessItem = function(fileItem, response, status, headers) {
        // console.info('onSuccessItem', fileItem, response, status, headers);
        // alert(response);
        // document.write(response);
      };
      $scope.uploader.onErrorItem = function(fileItem, response, status, headers) {
        // console.info('onErrorItem', fileItem, response, status, headers);
        alert("Ảnh có kích thước quá lớn, vui lòng chọn ảnh có kích thước nhỏ hơn!");
        // document.write(response);
      };
      $scope.uploader.onCancelItem = function(fileItem, response, status, headers) {
        // console.info('onCancelItem', fileItem, response, status, headers);
      };
      $scope.uploader.onCompleteItem = function(fileItem, response, status, headers) {

      };
      $scope.uploader.onCompleteAll = function() {

        $http.get(MainURL + 'hinhanh/images/'+$scope.formData.upload_sp_ma).then(function (response) {
          $scope.dsHinh = response.data.message.hinhanh;
        });
    }
});