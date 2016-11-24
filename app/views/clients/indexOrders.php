<?php
	$router = Config::get('router');
	
	#echo "<pre>";
	#die(print_r($params));
?>	
<div id="notice">
	<p id="notice-text"><i class="fa fa-info-circle" aria-hidden="true"></i> W tym panelu możesz ...</p>
	<button type="button" class="close-notice" data-dismiss="alert" aria-hidden="true">
		<i class="fa fa-times" aria-hidden="true"></i>
	</button>
</div>
<div class="client-view-title-box">
	<i class="fa fa-shopping-basket client-view-title-icon dark-green-icon" aria-hidden="true"></i><p class="client-view-title-text">Zamówienia</p>
</div>
<?php 
	$orders = $client->orders();

	if (count($orders) == 0) {
		include 'app/views/layouts/_no_results.php';
	} else include 'app/views/clients/_orders.php';
?>

<script type="text/javascript" src="/assets/javascript/blueBg.js"></script>
