$(document).ready(function(){
	$('.user-options').hide();

    $(".user").click(function(){
        $(".user-options").not(":visible").fadeIn();
    });
    $(".avatar").click(function(){
        $(".user-options").not(":visible").fadeIn();
    });
    $(document).mouseup(function (e){
	    if (!$(".user-options").is(e.target) && $(".user-options").has(e.target).length === 0) {
	        $(".user-options").fadeOut();
	    }
    });
});