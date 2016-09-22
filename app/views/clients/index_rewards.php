<?php
	$router = Config::get('router');
	
	#echo "<pre>";
	#die(print_r($active_actions));
?>	
<div id="promotors_show_title_box">Nagrody promotora <?= $promotor->name ?></div>
<h3>Aktywne</h3>
<?php 
	$rewards = $active_rewards;
	#echo "<pre>";
	#die(print_r($rewards));
	include 'app/views/clients/_rewards.php';
?>
	