<?php
	$router = Config::get('router');
	$path_new = $router->generate('new_promotion_actions', ['promotors_id' => $params['promotors_id']]);
?>	
<div id="show_title_box">Akcje promocyjne promotora <?= $promotor->name ?>
<a href="<?= $path_new ?>"><button id="add_new">Nowa akcja promocyjna</button></a></div>
<h3>Aktywne</h3>
<?php 
	$promotion_actions = $promotor->activeActions();
	include 'app/views/promotors/_promotion_actions.php';
?>
<h3>Nieaktywne</h3>
<?php 
	$promotion_actions = $promotor->inactiveActions();
	include 'app/views/promotors/_promotion_actions.php';
?>

	