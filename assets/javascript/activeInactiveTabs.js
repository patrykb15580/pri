$(document).ready(function(){
	$("#active").show();
    $("#inactive").hide();
    $(".tab1").click(function(){

	   	$(".tab1").removeClass("tab-active");
	   	$(".tab1").removeClass("tab-inactive");
	   	$(".tab1").addClass("tab-active");

	   	$(".tab2").removeClass("tab-active");
	   	$(".tab2").removeClass("tab-inactive");
	   	$(".tab2").addClass("tab-inactive");

	  	$("#active").show();
	    $("#inactive").hide();
	});
	$(".tab2").click(function(){
	   	$(".tab1").removeClass("tab-active");
	   	$(".tab1").removeClass("tab-inactive");
	   	$(".tab1").addClass("tab-inactive");
	   	
	   	$(".tab2").removeClass("tab-active");
	   	$(".tab2").removeClass("tab-inactive");
	   	$(".tab2").addClass("tab-active");

	    $("#inactive").show();
	    $("#active").hide();
	});
});