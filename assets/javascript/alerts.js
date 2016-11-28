$(document).ready(function() {
	$('.alert').delay(10000).fadeOut();
    $('.close').on("click", function () {
	    $(this).parent('div').fadeOut();
	});
});