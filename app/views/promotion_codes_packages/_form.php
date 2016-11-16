<?php
	$router = Config::get('router');
	if ($params['action'] == 'edit') {
		$path = $router->generate('update_promotion_codes_packages', ['promotors_id' => $params['promotors_id'], 'action_id' => $params['action_id'], 'id'=>$params['id']]);
		$prev_page = $router->generate('show_promotion_codes_packages', ['promotors_id' => $params['promotors_id'], 'action_id' => $params['action_id'], 'id' => $params['id']]);
	} else { 
		$path = $router->generate('create_promotion_codes_packages', ['promotors_id' => $params['promotors_id'], 'action_id' => $params['action_id']]);
		$prev_page = $router->generate('show_promotion_actions', ['promotors_id' => $params['promotors_id'], 'id' => $params['action_id']]);
	}
	#echo "<pre>";
	#die(print_r($params));
?>
<form class="form-page-form" method="POST" action="<?= $path ?>">
	Nazwa<br />
	<input type="text" name='promotion_codes_package[name]' value="<?= $package->name ?>" required="required"><br /><br />
	Liczba kodów<br />
	<input class="integer-input" type="text" name='promotion_codes_package[quantity]' value="<?= $package->quantity ?>" <?php if ($params['action'] == 'edit') { echo "disabled"; } ?> required="required"> szt.<br /><br />
	
	Wartość kodu<br />
	<input class="integer-input" type="text" name="promotion_codes_package[codes_value]" <?php if ($params['action'] == 'edit') { echo 'value="'.$package->codes_value.'" disabled'; } ?> required="required"> pkt.<br /><br />

	Status<br />
	<select name="promotion_codes_package[status]">
		<?php foreach (PromotionCodesPackage::STATUSES as $lang_en => $lang_translated) { ?>
			<option value="<?= $lang_en ?>" <?php if ($package->status == $lang_en){echo ' selected="selected"';}?>><?= $lang_translated ?></option>
		<?php } ?>
	</select><br /><br />
	Dodatkowy opis (widoczny tylko dla promotora)<br />
	<textarea rows="6" name="promotion_codes_package[description]"><?= $package->description ?></textarea>
	<br />
	<br /><br /><input class="form-page-button" type="submit" value="<?php if ($params['action'] == 'new') { echo "Utwórz nowy pakiet kodów"; } else echo "Zapisz zmiany"; ?>">
	<a href="<?= $prev_page ?>">Anuluj</a>
</form>