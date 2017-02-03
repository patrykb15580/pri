 $("#back-to-top").click(function (){

    $('html, body').animate({
        scrollTop: $('#home-page-top').offset().top
    }, 2000);
});

$(window).scroll(function(){
	if ($(window).scrollTop() > 470) {
		$('#back-to-top').fadeIn();
	} else {
		$('#back-to-top').fadeOut();
	}
});