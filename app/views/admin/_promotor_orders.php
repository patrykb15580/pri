<table class="single-table" width="100%">
	<tr>
		<td class="first-row" width="45%"></td>
		<td class="first-row" width="40%">Kiedy</td>
		<td class="first-row text_align_right" width="15%">Wartość punktowa</td>
	</tr>
<?php foreach ($promotor->orders() as $order) { 
	$reward = $order->reward(); 
	$path_show = $router->generate('show_promotor_order', ['promotor_id' => $promotor->id, 'order_id' => $order->id]);?>
	<tr class="result">
		<td width="45%"><a href="<?= $path_show ?>"><?= $reward->name ?></a></td>
		<td width="40%"><?= $order->created_at ?></td>
		<td class="text_align_right" width="15%"><?= $reward->prize ?></td>
	</tr>
<?php } ?>
</table>
