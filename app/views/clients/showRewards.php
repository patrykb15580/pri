<?php
	$router = Config::get('router');
	$path_get = $router->generate('new_order', ['client_id' => $this->params['client_id'], 'reward_id' => $this->params['reward_id']]);
	$images = RewardImage::where('reward_id=?', ['reward_id'=>$reward->id]);
?>	
<?php 
	if (!empty($images)) { 
		$big_img_path = "/system/reward_images/".$images[0]->id.'/big/'.$images[0]->file_name; ?>
		<img class="reward-details-image" src="<?= $big_img_path ?>">
		<br />
		<div class="reward-details-images-box">
		<?php 
		$i = 0;
		foreach ($images as $image) { 
			$i++;
			$very_small_img_path = "/system/reward_images/".$image->id.'/very_small/'.$image->file_name;?>
			<img class="reward-details-images" src="<?= $very_small_img_path ?>" data-imageid="<?= $image->id ?>" data-filename="<?= $image->file_name ?>" data-imagenumber="<?= $i ?>">
		<?php } ?>
		</div>
	<?php } else { ?>
		<div class="reward-details-image"><i class="fa fa-picture-o"></i></div>
	<?php }
?>
<p class="reward-details-name"><?= $reward->name ?></p>
<p class="reward-details-price"><?= $reward->prize ?> pkt</p>
<p class="reward-details-description"><?= nl2br($reward->description) ?></p>
<br /><br />
<a href="<?= $path_get ?>"><button class="reward-details-button">Przejdź do zamówienia</button></a>