<?php
	$router = Config::get('router');
	$path_update = $router->generate('edit_promotion_codes_packages', ['promotors_id' => $params['promotors_id'], 'action_id' => $params['id'], 'id' => $params['id']]);
	$prev_page = $router->generate('show_promotion_actions', ['promotors_id' => $params['promotors_id'], 'id' => $params['action_id']]);
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
	<a href="<?= $prev_page ?>"><button class="prev-page-button"><i class="fa fa-chevron-left" aria-hidden="true"></i> Wstecz</button></a>

	<i class="fa fa-product-hunt title-box-icon green-icon" aria-hidden="true"></i>
	<p class="title-box-text">Pakiet #<?= $package->id ?></p>
	<br />
	<br />
	<p class="title-box-details">
		Status: <b><?= CodesPackage::STATUSES[$package->status] ?></b><br />
		Liczba kodów: <b><?= $package->generated ?></b><br />
		Wartość kodów: <b><?= $package->codes_value ?> pkt</b>
		<?php
			if (!empty($package->description)) {
				echo "<br /><br />".$package->description;
			}
		?>
	</p>
	<br />
</div>
<div id="title-box-options-bar">
	<a href="<?= $path_update ?>"><button class="options-bar-button">Edytuj</button></a>
</div>

<select id="select-tab">
	<option value="tab-1">
		Wykorzystane (<?= count($package->usedPromotionCodes()) ?>)
	</option>
	<option value="tab-2">
		Niewykorzystane (<?= count($package->nonUsedPromotionCodes()) ?>)
	</option>
	<option value="tab-3">
		Wszystkie (<?= count($package->promotionCodes()) ?>)
	</option>
</select>

<div id="tab-1-content" class="tab-content">
	<?php 
		if (count($package->usedPromotionCodes()) !== 0) { ?>
			<table width="100%">
				<tr>
					<td class="first-row" width="60%">Kod</td>
					<td class="first-row" width="40%">Wykorzystany</td>
				</tr>
			<?php foreach ($package->usedPromotionCodes() as $promotion_code) { ?>
				<tr class="result">
					<td width="60%"><b><?= $promotion_code->code ?></b></td>
					<td width="40%"><?= $promotion_code->used ?></td>
				</tr>
			<?php } ?>	
			</table>
		<?php } else { 
			include 'app/views/layouts/_no_results.php';
		}
	?>
</div>

<div id="tab-2-content" class="tab-content">
	<?php
		if (count($package->nonusedPromotionCodes()) !== 0) { ?>
			<table width="100%">
				<tr>
					<td class="first-row" width="100%">Kod</td>
				</tr>
			<?php foreach ($package->nonUsedPromotionCodes() as $promotion_code) { ?>
				<tr class="result">
					<td width="100%"><b><?= $promotion_code->code ?></b></td>
				</tr>
			<?php } ?>	
			</table>
		<?php } else { 
			include 'app/views/layouts/_no_results.php';
		}
	?>	
</div>

<div id="tab-3-content" class="tab-content">
	<?php
		if (count($package->promotionCodes()) !== 0) { ?>
			<table width="100%">
				<tr>
					<td class="first-row" width="100%">Kod</td>
				</tr>
			<?php foreach ($package->promotionCodes() as $promotion_code) { ?>
				<tr class="result">
					<td width="100%"><b><?= $promotion_code->code ?></b></td>
				</tr>
			<?php } ?>	
			</table>
		<?php } else { 
			include 'app/views/layouts/_no_results.php';
		}
	?>	
</div>