$('.show-menu').click(function(){
	$('#content').fadeOut(function(){
		$('#side_bar').fadeIn();
	});
});

$('.hide-menu').click(function(){
	$('#side_bar').fadeOut(function(){
		$('#content').fadeIn();
	});
});
$(window).resize(function(){
	if ($(window).width() > 999) {
		('#side_bar').show();
	}
});