<?php
	$router = Config::get('router');
?>	
<div id="title_box">Nagrody promotora <?= $promotor->name ?></div>
<h3>Aktywne</h3>
<?php 
	$rewards = $promotor->activeRewards();
	include 'app/views/clients/_rewards.php';
?>
<div class="modal-bg">
	<div class="modal-box">
		<button class="close-modal">x</button>
		<div class="modal-content">
			
		</div>
	</div>
</div>
<script type="text/javascript">
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
	});	
</script>
