<?php
	$router = Config::get('router');
	$path_new = $router->generate('new_promotion_codes_packages', ['promotors_id' => $params['promotors_id'], 'action_id' => $params['id']]);
	$path_update = $router->generate('edit_promotion_actions', ['promotors_id' => $params['promotors_id'], 'id' => $params['id']]);
	#echo "<pre>";
	#die(print_r($params));
?>	
<h1 id="show_top_title">Akcje promocyjne > <?= $promotion_action->name ?></h1>
<div id="show_top_options">
	<a href="<?= $path_update ?>">Edytuj</a>
	<a href="">Usuń</a>
</div>
<br /><a href="<?= $path_new ?>"><button id="add_new">Nowy pakiet kodów</button></a>
<br /><br />
<h3>Aktywne</h3>
<?php
	$packages = $active_packages;
	#echo "<pre>";
	#die(print_r($packages));
	include 'app/views/promotion_actions/_promotion_codes_packages.php';
?>

<h3>Nieaktywne</h3>
<?php
	$packages = $inactive_packages;
	#echo "<pre>";
	#die(print_r($packages));
	include 'app/views/promotion_actions/_promotion_codes_packages.php';
?>