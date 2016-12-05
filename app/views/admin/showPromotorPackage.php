<?php
	$router = Config::get('router');
	$action = $package->action();
?>	
<div id="title-box">
	<i class="fa fa-product-hunt title-box-icon green-icon" aria-hidden="true"></i><p class="title-box-text"><?= $action->name ?></p>

	<br /><br />
	<p class="title-box-details">
		Status: <?= CodesPackage::STATUSES[$package->status] ?><br />
		Liczba kodów: <?= $package->generated ?><br />
		Wartość kodów: <?= $package->codes_value ?> pkt<br />
		Wykorzystane kody: <?= count($package->usedCodes()) ?>
	</p>
</div>
<?php
	include 'app/views/admin/_promotion_codes.php';
?>
