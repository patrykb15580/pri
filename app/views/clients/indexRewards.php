<!--
<div id="notice">
	<p id="notice-text"><i class="fa fa-info-circle" aria-hidden="true"></i> W tym panelu możesz ...</p>
	<button type="button" class="close-notice" data-dismiss="alert" aria-hidden="true">
		<i class="fa fa-times" aria-hidden="true"></i>
	</button>
</div>
-->

<div class="client-view-title-box">
	<?php 
		$avatar = $promotor->avatar();
		if (empty($avatar)) { ?>
			<div class="client-view-title-avatar"></div>
		<?php } else { ?>
			<img class="client-view-title-avatar" src="/system/promotor_avatars/<?= $promotor->id ?>/small/<?= $avatar->file_name ?>">
		<?php }
	?>
	<div class="client-view-avatar-box">
		<p><?= $promotor->name ?></p>
		<br />Katalog nagród
	</div>
</div>
<div class="client-view-reward-container">
	<?php 
		$rewards = $promotor->activeRewards();

		if (count($rewards) == 0) {
			include 'app/views/layouts/_no_results.php';
		} else include 'app/views/clients/_rewards.php';
	?>
</div>

<div class="modal-bg">
	<div class="modal-box">
		<div class="modal-content">
				
		</div>
	</div>
</div>

<script type="text/javascript" src="/assets/javascript/rewardDetailsModal.js"></script>
<script type="text/javascript" src="/assets/javascript/modalImages.js"></script>
<script type="text/javascript" src="/assets/javascript/blueBg.js"></script>