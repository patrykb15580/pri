$(document).ready(function(){
	$('.modal-bg').hide()
	$('.get-random-answer').click(function(){
		contest_id = $('.get-random-answer').data('contestid');
		$.ajax({
		    url: "/get-random-answer",
		    type: 'POST',
		    data: { "contest_id": contest_id },
		    success: function(data){
		      $('.random-answer').html(data);
		    },
		    error: function(data) {
		      alert("nope");
		    }
		});
		$('.modal-bg').fadeIn();
	});
	$(document).mouseup(function (e){
	    if (!$(".random-answer").is(e.target) && $(".random-answer").has(e.target).length === 0) {
	        $(".modal-bg").fadeOut();
	    }
	});
});