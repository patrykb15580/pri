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
	<i class="fa fa-shopping-basket fa-2x dark-green-icon" aria-hidden="true"></i><p class="title-box-text"> Zamówienia</p>
</div>

<?php 
	include 'app/views/promotors/_orders.php';
?>
