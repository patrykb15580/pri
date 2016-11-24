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

	  	$("#tab-2-content").fadeOut(function(){
	  		$("#tab-1-content").fadeIn();
	  	});
	});
	$(".tab2").click(function(){
	   	$(".tab1").removeClass("tab-active");
	   	$(".tab1").removeClass("tab-inactive");
	   	$(".tab1").addClass("tab-inactive");
	   	
	   	$(".tab2").removeClass("tab-active");
	   	$(".tab2").removeClass("tab-inactive");
	   	$(".tab2").addClass("tab-active");

	    $("#tab-1-content").fadeOut(function(){
	    	$("#tab-2-content").fadeIn();
	    });
	});

	$(".l2-tab-2-content").hide();
    $(".l2-tab-3-content").hide();
    $(".l2-tab-1-content").show();
    $(".l2-tab-1").click(function(){
	   	$(".l2-tab-1").removeClass("l2-tab-active");
	   	$(".l2-tab-1").removeClass("l2-tab-inactive");
	   	$(".l2-tab-1").addClass("l2-tab-active");

	   	$(".l2-tab-2").removeClass("l2-tab-active");
	   	$(".l2-tab-2").removeClass("l2-tab-inactive");
	   	$(".l2-tab-2").addClass("l2-tab-inactive");

	   	$(".l2-tab-3").removeClass("l2-tab-active");
	   	$(".l2-tab-3").removeClass("l2-tab-inactive");
	   	$(".l2-tab-3").addClass("l2-tab-inactive");

	   	$(".l2-tab-2-content").hide();
	   	$(".l2-tab-3-content").hide();
	  	$(".l2-tab-1-content").show();
	});
	$(".l2-tab-2").click(function(){
	   	$(".l2-tab-1").removeClass("l2-tab-active");
	   	$(".l2-tab-1").removeClass("l2-tab-inactive");
	   	$(".l2-tab-1").addClass("l2-tab-inactive");
	   	
	   	$(".l2-tab-2").removeClass("l2-tab-active");
	   	$(".l2-tab-2").removeClass("l2-tab-inactive");
	   	$(".l2-tab-2").addClass("l2-tab-active");

	   	$(".l2-tab-3").removeClass("l2-tab-active");
	   	$(".l2-tab-3").removeClass("l2-tab-inactive");
	   	$(".l2-tab-3").addClass("l2-tab-inactive");

	    $(".l2-tab-1-content").hide();
	    $(".l2-tab-3-content").hide();
	    $(".l2-tab-2-content").show();
	});
	$(".l2-tab-3").click(function(){
	   	$(".l2-tab-1").removeClass("l2-tab-active");
	   	$(".l2-tab-1").removeClass("l2-tab-inactive");
	   	$(".l2-tab-1").addClass("l2-tab-inactive");
	   	
	   	$(".l2-tab-2").removeClass("l2-tab-active");
	   	$(".l2-tab-2").removeClass("l2-tab-inactive");
	   	$(".l2-tab-2").addClass("l2-tab-inactive");

	   	$(".l2-tab-3").removeClass("l2-tab-active");
	   	$(".l2-tab-3").removeClass("l2-tab-inactive");
	   	$(".l2-tab-3").addClass("l2-tab-active");

	    $(".l2-tab-1-content").hide();
	    $(".l2-tab-2-content").hide();
	    $(".l2-tab-3-content").show();
	});
});