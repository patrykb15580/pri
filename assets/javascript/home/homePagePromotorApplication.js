$('.join').click(function(){
        
    if ($(window).width() < 800) {
        $('.toggle-menu').fadeOut();
    } else {
        $('.menu').fadeOut();
    }

    $('.page').fadeOut().promise().done(function(){
        $('html, body').animate({scrollTop: '0px'}, 0);
        $('#home-page').css({ 'background-color': '#1B1B1B' });
        $('.join-form').fadeIn();
        $('.top .logo').removeClass('scroll');
        $('.top .logo').addClass('join-cancel');
        $('.top').css({ 'position': 'absolute' });
    });
});

$('.join-cancel').click(function(){
        
    if ($(window).width() < 800) {
        $('.toggle-menu').fadeIn();
    } else {
        $('.menu').fadeIn();
    }

    $('.join-form').fadeOut().promise().done(function(){
        $('#home-page').css({ 'background-color': '#FFFFFF' });
        $('.page').fadeIn();
        $('.top .logo').addClass('scroll');
        $('.top .logo').removeClass('join-cancel');
        $('.top').css({ 'position': 'fixed' });
    });
});  