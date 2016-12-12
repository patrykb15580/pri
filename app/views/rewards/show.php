<?php
	$router = Config::get('router');
	$path_update = $router->generate('edit_rewards', ['promotors_id' => $params['promotors_id'], 'id' => $params['id']]);
	$path_delete = $router->generate('delete_rewards', ['promotors_id' => $params['promotors_id'], 'id' => $params['id']]);
	$prev_page = $router->generate('index_rewards', ['promotors_id' => $params['promotors_id']]);;
	#echo "<pre>";
	#die(print_r($params));

	if (isset($params['notice'])) { ?>
		<div id="notice">
			<p id="notice-text"><i class="fa fa-info-circle" aria-hidden="true"></i> W tym panelu możesz ...</p>
			<button type="button" class="close-notice" data-dismiss="alert" aria-hidden="true">
				<i class="fa fa-times" aria-hidden="true"></i>
			</button>
		</div>
	<?php }
?>	
<div id="title-box">
	<a href="<?= $prev_page ?>"><button class="prev-page-button"><i class="fa fa-chevron-left" aria-hidden="true"></i> Wstecz</button></a>
	
	<i class="fa fa-gift title-box-icon red-icon" aria-hidden="true"></i>
	<p class="title-box-text"><?= $reward->name ?></p>
	<br /><br />
	<p class="title-box-details">
		<?php
			if (!empty($reward->description)) { ?>
				<?= nl2br($reward->description) ?><br /><br />
			<?php }
		?>
		Status: <b><?= Reward::STATUSES[$reward->status] ?></b>, Cena: <b><?= $reward->prize ?> pkt</b>
	</p>
</div>
<div id="title-box-options-bar">
	<a href="<?= $path_update ?>"><button class="options-bar-button">Edycja</button></a>
	<a href="<?= $path_delete ?>"><button class="options-bar-button">Usuń</button></a>
</div>

<div id="reward_images_container">
<?php foreach ($images as $image) { 
	$img_path = "/system/".StringUntils::camelCaseToUnderscore(get_class($image))."s/".$image->id.'/small/'.$image->file_name;
	$delete_path = $router->generate('delete_reward_images', ['promotors_id' => $params['promotors_id'], 'reward_id' => $params['id'], 'id' => $image->id]);?>
	<form class="reward_image_box" method="POST" action="<?= $delete_path ?>">
		<img class="reward_image" src="<?= $img_path ?>" data-imageid="<?= $image->id ?>" data-filename="<?= $image->file_name ?>">
		<input type="hidden" name="method" value="DELETE">
		<input class="delete_image" type="submit" value="x">
	</form>
<?php } ?>
</div>

<div class="modal-bg">
	<img class="modal-image" src="">
</div>
<script type="text/javascript" src="/assets/javascript/rewardImageModal.js"></script>
