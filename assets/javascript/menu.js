$('.toggle-menu').click(function(){
	if ($('#side_bar').is(':visible')) {
		$('#side_bar').fadeOut(function(){
			$('#content').fadeIn();
		});
	} else {
		$('#content').fadeOut(function(){
			$('#side_bar').fadeIn();
		});
	}
});

$(window).resize(function(){
	if ($(window).width() > 999) {
		$('#side_bar').show();
		$('#content').show();
	}
	if ($(window).width() <= 999 && $('#side_bar').is(':visible')) {
		
		$('#content').hide();
	}
	//if ($(window).width() <= 999 && $('#side_bar').not(':visible')) {
		
	//	$('#content').show();
	//}
});

$(window).on( "orientationchange", function() { 
	if ($(window).width() > 999) {
		$('#side_bar').show();
		$('#content').show();
	}
	if ($(window).width() <= 999 && $('#side_bar').is(':visible')) {

		$('#content').fadeOut();
	}
	//if ($(window).width() <= 999 && $('#side_bar').not(':visible')) {
		
	//	$('#content').show();
	//}
});