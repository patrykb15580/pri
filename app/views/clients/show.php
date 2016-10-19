<?php
	$router = Config::get('router');
?>	
<div id="show_title_box"><h1><?= $client->name ?></h1></div>

<?php 
	#echo "<pre>";
	#die(print_r($promotors));
	include 'app/views/clients/_promotion_actions.php';
?>


	