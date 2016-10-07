<table width="100%">
	<tr>
		<td id="first_row" width="45%"></td>
		<td id="first_row" width="40%">Kiedy</td>
		<td id="first_row" width="15%">Wartość punktowa</td>
	</tr>
<?php foreach ($promotor->orders() as $order) { 
	$reward = $order->reward(); 
	$path_show = $router->generate('show_promotor_order', ['promotor_id' => $promotor->id, 'order_id' => $order->id]);?>
	<tr>
		<td width="45%"><a href="<?= $path_show ?>"><?= $reward->name ?></a></td>
		<td width="40%"><?= $order->created_at ?></td>
		<td width="15%"><?= $reward->prize ?></td>
	</tr>
<?php } ?>
</table>
