<?php
	$router = Config::get('router');
	$path_update = $router->generate('edit_rewards', ['promotors_id' => $params['promotors_id'], 'id' => $params['id']]);
	$path_delete = $router->generate('delete_rewards', ['promotors_id' => $params['promotors_id'], 'id' => $params['id']]);
	#echo "<pre>";
	#die(print_r($params));
?>	
<h1 id="show_top_title">Katalog nagród > <?= $reward->name ?></h1>
<div id="show_top_options">
	<a href="<?= $path_update ?>">Edytuj</a>
	<a href="<?= $path_delete ?>">Usuń</a>
</div>
<hr>
Cena: <?= $reward->prize ?> pkt
<br />Status: <?= PromotionAction::STATUSES[$reward->status] ?>
<br /><br /><div id="reward_description"><?= nl2br($reward->description) ?></div>
<br />
<div id="reward_images_container">
<?php foreach ($images as $image) { 
	$img_path = "/system/".StringUntils::camelCaseToUnderscore(get_class($image))."s/".$image->id.'/small/'.$image->file_name;
	$delete_path = $router->generate('delete_reward_images', ['promotors_id' => $params['promotors_id'], 'reward_id' => $params['id'], 'id' => $image->id]);?>
	<div id="reward_image_box">
		<img id="reward_image" src="<?= $img_path ?>">
		<br />
		<form method="POST" action="<?= $delete_path ?>">
			<input type="hidden" name="method" value="DELETE">
			<input id="delete_image" type="submit" value="Usuń zdjęcie">
		</form>
	</div>
<?php } ?>
</div>
