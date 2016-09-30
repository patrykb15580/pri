<?php
	$router = Config::get('router');
	$path_new = $router->generate('new_rewards', ['promotors_id' => $params['promotors_id']]);
	
	#echo "<pre>";
	#die(print_r($active_actions));
?>	
<h1>Klienci</h1>
<div id="show_title_box"></div>
<?php 
	#echo "<pre>";
	#die(print_r($rewards));
	include 'app/views/promotors/_clients.php';
?>

	