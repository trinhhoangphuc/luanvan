    
$(document).ready(function(){

    url = 'http://localhost:8888/Shop/public/';

    $(window).scroll(function () {
        if ($(this).scrollTop() > 50) {
            $('#back-to-top').fadeIn();
        } else {
            $('#back-to-top').fadeOut();
        }
    });
    // scroll body to 0px on click
    $('#back-to-top').click(function () {
        $('#back-to-top').tooltip('hide');
        $('body,html').animate({
            scrollTop: 0
        }, 800);
        return false;
    });
    
    $('#back-to-top').tooltip('show');

    $('[data-toggle="tooltip"]').tooltip(); 


    $("#btnSearch").click(function(){
        tuKhoa = $('#tuKhoa').val().trim();
        tuKhoa = tuKhoa==""? "all": tuKhoa;
        window.location.href = url + 'tim-kiem-san-pham/' +tuKhoa;
    });

    $("#btnFilter").click(function(){
        maLoai = $('#loai :selected').val();
        maChude = $('#chuDe :selected').val();
        giaTu = $('#giaTu').val();
        giaDen = $('#giaDen').val();

        if(eval(giaTu) >= eval(giaDen)){
            tam = giaDen;
            giaDen = giaTu;
            giaTu = tam;
        }


        location.href = url + 'loc-san-pham/'+maLoai+"/"+maChude+"/"+giaTu+"/"+giaDen;
    });

});
