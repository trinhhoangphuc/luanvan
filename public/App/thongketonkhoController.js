app.controller('thongketonkhoController', function($scope, $http, $filter, MainURL, DTOptionsBuilder ,DTColumnBuilder){
	
    $scope.dsSanpham = [];
    $scope.dsHuongvi = [];
    $scope.isLoading = true;
    $scope.isLoading2 = true;
    $scope.today = new Date();

    $scope.refresh = function(){ // Lấy danh sách khuyến mãi sản phẩm

        var requestURL = MainURL + "sanpham/danhsach";
        $http.get(requestURL).then(function(response){
            $scope.dsSanpham = response.data.message.sanpham;
            $scope.sanpham = {sp_ma: 0};
            
        });

        var requestURL = MainURL + "huongvi/danhsach";
        $http.get(requestURL).then(function(response){
            $scope.dsHuongvi = response.data.message.huongvi;
            $scope.isLoading = false;
        });
    }

    $scope.changeProduct = function(){

        var id = $scope.sanpham.sp_ma;
        var requestURL = MainURL + "thongke/sanphamtonkho/danhsach/" + id;
        $http.get(requestURL).then(function(response){
            $scope.dsNhap = response.data.message.nhap;
            var url_excel = "thongke/excelSPTK/" + id;
            var result = '<a href="'+ url_excel +'" target="_blank" class="btn btn-danger btn-flat"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Xuất File Excel</a>';
            $("#btn-excel").html(result);
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

    function indexOfMember(id){ // lấy vị trí theo id
        for(i=0; i < $scope.dsNhap.length; i++){
            if (id == $scope.dsNhap[i].n_ma)
                return i;
        }
        return -1;
    }

	function ShowDetail(member){
		var result = '<tr><td colspan="7" style="padding:5px">'+

		'<table align="center" class="table table-bordered" style="margin:0px"><tbody>'+
		'<tr>'+
		'<td class="text-left bg-info" width="20%"><b>Mã nhập:</b></td>'+
		'<td style="text-align: left !important;">'+member.n_ma+'</td>'+
		'</tr>'+
        '<tr>'+
        '<td class="text-left bg-info" width="20%"><b>Số lượng nhập:</b></td>'+
        '<td style="text-align: left !important;">'+member.n_soLuongNhap+'</td>'+
        '</tr>'+
		'<tr>'+
		'<td class="text-left bg-info" width="20%"><b>Ngày sản xuất:</b></td>'+
		'<td style="text-align: left !important;">'+$filter('date')(new Date(member.n_ngaySX),'dd-MM-yyyy')+'</td>'+
		'</tr>'+
		'<tr>'+
		'<td class="text-left bg-info" width="20%"><b>Hạn sử dụng:</b></td>'+
		'<td style="text-align: left !important;">'+$filter('date')(new Date(member.n_hanSD),'dd-MM-yyyy')+'</td>'+
		'</tr>'+
		'<tr>'+
		'<td class="text-left bg-info" width="20%"><b>Ngày nhập:</b></td>'+
		'<td style="text-align: left !important;">'+$filter('date')(new Date(member.n_ngayNhap),'dd-MM-yyyy')+'</td>'+
		'</tr>';


		result += '</tbody></table></td></tr>';

		return result;
	}

    $scope.CreateEdit_show = function (status, id){ // hiển thị chi tiết và modal thêm sửa xóa

        switch(status){

            case "detail": // Hiển thị chi tiết

                i = indexOfMember(id);
                if(i != -1){

                    item = $scope.dsNhap[i];
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

        }
    }
	

   


});