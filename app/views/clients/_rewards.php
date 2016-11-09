<?php foreach ($rewards as $reward) {	
	$images = RewardImage::where('reward_id=?', ['reward_id'=>$reward->id]);	
	#$path_show = $router->generate('client_show_rewards', ['client_id' => $params['client_id'], 'promotors_id' => $params['promotors_id'], 'reward_id' => $reward->id]);?>
	<div id="reward_box" data-clientid="<?= $params['client_id'] ?>">
		<b id="title"><?= $reward->name ?></b><br />
		<?php 
		if (!empty($images)) {
			$image = $images[0];
			$small_img_path = "/system/".StringUntils::camelCaseToUnderscore(get_class($image))."s/".$image->id.'/small/'.$image->file_name;?>

			<img id="client_show_rewards" src="<?= $small_img_path ?>"><br />
		<?php }else{ ?> 
			<div id="img_placeholder"></div>
		<?php } ?>
			Cena: <?= $reward->prize ?><br />
			Opis:<br />
			<?= StringUntils::truncate($reward->description, 60) ?>
			<button id="center" class="show-details" data-rewardid="<?= $reward->id ?>">Przejdź do nagrody</button>
	</div>
<?php } ?>
		
		
		
		
	