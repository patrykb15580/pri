<table width="100%">
	<tr>
		<td id="first_row" width="10%"></td>
		<td id="first_row" width="60%">Nazwa nagrody</td>
		<td id="first_row" width="10%"></td>
		<td id="first_row" width="10%">Cena</td>
	</tr>
<?php foreach ($rewards as $reward) {			
	$path_show = $router->generate('show_rewards', ['promotors_id' => $params['promotors_id'], 'id' => $reward->id]);?>
	<tr class="result">
		<td width="10%">
			<?php 
			$images = RewardImage::where('reward_id=?', ['reward_id'=>$reward->id]);	
			if (!empty($images)) {
				$image = $images[0];
				$very_small_img_path = "/system/".StringUntils::camelCaseToUnderscore(get_class($image))."s/".$image->id.'/very_small/'.$image->file_name;?>
				<img class="index_rewards_image" src="<?= $very_small_img_path ?>">
			<?php } ?> 
		</td>
		<td width="60%"><a href="<?= $path_show ?>"><b><?= $reward->name ?></b></a></td>
		<td width="10%"></td>
		<td width="10%"><?= $reward->prize ?> pkt</td>
	</tr>
<?php } ?>	
</table>

