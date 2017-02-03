$('.toggle-menu').click(function(){
    $('.top .menu').fadeToggle();
});

$(window).resize(function(){
    if ($(window).width() < 800) {
        $('.top .menu').css({ 'display': 'none' });
        $('.top .toggle-menu').css({ 'display': 'inline-block' });
    } else {
        $('.top .menu').css({ 'display': 'inline-block' });
        $('.top .toggle-menu').css({ 'display': 'none' });
    }
});

    

$('.top .menu div').click(function(){
    if ($(window).width() < 800 && $('.top .menu').is(':visible')) {
        $('.top .menu').fadeOut();
    }
});