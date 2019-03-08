app2.controller('HomepageController', function($scope, $http, $filter, MainURL){

	$scope.status = "";

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

});