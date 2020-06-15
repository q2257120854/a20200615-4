$(function () {
    var $login_btn_sbm = $('.login_btn_sbm');
    loginHead();
    $('.login_btn').click(function () {
       
        $('.loginHead').addClass('js_loginHead').removeClass('loginHead');
    })
    

    
})

function loginHead() {
    if ($(document).scrollTop() > 10) {
        $('.loginHead').addClass('js_loginHead').removeClass('loginHead');
    }
    $(window).scroll(function () {
        var st = $(this).scrollTop();
        if (st > 10) {
            $('.loginHead').addClass('js_loginHead').removeClass('loginHead');
        } else if (st < 10) {
            $('.js_loginHead').addClass('loginHead').removeClass('js_loginHead');
        }
    })
}


