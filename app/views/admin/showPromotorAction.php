<?php
	$router = Config::get('router');
	#echo "<pre>";
	#die(print_r($promotion_action));
?>	
<h2 id="show_top_title">
	<a href="<?= $router->generate('show_promotor', ['promotor_id' => $params['promotor_id']]) ?>" id="link_underline">
		<?= $promotion_action->promotor()->name ?>
	</a> > 
	<a href="<?= $router->generate('show_promotor', ['promotor_id' => $params['promotor_id']]).'?show=actions' ?>" id="link_underline">
		Akcje promocyjne
	</a> > <?= $promotion_action->name ?>
</h2>
<br /><br />
Status: <?= PromotionAction::STATUSES[$promotion_action->status] ?>
<br />Czas trwania: <?php if ($promotion_action->indefinitely == 0) {echo "od ".$promotion_action->from_at." do ".$promotion_action->to_at;}else echo "bezterminowo"; ?>
<h3>Aktywne</h3>
<?php
	$packages = $promotion_action->activePackages();
	include 'app/views/admin/_promotion_codes_packages.php';
?>

<h3>Nieaktywne</h3>
<?php
	$packages = $promotion_action->inactivePackages();
	include 'app/views/admin/_promotion_codes_packages.php';
?>