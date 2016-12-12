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

<select id="select-tab">
	<option value="tab-1">Wykorzystane</option>
	<option value="tab-2">Niewykorzystane</option>
	<option value="tab-3">Wszystkie</option>
</select>

<div id="tab-1-content" class="tab-content">
	<?php
		$promotion_codes = $package->usedPromotionCodes();
		
		if (count($promotion_codes) == 0) {
			include 'app/views/layouts/_no_results.php';
		} else {
			include 'app/views/admin/_promotion_codes.php';
		}
	?>
</div>
<div id="tab-2-content" class="tab-content">
	<?php
		$promotion_codes = $package->nonUsedPromotionCodes();

		if (count($promotion_codes) == 0) {
			include 'app/views/layouts/_no_results.php';
		} else {
			include 'app/views/admin/_promotion_codes.php';
		}
	?>
</div>
<div id="tab-3-content" class="tab-content">
	<?php
		$promotion_codes = $package->promotionCodes();
		
		if (count($promotion_codes) == 0) {
			include 'app/views/layouts/_no_results.php';
		} else {
			include 'app/views/admin/_promotion_codes.php';
		}
	?>
</div>