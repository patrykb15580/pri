<?php
	$router = Config::get('router');
	$path_csv = $router->generate('getCSV', []);
	$path_edit = $router->generate('change_admin_order_status', []);
	$package = $order->package();
?>	
<div id="title-box">
	<i class="fa fa-shopping-basket title-box-icon dark-green-icon" aria-hidden="true"></i><p class="title-box-text">Zamówienie #<?= $order->id ?></p>
</div>
<form id="title-box-options-bar" method="POST" action="<?= $path_csv ?>">
	<input type="hidden" name="package_id" value="<?= $package->id ?>">
	<input class="options-bar-button" type="submit" value="Pobierz plik CSV">
</form>
<table class="single-table">
	<tr class="result">
		<td width="40%">Id paczki kodów:</td><td width="60%"><?= $package->id ?></td>
	</tr>
	<tr class="result">
		<td width="40%">Status:</td>
		<td width="60%">
			<form method="POST" action="<?= $path_edit ?>">
				<input type="hidden" name="order_id" value="<?= $order->id ?>">
				<select name='status'>
					<?php foreach (AdminOrder::STATUSES as $lang_en => $lang_translated) { ?>
						<option value="<?= $lang_en ?>"<?php if ($order->status == $lang_en){echo ' selected="selected"';}?>><?= $lang_translated ?></option>
					<?php } ?>
				</select>
				<input type="submit" value="Zatwierdź">
			</form>
		</td>
	</tr>
	<tr class="result">
		<td width="40%">Nakład:</td><td width="60%"><?= $order->quantity ?> szt</td>
	</tr>
	<tr class="result">
		<td width="40%">Typ:</td><td width="60%"><?= AdminOrder::TYPES[$order->package_type] ?></td>
	</tr>
	<tr class="result">
		<td width="40%">Data zamówienia:</td><td width="60%"><?= $order->order_date ?></td>
	</tr>
</table>
