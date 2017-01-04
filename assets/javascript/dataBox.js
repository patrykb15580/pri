$('#data-box .details').hide();

$('#data-box i').click(function(){
	$(this).fadeOut(function(){
		$(this).toggleClass('fa-angle-down fa-angle-up').fadeIn();
	});
	$(this).parent().children('.details').fadeToggle();
});