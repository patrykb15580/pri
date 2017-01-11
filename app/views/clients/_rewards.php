<?php foreach ($rewards as $reward) {	
	$images = RewardImage::where('reward_id=?', ['reward_id'=>$reward->id]);	
	#$path_show = $router->generate('client_show_rewards', ['client_id' => $params['client_id'], 'promotors_id' => $params['promotors_id'], 'reward_id' => $reward->id]);?>
	<div class="client-view-reward-box" data-clientid="<?= $params['client_id'] ?>">
		<?php 
		if (!empty($images)) {
			$image = $images[0];
			$small_img_path = "/system/".StringUntils::camelCaseToUnderscore(get_class($image))."s/".$image->id.'/small/'.$image->file_name;?>

			<img class="reward-img" src="<?= $small_img_path ?>">
		<?php } else{ ?> 
			<div class="reward-img"><i class="fa fa-picture-o" aria-hidden="true"></i></div>
		<?php } ?>
		<div class="details">
			<p class="name"><?= $reward->name ?></p>
			<p class="description"><?= StringUntils::truncateAfterLines($reward->description, 4) ?></p>
		</div>
		<br />
		<button class="button show-details" data-rewardid="<?= $reward->id ?>">Zobacz nagrodę</button>
		<span class="prize"><?= $reward->prize ?> pkt</span>
	</div>
<?php } ?>