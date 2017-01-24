$('.menu .login').click(function(){
    if (!$('.login-form').is(':visible')){
        $('.login-form').fadeIn();
    }
});

$(document).mouseup(function (e){
    if (!$('.login-form').is(e.target) && $('.login-form').has(e.target).length === 0) {
        $('.login-form').fadeOut();
    }
});

$('.login-form .tab').click(function(){

    var form = $(this).data('form');

    $('.login-form .tab.active').removeClass('active').addClass('inactive');
    $(this).removeClass('inactive').addClass('active');

    if (form == 'client') {
        $('.login-form input[type=email]').attr('name', 'client[email]');
        $('.login-form input[type=password]').attr('name', 'client[password]');
    } else {
        $('.login-form input[type=email]').attr('name', 'login');
        $('.login-form input[type=password]').attr('name', 'password');
    }
});