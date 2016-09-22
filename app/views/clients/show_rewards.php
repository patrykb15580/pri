<?php
	$router = Config::get('router');
	$path_update = $router->generate('edit_rewards', ['promotors_id' => $params['promotors_id'], 'reward_id' => $params['reward_id']]);
	$path_delete = $router->generate('delete_rewards', ['promotors_id' => $params['promotors_id'], 'reward_id' => $params['reward_id']]);
	#echo "<pre>";
	#die(print_r($images));
?>	
<h1 id="show_top_title">Katalog nagród > <?= $reward->name ?></h1>
<div id="show_top_options">
	<button>Przejdź do zamówienia</button>
</div>
<hr>
Cena: <?= $reward->prize ?> pkt
<br />Status: <?= PromotionAction::STATUSES[$reward->status] ?>
<br /><br /><div id="reward_description"><?= nl2br($reward->description) ?></div>
<br />
<div id="reward_images_container">
<?php foreach ($images as $image) { 
	$small_img_path = "/system/".StringUntils::camelCaseToUnderscore(get_class($image))."s/".$image->id.'/small/'.$image->file_name;?>
	<div id="reward_image_box">
		<img id="reward_image" src="<?= $small_img_path ?>">
		<br />
	</div>
<?php } ?>
</div>
