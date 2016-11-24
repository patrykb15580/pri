<?php foreach ($rewards as $reward) {	
	$images = RewardImage::where('reward_id=?', ['reward_id'=>$reward->id]);	
	#$path_show = $router->generate('client_show_rewards', ['client_id' => $params['client_id'], 'promotors_id' => $params['promotors_id'], 'reward_id' => $reward->id]);?>
	<div class="client-view-reward-box" data-clientid="<?= $params['client_id'] ?>">
		<?php 
		if (!empty($images)) {
			$image = $images[0];
			$small_img_path = "/system/".StringUntils::camelCaseToUnderscore(get_class($image))."s/".$image->id.'/small/'.$image->file_name;?>

			<img class="client-view-reward-img" src="<?= $small_img_path ?>">
		<?php } else{ ?> 
			<div class="client-view-reward-img"></div>
		<?php } ?>
			<p class="client-view-reward-name"><?= $reward->name ?></p><p class="client-view-reward-prize"><?= $reward->prize ?> pkt</p><br />
			<p class="client-view-reward-description"><?= StringUntils::truncate($reward->description, 60) ?></p>
			<button id="center" class="client-view-reward-button show-details" data-rewardid="<?= $reward->id ?>">Przejdź do nagrody</button>
	</div>
<?php } ?>