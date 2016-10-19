<h2>W trakcie realizacji</h2>
<table width="100%">
	<tr>
		<td id="first_row" width="60%"></td>
		<td id="first_row" width="25%">Kiedy</td>
		<td id="first_row" width="15%">Wartość punktowa</td>
	</tr>
<?php foreach ($client->activeOrders() as $order) { 
	$reward = $order->reward(); ?>
	<tr class="result">
		<td width="60%"><?= $reward->name ?></td>
		<td width="25%"><?= $order->created_at ?></td>
		<td width="15%"><?= $reward->prize ?></td>
	</tr>
<?php } ?>
</table>

<h2>Zrealizowane</h2>
<table width="100%">
	<tr>
		<td id="first_row" width="60%"></td>
		<td id="first_row" width="25%">Kiedy</td>
		<td id="first_row" width="15%">Wartość punktowa</td>
	</tr>
<?php foreach ($client->completedOrders() as $order) { 
	$reward = $order->reward(); ?>
	<tr class="result">
		<td width="60%"><?= $reward->name ?></td>
		<td width="25%"><?= $order->updated_at ?></td>
		<td width="15%"><?= $reward->prize ?></td>
	</tr>
<?php } ?>
</table>

<h2>Anulowane</h2>
<table width="100%">
	<tr>
		<td id="first_row" width="60%"></td>
		<td id="first_row" width="25%">Kiedy</td>
		<td id="first_row" width="15%">Wartość punktowa</td>
	</tr>
<?php foreach ($client->canceledOrders() as $order) { 
	$reward = $order->reward(); ?>
	<tr class="result">
		<td width="60%"><?= $reward->name ?></td>
		<td width="25%"><?= $order->updated_at ?></td>
		<td width="15%"><?= $reward->prize ?></td>
	</tr>
<?php } ?>
</table>