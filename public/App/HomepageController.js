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
				$("#frmLogin").removeClass("hidden");
				$("#frmRegiter").addClass("hidden");
				$("#loginRegiter").modal("show");
			break;

			case "register":
				$("#frmLogin").addClass("hidden");
				$("#frmRegiter").removeClass("hidden");
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