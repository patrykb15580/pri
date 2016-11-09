$(document).ready(function() {
    $('.close-notice').on("click", function () {
	    $(this).parent('#notice').fadeOut();
	});
});