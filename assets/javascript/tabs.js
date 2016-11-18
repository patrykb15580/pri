$(document).ready(function(){
	$("#tab-1-content").show();
    $("#tab-2-content").hide();
    $(".tab1").click(function(){

	   	$(".tab1").removeClass("tab-active");
	   	$(".tab1").removeClass("tab-inactive");
	   	$(".tab1").addClass("tab-active");

	   	$(".tab2").removeClass("tab-active");
	   	$(".tab2").removeClass("tab-inactive");
	   	$(".tab2").addClass("tab-inactive");

	  	$("#tab-1-content").show();
	    $("#tab-2-content").hide();
	});
	$(".tab2").click(function(){
	   	$(".tab1").removeClass("tab-active");
	   	$(".tab1").removeClass("tab-inactive");
	   	$(".tab1").addClass("tab-inactive");
	   	
	   	$(".tab2").removeClass("tab-active");
	   	$(".tab2").removeClass("tab-inactive");
	   	$(".tab2").addClass("tab-active");

	    $("#tab-2-content").show();
	    $("#tab-1-content").hide();
	});
});