$(".scroll").click(function (){
	var bar = $(this).data('bar');

  if ($(window).scrollTop() > 0) {
  	$('html, body').animate({
	    scrollTop: $('a[name=' + bar + '].anchor').offset().top - 60
	  }, 2000);
  } else {
   	$('html, body').animate({
	    scrollTop: $('a[name=' + bar + '].anchor').offset().top - 60
    }, 2000);
  }
});