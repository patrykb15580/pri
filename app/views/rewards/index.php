<?php
	$router = Config::get('router');
	$path_new = $router->generate('new_rewards', ['promotors_id' => $params['promotors_id']]);
	
	#echo "<pre>";
	#die(print_r($active_actions));
?>	
<div id="show_title_box">Nagrody promotora <?= $promotor->name ?>
<a href="<?= $path_new ?>"><button id="add_new">Nowa nagroda</button></a></div>
<h3>Aktywne</h3>
<?php 
	$rewards = $promotor->activeRewards();
	#echo "<pre>";
	#die(print_r($rewards));
	include 'app/views/rewards/_rewards.php';
?>
<br />
<h3>Nieaktywne</h3>
<?php 
	$rewards = $promotor->inactiveRewards();
	#echo "<pre>";
	#die(print_r($rewards));
	include 'app/views/rewards/_rewards.php';
?>
	