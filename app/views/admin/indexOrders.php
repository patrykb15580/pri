<?php
	$router = Config::get('router');
?>	
<div id="title-box">
	<i class="fa fa-shopping-basket title-box-icon dark-green-icon" aria-hidden="true"></i><p class="title-box-text">Zamówienia</p>
</div>
<?php 
	include 'app/views/admin/_admin_orders.php';
?>

	