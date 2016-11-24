<?php
	$router = Config::get('router');
?>
<table class="single-table">
	<tr>
		<td class="first-row" width="50%"></td>
		<td class="first-row" width="30%">Kiedy</td>
		<td class="first-row" width="20%">Wartość punktowa</td>
	</tr>
<?php foreach ($orders as $order) { 
	$reward = $order->reward();
	$order_path = $router->generate('show_promotors_orders', ['promotors_id' => $params['promotors_id'], 'order_id' => $order->id]); ?>
	<tr class="result">
		<td width="50%"><a href="<?= $order_path ?>"><?= $reward->name ?></a></td>
		<td width="30%"><?= $order->created_at ?></td>
		<td width="20%"><?= $reward->prize ?></td>
	</tr>
<?php } ?>
</table>