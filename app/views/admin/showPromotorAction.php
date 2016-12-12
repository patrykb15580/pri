<?php
	$router = Config::get('router');
	$promotion_action = $action->promotionAction();
?>	
<div id="title-box">
	<i class="fa fa-product-hunt title-box-icon green-icon" aria-hidden="true"></i><p class="title-box-text"><?= $action->name ?></p>

	<br /><br />
	<p class="title-box-details">
		Status: <?= PromotionAction::STATUSES[$action->status] ?>
		<br />Czas trwania: <?php if ($promotion_action->indefinitely == 0) {echo "od ".$promotion_action->from_at." do ".$promotion_action->to_at;} else echo "bezterminowo"; ?>
	</p>
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

<div id="tab-1-content" class="tab-content">
<?php
	$packages = $action->activePackages();
	include 'app/views/admin/_promotion_codes_packages.php';
?>
</div>

<div id="tab-2-content" class="tab-content">
<?php
	$packages = $action->inactivePackages();
	include 'app/views/admin/_promotion_codes_packages.php';
?>
</div>

<div id="tab-3-content" class="tab-content">
<?php
	$packages = $action->codesPackages();
	include 'app/views/admin/_promotion_codes_packages.php';
?>
</div>