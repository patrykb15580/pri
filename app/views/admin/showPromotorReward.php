<?php
	$router = Config::get('router');
?>	
<div id="title-box">
	<i class="fa fa-gift title-box-icon red-icon" aria-hidden="true"></i><p class="title-box-text"><?= $reward->name ?></p>

	<br /><br />
	<p class="title-box-details">	
		Status: <?= PromotionAction::STATUSES[$reward->status] ?>
		<br />Cena: <?= $reward->prize ?> pkt
		<br /><br /><?= nl2br($reward->description) ?>
	</p>
</div>

<div id="reward_images_container">
<?php foreach ($reward->images() as $image) { 
	$img_path = "/system/".StringUntils::camelCaseToUnderscore(get_class($image))."s/".$image->id.'/small/'.$image->file_name; ?>
	<div class="reward_image_box">
		<img class="reward_image" src="<?= $img_path ?>" data-imageid="<?= $image->id ?>" data-filename="<?= $image->file_name ?>">
	</div>
<?php } ?>
</div>

<div class="modal-bg">
	<img class="modal-image" src="">
</div>
<script type="text/javascript" src="/assets/javascript/rewardImageModal.js"></script>