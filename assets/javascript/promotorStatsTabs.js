$(document).ready(function(){
	$(".clients-charts").show();
    $(".codes-charts").hide();
    $(".clients-stats-tab").click(function(){

	   	$(".clients-stats-tab").removeClass("tab-active");
	   	$(".clients-stats-tab").removeClass("tab-inactive");
	   	$(".clients-stats-tab").addClass("tab-active");

	   	$(".codes-stats-tab").removeClass("tab-active");
	   	$(".codes-stats-tab").removeClass("tab-inactive");
	   	$(".codes-stats-tab").addClass("tab-inactive");

	    $(".codes-charts").hide();
	    $(".clients-charts").show();
	});
	$(".codes-stats-tab").click(function(){

	   	$(".clients-stats-tab").removeClass("tab-inactive");
	   	$(".clients-stats-tab").removeClass("tab-active");
	   	$(".clients-stats-tab").addClass("tab-inactive");

	   	$(".codes-stats-tab").removeClass("tab-inactive");
	   	$(".codes-stats-tab").removeClass("tab-active");
	   	$(".codes-stats-tab").addClass("tab-active");

	    $(".clients-charts").hide();
	  	$(".codes-charts").show();	    
	});
});