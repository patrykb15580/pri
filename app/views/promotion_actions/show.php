<?php
	$router = Config::get('router');
	$path_actions = $router->generate('show_promotors', ['promotors_id' => $params['promotors_id']]);
	$path_new = $router->generate('new_promotion_codes_packages', ['promotors_id' => $params['promotors_id'], 'action_id' => $params['id']]);
	$path_update = $router->generate('edit_promotion_actions', ['promotors_id' => $params['promotors_id'], 'id' => $params['id']]);
	$prev_page = $router->generate('show_promotors', ['promotors_id' => $params['promotors_id']]);
	
	$items_number = count($promotion_action->promotionCodesPackages());
?>	
<div id="notice">
	<p id="notice-text"><i class="fa fa-info-circle" aria-hidden="true"></i> W tym panelu możesz ...</p>
	<button type="button" class="close-notice" data-dismiss="alert" aria-hidden="true">
		<i class="fa fa-times" aria-hidden="true"></i>
	</button>
</div>

<div id="title-box">
	<a href="<?= $prev_page ?>"><button class="prev-page-button"><i class="fa fa-chevron-left" aria-hidden="true"></i> Wstecz</button></a>
	
	<i class="fa fa-product-hunt title-box-icon green-icon" aria-hidden="true"></i>
	<p class="title-box-text"><?= $promotion_action->name ?></p>
	<a href="<?= $path_new ?>"><button class="title-box-button"><i class="zmdi zmdi-plus"></i> Nowy pakiet kodów</button></a>
	<br /><br />
	<p class="title-box-details">
		Status: <b><?= PromotionAction::STATUSES[$promotion_action->status] ?></b><br />
		Czas trwania: <b><?php if ($promotion_action->indefinitely == 0) {echo "od ".$promotion_action->from_at." do ".$promotion_action->to_at;} else echo "bezterminowo"; ?></b><br /><br />
		<?= $promotion_action->description ?>
	</p>
	<div class="title-box-options">
		<a href="<?= $path_update ?>">Edytuj</a>
	</div>
</div>
<div id="title-box-tabs">
	<p class="tab1 tab-active">AKTYWNE</p><p class="tab2 tab-inactive">NIEAKTYWNE</p>
</div>

<div id="tab-1-content">
   	<?php 
		$packages = $promotion_action->activePackages();

		if (count($packages) == 0 && $items_number !== 0) {
			include 'app/views/layouts/_no_results.php';
		} else if ($items_number == 0) {
			include 'app/views/promotion_actions/_make_first.php';
		} else include 'app/views/promotion_actions/_promotion_codes_packages.php';
	?>
</div>
<div id="tab-2-content">
   	<?php 
		$packages = $promotion_action->inactivePackages();
		
		if (count($packages) == 0 && $items_number !== 0) {
			include 'app/views/layouts/_no_results.php';
		} else if ($items_number == 0) {
			include 'app/views/promotion_actions/_make_first.php';
		} else include 'app/views/promotion_actions/_promotion_codes_packages.php';
	?>
</div>