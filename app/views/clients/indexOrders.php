<?php
	$router = Config::get('router');
	
	#echo "<pre>";
	#die(print_r($params));
?>	
<div id="show_title_box">Twoje zamówienia</div>
<?php 
	include 'app/views/clients/_orders.php';
?>
