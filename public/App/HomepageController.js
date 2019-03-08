app2.controller('HomepageController', function($scope, $http, $filter, MainURL){

	$scope.status = "";

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
            phone: 		{ required: true, number: true },
            address: 	{  required: true },
            password: 		{ required: true, minlength: 6, maxlength: 32 },
            repassword: { equalTo: "#password" }
        }, 
        messages: {
            name: 		{ required: "Xin vui lòng nhập họ tên.", },
            email: 		{ required: 'Xin vui lòng nhập email.', email: "Email không đúng định dạng." },
            phone: 		{ required: "Xin vui lòng nhập số điện thoại.", number: "Số điện thoại không đúng định dạng." },
            address: 	{ required: "Xin vui lòng nhập địa chỉ.", },
            password: 		{ required: "Xin vui lòng nhập mật khẩu.", minlength: "Mật khẩu phải lớn hơn 6 ký tự", maxlength: "Mật khẩu phải nhỏ hơn 32 ký tự" },
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

    $scope.logout = function(){
    	var requestURL  = MainURL + "dang-xuat";
    	$http.get(requestURL)
    	.then(function(response){
    		if(response.data.message) window.location.reload();	
    	}).catch(function(reason){
    		console.log(reason);
    	});
    }

});