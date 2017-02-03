$('#start-menu').hide();

$('.toggle-start-menu').click(function(){
	$('#start-menu').fadeIn();
	$('.toggle-start-menu').fadeOut();
});
$('.hide-start-menu').click(function(){
	$('#start-menu').fadeOut();
	$('.toggle-start-menu').fadeIn();
});
$(document).mouseup(function (e){
    if (!$("#start-menu").is(e.target) && $("#start-menu").has(e.target).length === 0) {
        $("#start-menu").fadeOut();
        $('.toggle-start-menu').fadeIn();
    }
});