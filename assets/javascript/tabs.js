$(document).ready( function() {
	$('#tab-2-content').hide();
	$('#tab-3-content').hide();
	$('#select-tab').bind('change', function (e) { 
		if($('#select-tab').val() == 'tab-1') {
	      	$('#tab-2-content').fadeOut(function(){
	      		$('#tab-3-content').fadeOut(function(){
		      		$('#tab-1-content').fadeIn();
		 		});
	    	});
	    }
	    else if($('#select-tab').val() == 'tab-2'){
	    	$('#tab-1-content').fadeOut(function(){
	     		$('#tab-3-content').fadeOut(function(){
		    		$('#tab-2-content').fadeIn();
		    	});
	    	});
	    }
	    else {
	    	$('#tab-1-content').fadeOut(function(){
	     		$('#tab-2-content').fadeOut(function(){
		    		$('#tab-3-content').fadeIn();
				});
	    	});
		}        
	});


	
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

	/* Admin tabs */
	$('#admin-tab-2-content').hide();
	$('#admin-tab-3-content').hide();
	$('#admin-tab-4-content').hide();
	$('#admin-tab-5-content').hide();
	$('#admin-tab-6-content').hide();
	$('#admin-select-tabs').bind('change', function (e) { 
		if($('#admin-select-tabs').val() == 'tab-1') {
	      	$('#admin-tab-2-content').fadeOut(function(){
	      		$('#admin-tab-3-content').fadeOut(function(){
		      		$('#admin-tab-4-content').fadeOut(function(){
			      		$('#admin-tab-5-content').fadeOut(function(){
				      		$('#admin-tab-6-content').fadeOut(function(){
					      		$('#admin-tab-1-content').fadeIn();
					 		});
				 		});
			 		});
		 		});
	    	});
	    }
	    else if($('#admin-select-tabs').val() == 'tab-2') {
	      	$('#admin-tab-1-content').fadeOut(function(){
	      		$('#admin-tab-3-content').fadeOut(function(){
		      		$('#admin-tab-4-content').fadeOut(function(){
			      		$('#admin-tab-5-content').fadeOut(function(){
				      		$('#admin-tab-6-content').fadeOut(function(){
					      		$('#admin-tab-2-content').fadeIn();
					 		});
				 		});
			 		});
		 		});
	    	});
	    }
	    else if($('#admin-select-tabs').val() == 'tab-3') {
	      	$('#admin-tab-1-content').fadeOut(function(){
	      		$('#admin-tab-2-content').fadeOut(function(){
		      		$('#admin-tab-4-content').fadeOut(function(){
			      		$('#admin-tab-5-content').fadeOut(function(){
				      		$('#admin-tab-6-content').fadeOut(function(){
					      		$('#admin-tab-3-content').fadeIn();
					 		});
				 		});
			 		});
		 		});
	    	});
	    }
	    else if($('#admin-select-tabs').val() == 'tab-4') {
	      	$('#admin-tab-1-content').fadeOut(function(){
	      		$('#admin-tab-2-content').fadeOut(function(){
		      		$('#admin-tab-3-content').fadeOut(function(){
			      		$('#admin-tab-5-content').fadeOut(function(){
				      		$('#admin-tab-6-content').fadeOut(function(){
					      		$('#admin-tab-4-content').fadeIn();
					 		});
				 		});
			 		});
		 		});
	    	});
	    }
	    else if($('#admin-select-tabs').val() == 'tab-5') {
	      	$('#admin-tab-1-content').fadeOut(function(){
	      		$('#admin-tab-2-content').fadeOut(function(){
		      		$('#admin-tab-3-content').fadeOut(function(){
			      		$('#admin-tab-4-content').fadeOut(function(){
				      		$('#admin-tab-6-content').fadeOut(function(){
					      		$('#admin-tab-5-content').fadeIn();
					 		});
				 		});
			 		});
		 		});
	    	});
	    }
	    else if($('#admin-select-tabs').val() == 'tab-6') {
	      	$('#admin-tab-1-content').fadeOut(function(){
	      		$('#admin-tab-2-content').fadeOut(function(){
		      		$('#admin-tab-3-content').fadeOut(function(){
			      		$('#admin-tab-4-content').fadeOut(function(){
				      		$('#admin-tab-5-content').fadeOut(function(){
					      		$('#admin-tab-6-content').fadeIn();
					 		});
				 		});
			 		});
		 		});
	    	});
	    }
	});
});