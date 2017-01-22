$(".scroll").click(function (){
	var bar = $(this).data('bar');

  if ($(window).width() < 1000) {
  	$('html, body').animate({
	    scrollTop: $('a[name=' + bar + '].anchor').offset().top - 40
	  }, 2000);
  } else {
   	$('html, body').animate({
	    scrollTop: $('a[name=' + bar + '].anchor').offset().top - 60
    }, 2000);
  }
});