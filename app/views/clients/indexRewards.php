<?php
	$router = Config::get('router');
	
	#echo "<pre>";
	#die(print_r($active_actions));
?>	
<div id="show_title_box">Nagrody promotora <?= $promotor->name ?></div>
<h3>Aktywne</h3>
<?php 
	$rewards = $promotor->activeRewards();
	#echo "<pre>";
	#die(print_r($rewards));
	include 'app/views/clients/_rewards.php';
?>
	