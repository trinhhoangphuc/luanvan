var app = angular.module("redshop", ['ngMaterial','ckeditor', 'datatables', 'angularFileUpload']).constant('MainURL', "http://localhost/luanvan/admin/");
var app2 = angular.module("homepageredshop", ['ngMaterial']).constant('MainURL', "http://localhost/luanvan/");

function En2Vn(alias, isURL = false) {
    var str = alias;
    str= str.toLowerCase(); 
    str= str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g,"a"); 
    str= str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g,"e"); 
    str= str.replace(/ì|í|ị|ỉ|ĩ/g,"i"); 
    str= str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g,"o"); 
    str= str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g,"u"); 
    str= str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g,"y"); 
    str= str.replace(/đ/g,"d"); 
    if (isURL) {
        str= str.replace(/!|@|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\;|\'| |\"|\&|\#|\[|\]|~|$|_/g,"-");
        /* tìm và thay thế các kí tự đặc biệt trong chuỗi sang kí tự - */
        str= str.replace(/-+-/g,"-"); //thay thế 2- thành 1-
        str= str.replace(/^\-+|\-+$/g,""); 
        //cắt bỏ ký tự - ở đầu và cuối chuỗi            
    }
    return str;
}

function showAlert(status, icon, message){ // Hiển thị alert thông báo
    var content = {};
    var placementFrom = "top";
    var placementAlign = "right";

    content.message = message;
    content.title = '<b>Thông báo!</b>';
    content.icon =  icon;
    content.target = '_blank';

    $.notify(content,{
        type: status,
        placement: {
            from: placementFrom,
            align: placementAlign
        },
        time: 800,
    });
}

if (!String.prototype.getRating) {
    String.prototype.getRating = function() {
        a = this.split(";");
        n = 0;
        t = 0;
        for (var i = 1; i <= a.length; i++) {
            a[i-1] = parseInt(a[i-1]);
            n += a[i-1];
            t += i*a[i-1];
        }
        if (n == 0) { 
            n = 1;
        }
        return t/n;
    };
}

if (!Array.prototype.dbFind) {
    Array.prototype.dbFind = function(field, value) {
        for (var i = 0; i <= this.length-1; i++) {
            if (this[i][field] == value) {
                return this[i];
            }
        }
        return null;
    }
}

toastr.options = {
    "closeButton": true,
    "debug": false,
    "newestOnTop": false,
    "progressBar": true,
    "positionClass": "toast-top-right",
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