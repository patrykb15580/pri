$(document).ready(function(){
	var client_id;
	var reward_id;
	var view;
	$('.modal-bg').hide();
	$('.show-details').click(function(){
		client_id = $('#reward_box').data('clientid');
		reward_id = $(this).data('rewardid');
		$.ajax({
	      url: "/reward-details",
	      type: 'POST',
	      data: { "client_id": client_id, "reward_id": reward_id },
	      success: function(data){
		        
	        $('.modal-content').html(data);
	      },
	      error: function(data) {
	        alert("nope");
	      }
	    });
		$('.modal-bg').fadeIn();
	});
	$('.close-modal').click(function(){
		$('.modal-bg').fadeOut();
	});
	$(document).mouseup(function (e){
	    if (!$(".modal-box").is(e.target) && $(".modal-box").has(e.target).length === 0) {
	        $(".modal-bg").fadeOut();
	    }
	});
});	
