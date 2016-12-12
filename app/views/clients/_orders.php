<div class="client-view-item-box">
	<table width="100%">
		<tr>
			<td class="first-row" width="40%"></td>
			<td class="first-row" width="20%">Promotor</td>
			<td class="first-row" width="25%">Kiedy</td>
			<td class="first-row text_align_right" width="15%">Wartość punktowa</td>
		</tr>
	<?php foreach ($orders as $order) { 
		$reward = $order->reward(); 
		$promotor = $reward->promotor(); ?>
		<tr class="result">
			<td width="60%"><?= $reward->name ?></td>
			<td width="20%"><?= $promotor->name ?></td>
			<td width="25%"><?= $order->created_at ?></td>
			<td class="text_align_right" width="15%"><?= $reward->prize ?></td>
		</tr>
	<?php } ?>
	</table>
</div>