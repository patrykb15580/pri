<?php
	$router = Config::get('router');
?>	
<h1 id="show_top_title">Zamówienie nr <?= $order->id ?></h1>
<div id="show_top_options">

</div>
<hr>
<table width="50%">
	<tr class="result">
		<td width="40%"><h1>Pakiet #<?= $order->promotor()->id ?></h1></td><td width="60%"></td>
	</tr>
	<tr class="result">
		<td width="40%">Id paczki kodów:</td><td width="60%"><?= $order->package()->id ?></td>
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
