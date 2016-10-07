<?php
	$router = Config::get('router');
	#echo "<pre>";
	#die(print_r($params));
?>	
<h2 id="show_top_title">
	<a href="<?= $router->generate('show_promotor', ['promotor_id' => $params['promotor_id']]) ?>" id="link_underline">
		<?= $package->promotionAction()->promotor()->name ?>
	</a> > 
	<a href="<?= $router->generate('show_promotor', ['promotor_id' => $params['promotor_id']]).'?show=actions' ?>" id="link_underline">
		Akcje promocyjne
	</a> > 
	<a href="<?= $router->generate('show_promotor_action', ['promotor_id' => $params['promotor_id'], 'action_id' => $params['action_id']]) ?>" id="link_underline">
		<?= $package->promotionAction()->name ?>
	</a> > <?= $package->name ?>
</h2>
<br /><br />
Status: <?= PromotionCodesPackage::STATUSES[$package->status] ?><br />
Liczba kodów: <?= $package->generated ?><br />
Wartość kodów: <?= $package->codes_value ?> pkt<br />
Wykorzystane kody: <?= count($package->usedCodes()) ?>
<br /><br />
<?php
	#echo "<pre>";
	#die(print_r($packages));
	include 'app/views/admin/_promotion_codes.php';
?>
