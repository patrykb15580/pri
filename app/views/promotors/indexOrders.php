<?php
	$router = Config::get('router');
	
	#echo "<pre>";
	#die(print_r($orders));

	if (isset($params['notice'])) { ?>
		<div id="notice" data-cookie="index_orders_promotor_view">
			<p id="notice-text"><i class="fa fa-info-circle" aria-hidden="true"></i> W tym panelu możesz ...</p>
			<button type="button" class="close-notice" data-dismiss="alert" aria-hidden="true">
				<i class="fa fa-times" aria-hidden="true"></i>
			</button>
		</div>
	<?php }
?>	

<div id="title-box">
	<i class="fa fa-shopping-basket title-box-icon dark-green-icon" aria-hidden="true"></i><p class="title-box-text"> Zamówienia</p>
</div>
<div id="title-box-tabs">
	<p class="tab tab1 tab-active" data-tab="tab-1">NIEZREALIZOWANE</p><p class="tab tab2 tab-inactive" data-tab="tab-2">ZREALIZOWANE</p>
</div>

<div id="tab-1-content" class="tab-content">
   	<?php 
		$orders = $promotor->activeOrders();
		
		if (count($orders) !== 0) {
			include 'app/views/promotors/_orders.php';
		} else include 'app/views/layouts/_no_results.php';
	?>
</div>
<div id="tab-2-content" class="tab-content">
   	<?php 
		$orders = $promotor->completedOrders();
		
		if (count($orders) !== 0) {
			include 'app/views/promotors/_orders.php';
		} else include 'app/views/layouts/_no_results.php';
	?>
</div>

