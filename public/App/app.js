var app = angular.module("redshop", ['ngMaterial','ckeditor', 'datatables', 'angularFileUpload']).constant('MainURL', "http://localhost/luanvan/admin/");
var app2 = angular.module("homepageredshop", ['ngMaterial']).constant('MainURL', "http://localhost/luanvan/");
var URL_2 = "http://localhost/luanvan/";

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

function formatNumber(nStr, decSeperate, groupSeperate) {
    nStr += '';
    x = nStr.split(decSeperate);
    x1 = x[0];
    x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + groupSeperate + '$2');
    }
    return x1 + x2;
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

$(document).ready(function(){
    var urlAdmin = URL_2 + "admin/donhang/totalOrder";
    function load(){
        $.ajax({
            url: urlAdmin,
            type: "GET",
            headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        }).done(function(res){
            result = res.message;
            if (result > 0) {
                str =   '<span  class="label label-rouded label-danger pull-right">'+result+'</span>';
                $('#totalOrder').html(str);
            }else{
                $('#totalOrder').html('');
            }
        });
    }

    load();

    setInterval(function(){
        load();
    }, 20000);
});