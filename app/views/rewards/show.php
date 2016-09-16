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

<?php foreach ($images as $image) { ?>
	<img id="reward_image" src="<?= "system/".StringUntils::camelCaseToUnderscore(get_class($image))."s/".$image->file_name ?>">
<?php } ?>
