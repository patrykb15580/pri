<?php
	$router = Config::get('router');
	$path_actions = $router->generate('show_promotors', ['promotors_id' => $params['promotors_id']]);
	$path_new = $router->generate('new_promotion_codes_packages', ['promotors_id' => $params['promotors_id'], 'action_id' => $params['id']]);
	$path_update = $router->generate('edit_promotion_actions', ['promotors_id' => $params['promotors_id'], 'id' => $params['id']]);
	$prev_page = $router->generate('show_promotors', ['promotors_id' => $params['promotors_id']]);

	$promotion_action = $action->promotionAction();

	$items_number = count($action->promotionCodesPackages());

	if (isset($params['notice'])) { ?>
		<div id="notice" data-cookie="show_promotion_action_view">
			<p id="notice-text"><i class="fa fa-info-circle" aria-hidden="true"></i> W tym panelu możesz ...</p>
			<button type="button" class="close-notice" data-dismiss="alert" aria-hidden="true">
				<i class="fa fa-times" aria-hidden="true"></i>
			</button>
		</div>
	<?php }
?>	

<div id="title-box">
	<a href="<?= $prev_page ?>"><button class="prev-page-button"><i class="fa fa-chevron-left" aria-hidden="true"></i> Wstecz</button></a>
	
	<i class="fa fa-product-hunt title-box-icon green-icon" aria-hidden="true"></i>
	<p class="title-box-text"><?= $action->name ?></p>
	
	<br /><br />
	<p class="title-box-details">
		<?php
			if (!empty($action->description)) { ?>
				<?= nl2br($action->description) ?><br /><br />
			<?php }
		?>
		Status: <b><?= Action::STATUSES[$action->status] ?></b>, Czas trwania: <b><?php if ($promotion_action->indefinitely == 0) {echo "od ".$promotion_action->from_at." do ".$promotion_action->to_at;} else echo "bezterminowo"; ?></b>
	</p>
</div>
<div id="title-box-options-bar">
<a href="<?= $path_new ?>"><button class="options-bar-button">Zamów pakiet kodów</button></a><a href="<?= $path_update ?>"><button class="options-bar-button">Edycja</button></a>
</div>

<select id="select-tab">
	<option value="tab-1">
		Aktywne
	</option>
	<option value="tab-2">
		Nieaktywne
	</option>
	<option value="tab-3">
		Wszystkie
	</option>
</select>
<br />
<div id="tab-1-content" class="tab-content">
   	<?php 
		$packages = $action->activePackages();

		if (count($packages) == 0 && $items_number !== 0) {
			include 'app/views/layouts/_no_results.php';
		} else if ($items_number == 0) {
			include 'app/views/promotion_actions/_make_first.php';
		} else include 'app/views/promotion_actions/_promotion_codes_packages.php';
	?>
</div>

<div id="tab-2-content" class="tab-content">
   	<?php 
		$packages = $action->inactivePackages();
		
		if (count($packages) == 0 && $items_number !== 0) {
			include 'app/views/layouts/_no_results.php';
		} else if ($items_number == 0) {
			include 'app/views/promotion_actions/_make_first.php';
		} else include 'app/views/promotion_actions/_promotion_codes_packages.php';
	?>
</div>

<div id="tab-3-content" class="tab-content">
   	<?php 
		$packages = $action->promotionCodesPackages();
		
		if ($items_number == 0) {
			include 'app/views/promotion_actions/_make_first.php';
		} else include 'app/views/promotion_actions/_promotion_codes_packages.php';
	?>
</div>