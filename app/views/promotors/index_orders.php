<?php
	$router = Config::get('router');
	
	#echo "<pre>";
	#die(print_r($orders));
?>	
<div id="show_title_box">Zamówienia klientów</div>

<?php 
	include 'app/views/promotors/_orders.php';
?>
