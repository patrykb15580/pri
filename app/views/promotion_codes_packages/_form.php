<?php
	$router = Config::get('router');
	if ($params['action'] == 'edit') {
		$path = $router->generate('update_promotion_codes_packages', ['promotors_id' => $params['promotors_id'], 'action_id' => $params['action_id'], 'id'=>$params['id']]);
	}else $path = $router->generate('create_promotion_codes_packages', ['promotors_id' => $params['promotors_id'], 'action_id' => $params['action_id']]);
	#echo "<pre>";
	#die(print_r($params));
?>
<form method="POST" action="<?= $path ?>">
	Nazwa:<br />
	<input type="text" name='promotion_codes_package[name]' value="<?= $package->name ?>"><br /><br />
	Liczba kodów:<br />
	<input type="text" name='promotion_codes_package[quantity]' value="<?= $package->quantity ?>"><br /><br />
	Wartość kodów:<br />
	<?php if ($params['action'] !== 'edit') { ?>
		
		<input type="text" name="promotion_codes_package[codes_value]"><br /><br />
	<?php } else { ?>
		<input type="text" name="promotion_codes_package[codes_value]" value="<?php echo $package->codes_value ?>" disabled><br /><br />
	<?php } ?>
	Status:<br />
	<select name="promotion_codes_package[status]">
		<?php foreach (PromotionCodesPackage::STATUSES as $lang_en => $lang_translated) { ?>
			<option value="<?= $lang_en ?>"<?php if ($package->status == $lang_en){echo ' selected="selected"';}?>><?= $lang_translated ?></option>
		<?php } ?>
	</select><br /><br />
	Rodzaj:<br />
	<select name="promotion_codes_package[reusable]">
		<?php foreach (PromotionCodesPackage::TYPES as $lang_en => $lang_translated) { ?>
			<option value="<?= $lang_en ?>"<?php if ($package->reusable == $lang_en){echo ' selected="selected"';}?>><?= $lang_translated ?></option>
		<?php } ?>
	</select>
	<br /><br /><input type="submit" value="Zapisz zmiany">
</form>