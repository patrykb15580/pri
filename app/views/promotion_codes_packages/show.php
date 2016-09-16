<?php
	$router = Config::get('router');
	$path_new = $router->generate('new_promotion_codes_packages', ['promotors_id' => $params['promotors_id'], 'id' => $params['id']]);
	$path_update = $router->generate('edit_promotion_codes_packages', ['promotors_id' => $params['promotors_id'], 'action_id' => $params['id']]);
	#echo "<pre>";
	#die(print_r($params));
?>	
<h1 id="show_top_title">Akcje promocyjne > <?= $action_name ?> > <?= $package->name ?></h1>
<div id="show_top_options">
	<a href="<?= $path_update ?>">Edytuj</a>
	<a href="">Usuń</a>
</div>
<br /><br />
Liczba kodów: <?= $package->generated ?>
<br /><br />
<?php
	#echo "<pre>";
	#die(print_r($packages));
	include 'app/views/promotion_codes_packages/_promotion_codes.php';
?>
