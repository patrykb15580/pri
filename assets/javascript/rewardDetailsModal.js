$(document).ready(function(){
	var client_id;
	var reward_id;
	$('.show-details').click(function(){
		client_id = $('.client-view-reward-box').data('clientid');
		reward_id = $(this).data('rewardid');
		$.ajax({
	      url: "/reward-details",
	      type: 'POST',
	      data: { "client_id": client_id, "reward_id": reward_id },
	      success: function(data){    
	        $('.modal-content').html(data);
	        $('.modal-bg').fadeIn();
	        $('.modal-box').fadeIn();
	      },
	      error: function(data) {
	        alert("nope");
	      }
	    });
	});

	$(document).mouseup(function (e){
	    if (!$(".modal-box").is(e.target) && $(".modal-box").has(e.target).length === 0) {
	        $(".modal-bg").fadeOut();
	        $(".modal-box").fadeOut();
	    }
	});
});	
