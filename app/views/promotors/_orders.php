<?php
	$router = Config::get('router');
?>
<!--
<table class="single-table">
	<tr>
		<td class="first-row" width="50%"></td>
		<td class="first-row" width="30%">Kiedy</td>
		<td class="first-row text_align_right" width="20%">Wartość punktowa</td>
	</tr>
<?php foreach ($orders as $order) { 
	$reward = $order->reward();
	$order_path = $router->generate('show_promotors_orders', ['promotors_id' => $params['promotors_id'], 'order_id' => $order->id]); ?>
	<tr class="result">
		<td width="50%"><a href="<?= $order_path ?>"><?= $reward->name ?></a></td>
		<td width="30%"><?= $order->created_at ?></td>
		<td class="text_align_right" width="20%"><?= $reward->prize ?></td>
	</tr>
<?php } ?>
</table>
-->

<?php foreach ($orders as $order) { 
	$reward = $order->reward();
	$order_path = $router->generate('show_promotors_orders', ['promotors_id' => $params['promotors_id'], 'order_id' => $order->id]); ?>
	<div id="data-box">
		<div class="data-box-title">
			<a href="<?= $order_path ?>">Zamówienie #<?= $order->id ?></a>
		</div>
		<div class="data-box-data">
			Nagroda: <b><?= $reward->name ?></b><br />
			Data złożenia zamówienia: <b><?= $order->created_at ?></b><br />
			Wartość: <b><?= $reward->prize ?>pkt</b><br />
		</div>
	</div>
<?php } ?>
