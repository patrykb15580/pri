$(document).ready(function() {
	$('.alert').delay(10000).fadeOut();

	$('.close').click(function(){
		$(this).parent('div').fadeOut();
	});
});