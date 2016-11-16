<?php
	$router = Config::get('router');
	
	#echo "<pre>";
	#die(print_r($orders));
?>	
<div id="notice">
	<p id="notice-text"><i class="fa fa-info-circle" aria-hidden="true"></i> W tym panelu możesz ...</p>
	<button type="button" class="close-notice" data-dismiss="alert" aria-hidden="true">
		<i class="fa fa-times" aria-hidden="true"></i>
	</button>
</div>

<div id="title-box">
	<i class="fa fa-shopping-basket title-box-icon dark-green-icon" aria-hidden="true"></i><p class="title-box-text"> Zamówienia</p>
</div>
<div id="title-box-tabs">
	<p class="tab1 tab-active">NIEZREALIZOWANE</p><p class="tab2 tab-inactive">ZREALIZOWANE</p>
</div>

<div id="active">
   	<?php 
		$orders = $promotor->activeOrders();
		
		if (count($orders) !== 0) {
			include 'app/views/promotors/_orders.php';
		} else include 'app/views/layouts/_no_results.php';
	?>
</div>
<div id="inactive">
   	<?php 
		$orders = $promotor->completedOrders();
		
		if (count($orders) !== 0) {
			include 'app/views/promotors/_orders.php';
		} else include 'app/views/layouts/_no_results.php';
	?>
</div>

