app.controller('sanphamController', function($scope, $http, $timeout, $filter, MainURL, DTOptionsBuilder, DTColumnBuilder, FileUploader){

	$scope.dsSanpham		 = [];
	$scope.dsLoai			 = [];
	$scope.dsHang			 = [];
	$scope.dsHinh			 = [];
	$scope.dsChitiethuong 	 = [];
	$scope.checkHuong 		 = [];
	$scope.isLoading		 = true;

	$scope.dataTitle         = "sản phẩm";
	$scope.status            = "edit";
	$scope.newMember_Data	 = "";
	$scope.today = new Date();

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

		var requestURL_4 = MainURL + "huongvi/danhsach";
		$http.get(requestURL_4).then(function(response){
			$scope.dsHuongvi = response.data.message.huongvi;
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

	function indexOfMemberNhap(id){
		for(i=0; i<$scope.dsSoLuongNhap.length; i++){
			if( id == $scope.dsSoLuongNhap[i].n_ma ){
				return i;
			}
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

		var test = 0;

    	return db.sp_ten != frm.ten 
    	|| db.h_ma != frm.maHang 
    	|| db.l_ma != frm.maLoai
    	|| db.sp_giaBan != frm.gia
    	|| db.sp_soLuong != frm.soluong
    	|| db.sp_thongTin != frm.thongTin
    	|| db.sp_tinhTrang != frm.tinhTrang
    	|| db.sp_anh360 != frm.anh360
    	|| db.sp_trangThai != frm.trangThai;
    }

    function isMemberDiff_Nhap(db, frm){

    	var DateNgaySX=Date.parse(db.n_ngaySX);
        var DateNgaySX_2=Date.parse(frm.ngaysanxuat);

        var DateHanSD=Date.parse(db.n_hanSD);
        var DateHanSD_2=Date.parse(frm.hansudung);

        var DateNgayNhap=Date.parse(db.n_ngayNhap);
        var DateNgayNhap_2=Date.parse(frm.ngaynhap);

        return db.hv_ma 	    != 	frm.maHuong
        	|| db.n_soLuongNhap != 	frm.soluong
        	|| db.n_soLuong     !=	frm.tonkho
        	|| DateNgaySX 	    != 	DateNgaySX_2
        	|| DateHanSD 		!= 	DateHanSD_2
        	|| DateNgayNhap 	!= 	DateNgayNhap_2;
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
					anh360: 0
				};

				$("#myModal").modal("show");

			break;

			case "edit":


				var requestURL5 = MainURL + "chitiethuongvi/danhsach/" + id;
				$http.get(requestURL5).then(function(response){
					$scope.dsChitiethuong = response.data.message.chitiethuong;

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
						anh360: member.sp_anh360

					};

					$("#myModal").modal("show");
				});

			break;

			case "uploadIMG":
				sp_idx = indexOfMember(id);
			    if (sp_idx != -1) {
			    	$scope.id_member = id;

			        $http.get(MainURL + 'hinhanh/images/'+id).then(function (response) {
			          $scope.dsHinh = response.data.message.hinhanh;
			          sp = $scope.dsSanpham[sp_idx];
			          $scope.formData.upload_sp_ma  = sp.sp_ma;
			          $scope.formData.upload_l_ma   = sp.l_ma;
			          $scope.formData.upload_sp_ten = sp.sp_ten;
			          
			          $scope.dialogTiTle = sp.sp_ma +" - "+ sp.sp_ten;
			        }); // Lấy hình ảnh theo id

			        
					$http.get(MainURL + "nhap/danhsach/" + id).then(function (response) {
						$scope.dsSoLuongNhap = response.data.message.nhap;
					}); // Lấy danh sách hương vị theo id

						
					$("#myModal4").modal("show");
			    }
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

    		case "deleteAll":

    			$scope.dialogTiTle = "Xóa " + $scope.dataTitle;
        		$scope.dialogButton = "Xóa";
        		$scope.status = status;
        		$("#message").html("Bạn có muốn xóa các dòng dữ liệu đã chọn?");
        		$("#myModal2").modal("show");

    		break;
		}
	}

	$scope.CreateEditSoLuong_show = function (status, id_nhap) {
		
		switch(status){

			case "list":
				$http.get(MainURL + "nhap/danhsach/" + $scope.id_member).then(function (response) {
					$scope.dsSoLuongNhap = response.data.message.nhap;
				}); 

				$("#tableSoLuong").removeClass("hidden");
				$("#frmSoluong").addClass("hidden");
				
			break;

			case "create":

				var requestURL5 = MainURL + "chitiethuongvi/danhsach/" + $scope.id_member;
				$http.get(requestURL5).then(function(response){
					$scope.dsChitiethuong = response.data.message.chitiethuong;
					$scope.nhap = {
	                    maHuong: $scope.dsHuongvi[0].hv_ma,
	                    soluong: 10,
	                    ngaysanxuat:  $scope.today,
	                    hansudung:  $scope.today,
	                    ngaynhap:  $scope.today
	                }
	                $scope.dialogButton = "Thêm";
	                $scope.status = "create";
					$("#tableSoLuong").addClass("hidden");
					$("#frmSoluong").removeClass("hidden");
				});
			 	
				
			break;

			case "edit":
				$scope.id_nhap = id_nhap;
				var nhap_member = [];
				var requestURL5 = MainURL + "chitiethuongvi/danhsach/" + $scope.id_member;
				$http.get(requestURL5).then(function(response){
					$scope.dsChitiethuong = response.data.message.chitiethuong;

					nhap_member = $scope.dsSoLuongNhap[indexOfMemberNhap(id_nhap)];

					$scope.nhap = {
	                    maHuong: 	  nhap_member.hv_ma,
	                    soluong: 	  nhap_member.n_soLuongNhap,
	                    tonkho: 	  nhap_member.n_soLuong,
	                    ngaysanxuat:  new Date(nhap_member.n_ngaySX),
	                    hansudung:    new Date(nhap_member.n_hanSD),
	                    ngaynhap: 	  new Date(nhap_member.n_ngayNhap),
	                }
	                $scope.dialogButton = "Cập nhật";
	                $scope.status = "edit";
					$("#tableSoLuong").addClass("hidden");
					$("#frmSoluong").removeClass("hidden");
				});
			 	
				
			break;

			case "delete":
                if(confirm("Bạn có thật sự muốn xóa dữ liệu???")){
                    var requestURL = MainURL + "nhap/deleteProduct/" + id_nhap;
                    $http.delete(requestURL).then(function(response){
                        if(response.data.message){
                             $scope.CreateEditSoLuong_show('list', -1);

                             var requestURL_2 = MainURL + "sanpham/danhsach";
                             $http.get(requestURL_2).then(function(response){
                             	$scope.dsSanpham = response.data.message.sanpham;
                             });
                             
                        }else{
                            alert("Xóa không thành công!");
                        }
                    }).catch(function(reason){alert("Có lỗi xảy ra!");});
                }else{
                    return;
                }
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
    		maHuong:{
    			required: true,
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
    		maHuong: {
    			required: "Xin vui chọn các tùy chọn!",
    		},
    	},
    	submitHandler: function(form) {
    		switch($scope.status){

	    		case "create": //thêm

		    		var requestURL = MainURL + "sanpham/store";
		    		var requestData = $.param($scope.sanpham);
		    		console.log($scope.sanpham.maHuong);
		    					

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
		    					setTimeout(function(){ 
		    						$('#tr_'+$scope.newMember_Data).removeClass('bg-default');
		    						$scope.newMember_Data = ""; 

		    					}, 3000);

		    					$('#myModal').modal('hide');
		    					toastr.success("Thêm sản phẩm thành công!");

		    					console.log($scope.sanpham.maHuong);
		    					
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
	    								setTimeout(function(){ 
	    									$('#tr_'+$scope.newMember_Data).removeClass('bg-default');
	    									$scope.newMember_Data = ""; 

	    								}, 3000);

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

    				var requestURL = MainURL + 'sanpham/deleteAll';
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

    $("#frmaddproduct").on("submit", function(event){ // xóa dữ liệu
        switch($scope.status){

            case "create":

            	$scope.nhap.ngaysanxuat = $filter('date')(new Date($scope.nhap.ngaysanxuat),'yyyy-MM-dd');
                $scope.nhap.hansudung = $filter('date')(new Date($scope.nhap.hansudung),'yyyy-MM-dd');
                $scope.nhap.ngaynhap = $filter('date')(new Date($scope.nhap.ngaynhap),'yyyy-MM-dd');

            	var d1 = Date.parse($scope.nhap.ngaysanxuat);
        		var d2 = Date.parse($scope.nhap.hansudung);

            	if( d1 >= d2){
            		alert('Ngày sản xuất không được lớn hoặc bằng hạn sử dụng!');
            	}else{
            		var requestURL = MainURL + "nhap/storeProduct/" + $scope.id_member;
	                var requestData = $.param($scope.nhap);
	                $http.post(requestURL, requestData, {headers: {'Content-Type':'application/x-www-form-urlencoded'}})
	                .then(function (response) {
	                	if(!response.data.message_2)
	                	{
	                		if(response.data.message)
		                    {   
		                        $scope.CreateEditSoLuong_show('list', -1);

		                        var requestURL_2 = MainURL + "sanpham/danhsach";
								$http.get(requestURL_2).then(function(response){
									$scope.dsSanpham = response.data.message.sanpham;
								});
								
		                    }else{
		                        alert('Nhập số lượng không thành công!');
		                    }
	                	}else{
	                		alert('Thông tin này đã tồn tại!');
	                	}    
	                    
	                }).catch(function(reason) {
	                     alert('Có lỗi xảy ra vui lòng kiểm tra lại!')
	                });
            	}
                      
            break;

            case "edit":
	            $scope.nhap.ngaysanxuat = $filter('date')(new Date($scope.nhap.ngaysanxuat),'yyyy-MM-dd');
                $scope.nhap.hansudung = $filter('date')(new Date($scope.nhap.hansudung),'yyyy-MM-dd');
                $scope.nhap.ngaynhap = $filter('date')(new Date($scope.nhap.ngaynhap),'yyyy-MM-dd');

            	var d1 = Date.parse($scope.nhap.ngaysanxuat);
        		var d2 = Date.parse($scope.nhap.hansudung);

            	if( d1 >= d2){
            		alert('Ngày sản xuất không được lớn hoặc bằng hạn sử dụng!');
            	}else{

            		nhap_member = $scope.dsSoLuongNhap[indexOfMemberNhap($scope.id_nhap)];
            		diff = isMemberDiff_Nhap(nhap_member, $scope.nhap);
            		if(diff){

            			var requestURL = MainURL + "nhap/updateProduct/" + $scope.id_nhap;
            			var requestData = $.param($scope.nhap);
            			$http.post(requestURL, requestData, {headers: {'Content-Type':'application/x-www-form-urlencoded'}})
            			.then(function (response) {

            				if(!response.data.message_2){
            					if(response.data.message){   
            						$scope.CreateEditSoLuong_show('list', -1);

            						var requestURL_2 = MainURL + "sanpham/danhsach";
            						$http.get(requestURL_2).then(function(response){
            							$scope.dsSanpham = response.data.message.sanpham;
            						});

            					}else{
            						alert('Cập Nhật số lượng không thành công!');
            					}
            				}else{
            					alert('Thông tin này đã tồn tại!');
            				}    
	                    
            			}).catch(function(reason) {
            				alert('Có lỗi xảy ra vui lòng kiểm tra lại!');
            			});
            		}
            	}
            break;
        } 
    });

 //    $scope.dsChitiethuong_Delete = function(cthv_ma){
 //    	for (i = 0; i < $scope.dsChitiethuong.length ; i++) {
 //    		if(cthv_ma == $scope.dsChitiethuong[i].cthv_ma){
 //    			vitri = i;
 //    			break;
 //    		}
 //    	}
 //    	if(confirm("Bạn có chắc muốn xóa?"))
 //    	{
 //    		var required = MainURL + "chitiethuongvi/delete/" + cthv_ma;
	// 		$http.delete(required).then(function(response){
	// 			if(response.data.message){
	// 				$scope.dsChitiethuong.splice(vitri, 1);
	// 			}
	// 		});
 //    	}else{ return; }
		
	// }

	$scope.ClickShowImg = function(sp_ma){
		i = indexOfMember(sp_ma);
		if(i != -1){
			$scope.showimg = $scope.dsSanpham[i].sp_hinh;
		 	$('#myModal3').modal('show');
		}	
	}

	//Hình ảnh
    // $scope.frmUpload_Show = function(sp_ma) {
      
    // }

    $scope.frmUpload_setMainImage = function(sp_ma, ha_ma){
        var requestURL = MainURL + 'hinhanh/updateImages';
        var refreshData = $.param({sp_ma: sp_ma, ha_ma: ha_ma});

        $http.post(requestURL, refreshData, {headers: {'Content-Type':'application/x-www-form-urlencoded'}}).then(function(response){
            img = response.data;
            i = indexOfMember(sp_ma);
            $scope.dsSanpham[i].sp_hinh = img;
        });

        $("#myModal4").modal("hide");

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
            // console.log('asyncFilter');1e3
            setTimeout(deferred.resolve, 500);
          }
    });



    $scope.uploader.onWhenAddingFileFailed = function(item /*{File|FileLikeObject}*/, filter, options) {
        // console.info('onWhenAddingFileFailed', item, filter, options);
      };
      $scope.uploader.onAfterAddingFile = function(fileItem) {

        var fileTmp = fileItem.file.name.split('.');
        var fileExtension = '.' + fileTmp.pop();
        var fileName = fileTmp.shift();

        fileItem.file.name = generateImageName($scope.formData.upload_sp_ma, fileName,
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