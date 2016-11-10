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
		<div class="modal-content">
			
		</div>
	</div>
</div>
<script type="text/javascript" src="/assets/javascript/rewardDetailsModal.js"></script>