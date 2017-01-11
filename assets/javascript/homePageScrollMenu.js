if ($(window).width() > 599) {
	$(window).scroll(function(){
		if ($(window).scrollTop() > 100) {
			$('#home-page-menu').css({ 'position': 'fixed', 'top': '0px', 'box-shadow': '0px 5px 5px #BCBCBC' });
		} else {
			$('#home-page-menu').css({ 'position': 'static', 'box-shadow': '0px 0px 0px #FFFFFF' });
		}
	});
}