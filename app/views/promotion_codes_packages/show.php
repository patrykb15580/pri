<?php
	$router = Config::get('router');
	$path_new = $router->generate('new_promotion_codes_packages', ['promotors_id' => $params['promotors_id'], 'id' => $params['id']]);
	$path_update = $router->generate('edit_promotion_codes_packages', ['promotors_id' => $params['promotors_id'], 'action_id' => $params['id'], 'id' => $params['id']]);
	#echo "<pre>";
	#die(print_r($params));
?>	
<div id="notice">
	<p id="notice-text"><i class="fa fa-info-circle" aria-hidden="true"></i> W tym panelu możesz ...</p>
	<button type="button" class="close-notice" data-dismiss="alert" aria-hidden="true">
		<i class="fa fa-times" aria-hidden="true"></i>
	</button>
</div>

<div id="title-box">
	<i class="fa fa-product-hunt fa-2x green-icon" aria-hidden="true"></i>
	<p class="title-box-text">Akcje promocyjne > <?= $package->promotionAction()->name ?> > <?= $package->name ?></p>
	<a href="<?= $path_new ?>"><a href="<?= $path_new ?>"><button class="title-box-button">+ Nowa paczka kodów</button></a>
	<br />
	<br />
	<p class="title-box-details">
		Status: <b><?= PromotionCodesPackage::STATUSES[$package->status] ?></b><br />
		Liczba kodów: <b><?= $package->generated ?></b><br />
		Wartość kodów: <b><?= $package->codes_value ?> pkt</b><br />
		Wykorzystane kody: <b><?= count($package->usedCodes()) ?></b>
	</p>
	<div class="title-box-options">
		<a href="<?= $path_update ?>">Edytuj</a>
	</div>
	<br />
</div>
<?php
	#echo "<pre>";
	#die(print_r($packages));
	include 'app/views/promotion_codes_packages/_promotion_codes.php';
?>