<?php
	$router = Config::get('router');
	$package = $order->package();
?>	
<div id="title-box">
	<i class="fa fa-shopping-basket title-box-icon dark-green-icon" aria-hidden="true"></i><p class="title-box-text">Zamówienie #<?= $order->id ?></p>
</div>
<form id="title-box-options-bar" method="POST" action="/admin/getCSV">
	<input type="hidden" name="package_id" value="<?= $package->id ?>">
	<input class="options-bar-button" type="submit" value="Pobierz plik CSV">
</form>
<table class="single-table">
	<tr class="result">
		<td width="40%">Id paczki kodów:</td><td width="60%"><?= $package->id ?></td>
	</tr>
	<tr class="result">
		<td width="40%">Status:</td><td width="60%"><?= AdminOrder::STATUSES[$order->status] ?></td>
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

