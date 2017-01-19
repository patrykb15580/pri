<table width="100%">
	<tr>
		<td class="first-row" width="106px"></td>
		<td class="first-row" width="60%">Nazwa nagrody</td>
		<td class="first-row" width="auto">Cena</td>
	</tr>
<?php foreach ($rewards as $reward) {			
	$path_show = $router->generate('show_rewards', ['promotors_id' => $params['promotors_id'], 'id' => $reward->id]);?>
	<tr class="result">
		<td width="106px">
			<?php 
			$images = RewardImage::where('reward_id=?', ['reward_id'=>$reward->id]);	
			if (!empty($images)) {
				$image = $images[0];
				$img_path = "/system/".StringUntils::camelCaseToUnderscore(get_class($image))."s/".$image->id.'/very_small/'.$image->file_name;
			} else {
				$img_path = '/assets/image/image-placeholder.png';
			}?> 
			<img class="index_rewards_image" src="<?= $img_path ?>">
		</td>
		<td width="60%"><a href="<?= $path_show ?>"><b><?= $reward->name ?></b></a></td>
		<td width="auto"><?= $reward->prize ?> pkt</td>
	</tr>
<?php } ?>	
</table>

