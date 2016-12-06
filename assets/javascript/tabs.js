$(document).ready( function() {
	$('#tab-1-content').show();
	$('#select-tab').bind('change', function (e) { 
		$.when($('.tab-content').fadeOut()).then(function(){
			$('#' + $('#select-tab').val() + '-content').fadeIn();
		});		
	});
    $(".tab").click(function(){
    	var tab = $(this).data('tab');
    	$(".tab-active").toggleClass("tab-active tab-inactive");
    	$(this).toggleClass("tab-inactive tab-active");
	  	$.when($(".tab-content").fadeOut()).then(function(){
	  		$("#" + tab + "-content").fadeIn();
	  	});
	});
    $(".l2-tab-1-content").show();
	$(".l2-tab").click(function(){
    	var tab = $(this).data('tab');
    	$(".l2-tab-active").toggleClass("l2-tab-active l2-tab-inactive");
    	$(this).toggleClass("l2-tab-inactive l2-tab-active");
	  	$.when($(".l2-tab-content").hide()).then(function(){
	  		$("." + tab + "-content").show();
	  	});
	});
});