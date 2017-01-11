$("#home-page-menu .scroll").click(function (){
	var bar = $(this).data('bar');

  if ($(window).scrollTop() > 0) {
  	$('html, body').animate({
	    scrollTop: $('.' + bar).offset().top - 38
	  }, 2000);
  } else {
   	$('html, body').animate({
	    scrollTop: $('.' + bar).offset().top - 80
    }, 2000);
  }
});