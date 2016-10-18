<?php
	$router = Config::get('router');
?>
<h2>W trakcie realizacji</h2>
<table width="100%">
	<tr>
		<td id="first_row" width="45%"></td>
		<td id="first_row" width="25%">Kiedy</td>
		<td id="first_row" width="15%">Wartość punktowa</td>
		<td id="first_row" width="15%"></td>
	</tr>
<?php foreach ($promotor->activeOrders() as $order) { 
	$reward = $order->reward();
	$order_path = $router->generate('show_promotors_orders', ['promotors_id' => $params['promotors_id'], 'order_id' => $order->id]); ?>
	<tr class="result">
		<td width="45%"><?= $reward->name ?></td>
		<td width="25%"><?= $order->created_at ?></td>
		<td width="15%"><?= $reward->prize ?></td>
		<td width="15%"><a href="<?= $order_path ?>">Szczegóły</a></td>
	</tr>
<?php } ?>
</table>

<h2>Zrealizowane</h2>
<table width="100%">
	<tr>
		<td id="first_row" width="45%"></td>
		<td id="first_row" width="25%">Kiedy</td>
		<td id="first_row" width="15%">Wartość punktowa</td>
		<td id="first_row" width="15%"></td>
	</tr>
<?php foreach ($promotor->completedOrders() as $order) { 
	$reward = $order->reward(); 
	$order_path = $router->generate('show_promotors_orders', ['promotors_id' => $params['promotors_id'], 'order_id' => $order->id]); ?>
	<tr class="result">
		<td width="45%"><?= $reward->name ?></td>
		<td width="25%"><?= $order->updated_at ?></td>
		<td width="15%"><?= $reward->prize ?></td>
		<td width="15%"><a href="<?= $order_path ?>">Szczegóły</a></td>
	</tr>
<?php } ?>
</table>

<h2>Anulowane</h2>
<table width="100%">
	<tr>
		<td id="first_row" width="45%"></td>
		<td id="first_row" width="25%">Kiedy</td>
		<td id="first_row" width="15%">Wartość punktowa</td>
		<td id="first_row" width="15%"></td>
	</tr>
<?php foreach ($promotor->canceledOrders() as $order) { 
	$reward = $order->reward();
	$order_path = $router->generate('show_promotors_orders', ['promotors_id' => $params['promotors_id'], 'order_id' => $order->id]); ?>
	<tr class="result">
		<td width="45%"><?= $reward->name ?></td>
		<td width="25%"><?= $order->updated_at ?></td>
		<td width="15%"><?= $reward->prize ?></td>
		<td width="15%"><a href="<?= $order_path ?>">Szczegóły</a></td>
	</tr>
<?php } ?>
</table>