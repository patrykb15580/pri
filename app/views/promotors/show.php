<?php
	$router = Config::get('router');
	$path_new = $router->generate('new_promotion_actions', ['promotors_id' => $params['promotors_id']]);
	
	#echo "<pre>";
	#die(print_r($active_actions));
?>	
<div id="promotors_show_title_box">Akcje promocyjne promotora <?= $promotor->name ?>
<a href="<?= $path_new ?>"><button id="add_new">Nowa akcja promocyjna</button></a></div>
<h3>Aktywne</h3>
<?php 
	$promotion_actions = $active_actions;
	#die(print_r($active));
	#die(print_r($path_update));
	include 'app/views/promotors/_promotion_actions.php';
?>
<h3>Nieaktywne</h3>
<?php 
	$promotion_actions = $inactive_actions;
	#die(print_r($active));
	#die(print_r($path_update));
	include 'app/views/promotors/_promotion_actions.php';
?>

	