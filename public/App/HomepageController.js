toastr.options = {
    "closeButton": true,
    "debug": false,
    "newestOnTop": false,
    "progressBar": true,
    "positionClass": "toast-bottom-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "linear",
    "hideEasing": "linear",
    "showMethod": "show",
    "hideMethod": "hide"
}

app2.controller('HomepageController', function($scope, $http, $filter, MainURL){

	$scope.status = "";
    $scope.cart = "";
    $scope.URL_3 = MainURL + "chi-tiet-san-pham/";
    
    $scope.isLoading = true;

    $scope.refreshCart = function(){
        var requestURL = MainURL + "so-luong-gio-hang";
        $http.get(requestURL).then(function(response){
            $scope.cart = response.data.message.cart;
        });
        $scope.register2 = { gender:1};

        
    }

    $scope.refreshCart();
    console.log($scope.products);

   
	//Lọc dữ liệu
	$scope.filterSP = function(){
		var loai   = $("#loai :selected").val();
		var chude  = $("#hang :selected").val();
		var giaTu  = $("#giaTu").val();
		var giaDen = $("#giaDen").val();
		var tam = 0;
		if(eval(giaTu) >= eval(giaDen)){
			tam =giaTu;
			giaTu = giaDen;
			giaDen = tam;
		}
		location.href = MainURL + "loc-du-lieu/" + loai + "/" + chude + "/" + giaTu + "/" + giaDen ;
	}


    $("#searchFrm").on("submit", function(event){ // tìm kiếm
        var name = $("#search").val();
        if(name.length > 0){
            location.href = MainURL + "searchProduct/" + name;
        }else{
            return;
        }
        
    });

	//Hiển thị form đăng ký & đăng nhập
	$scope.showLoginRegister = function(status){
		switch(status){

			case "login":
				$("#submitLoginRegister").removeClass("hidden");
				$("#frmSuccessEror").addClass("hidden");

				$("#frmLogin").removeClass("hidden");
				$("#frmRegiter").addClass("hidden");

				$("#loginRegiter").modal("show");
			break;

			case "register":
				$("#submitLoginRegister").removeClass("hidden");
				$("#frmSuccessEror").addClass("hidden");

				$("#frmLogin").addClass("hidden");
				$("#frmRegiter").removeClass("hidden");

				$scope.register = {gender: 1}

				$("#loginRegiter").modal("show");
			break;

			case "success":

				$("#submitLoginRegister").addClass("hidden");
				$("#frmSuccessEror").removeClass("hidden");

				$("#loginRegiter").modal("show");
			break;

            case "profile":
                $("#profile").addClass("hidden");
                $("#frmProfile").removeClass("hidden");
            break;

            case "cancelProfile":
                $("#profile").removeClass("hidden");
                $("#frmProfile").addClass("hidden");
            break;
            
		}
	}


	//submit login & register
	$("#frmPostLoin").validate({ 
        rules: {
            emailLogin: {   
                required: true,
                email: true
            },
            passLogin:{
            	required: true,
            }
        }, 
        messages: {
            emailLogin: {
                required: "Xin vui lòng nhập email!",
                email: "Email không đúng định dạng!",
            },
            passLogin:{
            	required: "Xin vui lòng nhập mật khẩu!",
            }
        },
        submitHandler: function(form) {
            var requestData = $.param($scope.login);
            var requestURL  = MainURL + "dang-nhap";
            $http.post(requestURL, requestData, {headers: {'Content-Type':'application/x-www-form-urlencoded'}})
            .then(function(response){
            	if(response.data.message) window.location.reload();
            	else $("#errorLogin").text("Email hoặc mật khẩu không chính xác!").show();
            }).catch(function(reason){
            	console.log(reason);
            });
        }
    });

    $("#frmPostRegister").validate({ 
        rules: {
            name: 		{ required: true, },
            email: 		{ required: true, email: true },
            phone: 		{ required: true, number: true, maxlength: 10, minlength: 10 },
            address: 	{  required: true },
            password: 	{ required: true, minlength: 6, maxlength: 32 },
            repassword: { equalTo: "#password" }
        }, 
        messages: {
            name: 		{ required: "Xin vui lòng nhập họ tên.", },
            email: 		{ required: 'Xin vui lòng nhập email.', email: "Email không đúng định dạng." },
            phone: 		{
                required: "Xin vui lòng nhập số điện thoại.", 
                number: "Số điện thoại không đúng định dạng.",  
                maxlength: "Số điện thoại vượt quá 10 số.",
                minlength: "Số điện thoại phải đủ 10 sô."
             },
            address: 	{ required: "Xin vui lòng nhập địa chỉ.", },
            password: 	{ required: "Xin vui lòng nhập mật khẩu.", minlength: "Mật khẩu phải lớn hơn 6 ký tự", maxlength: "Mật khẩu phải nhỏ hơn 32 ký tự" },
            repassword: { equalTo: "Nhập lại mật khẩu không chính xác." }
        },
        submitHandler: function(form) {
            var requestData = $.param($scope.register);
            var requestURL  = MainURL + "dang-ky";
            $http.post(requestURL, requestData, {headers: {'Content-Type':'application/x-www-form-urlencoded'}})
            .then(function(response){
            	if(response.data.error){
            		if(response.data.message.email != undefined)
            			$('#errorEmail').text(response.data.message.email[0]).show();
            		if(response.data.message.phone != undefined)
            			$('#errorPhone').text(response.data.message.phone[0]).show();
            	}else{
            		if(response.data.message_2){
            			$("#submitLoginRegister").addClass("hidden");
						$("#frmSuccessEror").removeClass("hidden");
            		}

            	} 
            }).catch(function(reason){
            	console.log(reason);
            });
        }
    });

    $("#frmPostRegister-2").validate({ 
        rules: {
            name:       { required: true, },
            email:      { required: true, email: true },
            phone:       { required: true, number: true, maxlength: 10, minlength: 10 },
            address:    {  required: true },
            password:   { required: true, minlength: 6, maxlength: 32 },

        }, 
        messages: {
            name:       { required: "Xin vui lòng nhập họ tên.", },
            email:      { required: 'Xin vui lòng nhập email.', email: "Email không đúng định dạng." },
            phone:      {
                required: "Xin vui lòng nhập số điện thoại.", 
                number: "Số điện thoại không đúng định dạng.",  
                maxlength: "Số điện thoại vượt quá 10 số.",
                minlength: "Số điện thoại phải đủ 10 sô."
             },
            address:    { required: "Xin vui lòng nhập địa chỉ.", },
            password:   { required: "Xin vui lòng nhập mật khẩu.", minlength: "Mật khẩu phải lớn hơn 6 ký tự", maxlength: "Mật khẩu phải nhỏ hơn 32 ký tự" },
            
        },
        submitHandler: function(form) {
            var requestData = $.param($scope.register2);
            var requestURL  = MainURL + "dang-ky-2";
            $http.post(requestURL, requestData, {headers: {'Content-Type':'application/x-www-form-urlencoded'}})
            .then(function(response){
                if(response.data.error){
                    if(response.data.message.email != undefined)
                        $('#errorEmail-2').text(response.data.message.email[0]).show();
                    if(response.data.message.phone != undefined)
                        $('#errorPhone-2').text(response.data.message.phone[0]).show();
                }else{
                    if(response.data.message_2){
                        window.location.reload();
                    }

                } 
            }).catch(function(reason){
                console.log(reason);
            });
        }
    });

    $("#frmPostProfile").validate({ 
        rules: {
            name:       { required: true, },
            phone:      { required: true, number: true, maxlength: 10, minlength: 10 },
            address:    {  required: true },
            newPass:    { minlength: 6, maxlength: 32 },
            rePass:     { equalTo: "#newPass" },
        }, 
        messages: {
            name:       { required: "Xin vui lòng nhập họ tên.", },
            phone:      {
                required: "Xin vui lòng nhập số điện thoại.", 
                number: "Số điện thoại không đúng định dạng.",  
                maxlength: "Số điện thoại vượt quá 10 số.",
                minlength: "Số điện thoại phải đủ 10 sô."
             },
            address:    { required: "Xin vui lòng nhập địa chỉ.", },
            newPass:   { minlength: "Mật khẩu phải lớn hơn 6 ký tự", maxlength: "Mật khẩu phải nhỏ hơn 32 ký tự" },
            rePass:     { equalTo: "Mật khẩu không trung khớp." },
        },
        
    });


    $scope.logout = function(){
    	var requestURL  = MainURL + "dang-xuat";
    	$http.get(requestURL)
    	.then(function(response){
    		if(response.data.message) window.location.reload();	
    	}).catch(function(reason){
    		console.log(reason);
    	});
    }

    $scope.addToCart = function(id, status){

        switch(status){
            case "single":
                var requestURL = MainURL + "them-gio-hang/" + id;
                $http.get(requestURL).then(function(response){
                    if(response.data.message){
                        toastr.success("Đã thêm sản phẩm vào giỏ hàng!");
                        $scope.refreshCart();
                    }
                    else
                        toastr.warning("Không đủ số lượng!");
                });
            break;

            case "view":
                var requestURL = MainURL + "them-gio-hang/" + id;
                $http.get(requestURL).then(function(response){
                    if(response.data.message){
                        location.reload();
                    }
                    else
                        toastr.warning("Không đủ số lượng!");
                });
            break;

            case "multi": 
                var soluong = $("#qty_"+id).val();
                var mahuong = $("#mahuong_"+id).val();
                var requestURL = MainURL + "them-gio-hang-2/" + id + "/" + soluong + "/" + mahuong;
                $http.get(requestURL).then(function(response){
                    if(response.data.message){
                        toastr.success("Đã thêm sản phẩm vào giỏ hàng!");
                        $scope.refreshCart();
                    }
                    else
                        toastr.warning("Không đủ số lượng!");
                });
            break;
        }
    }


    $("#form-payment").validate({ 
        rules: {
            name:       { required: true, },
            phone:      { required: true, number: true, maxlength: 10, minlength: 10 },
            address:    {  required: true },
        }, 
        messages: {
            name:       { required: "Xin vui lòng nhập họ tên.", },
            phone:      {
                required: "Xin vui lòng nhập số điện thoại.", 
                number: "Số điện thoại không đúng định dạng.",  
                maxlength: "Số điện thoại vượt quá 10 số.",
                minlength: "Số điện thoại phải đủ 10 sô."
             },
            address:    { required: "Xin vui lòng nhập địa chỉ.", },
        },
        
    });
   
    
     $scope.compelte = function(string){
        $scope.products = [];
        if(string.length > 0){
            var requestURL = MainURL + "getAllProductsToSearch/" + string;
            $http.get(requestURL).then(function(response){
                $scope.products = response.data.message.products;
                if($scope.products.length > 0){
                    $scope.hidethis = false;
                    $scope.filterSearch = $scope.products;
                    $("#box-search-item").css({'height':'300px'});
                }else{
                    $scope.hidethis = true;
                    $scope.products = [];
                    $scope.filterSearch = $scope.products;
                    $("#box-search-item").css({'height':'0px'});
                }
            });
        }else{
            $scope.products = [];
            $scope.filterSearch = $scope.products;
            $("#box-search-item").css({'height':'0px'});
        }
        
        // angular.forEach($scope.products, function(search){
        //     if(search.toLowerCase().indexOf(string.toLowerCase()) >= 1){
        //         output.push(search);
        //         $scope.hidethis = false;
        //     }
            
        // });
    };

    // $scope.fillTextBox = function(string){
    //     $scope.search = string.sp_ten;
    //     $scope.hidethis = true;
    // };

});