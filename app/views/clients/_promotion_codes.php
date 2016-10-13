<?php 
foreach ($client->promotors() as $promotor) { 
	$path_rewards = $router->generate('client_index_rewards', ['client_id' => $params['client_id'], 'promotors_id' => $promotor->id]);
	$balance = PointsBalance::where('client_id=? AND promotor_id=?', ['client_id'=>$client->id, 'promotor_id'=>$promotor->id]);
	$balance = $balance[0];?>
<h3><?= $promotor->name ?></h3>
<table width="100%">
	<tr>
		<td id="first_row" width="80%">Nazwa akcji</td>
		<td id="first_row" width="20%">Twoje punkty</td>
	</tr>
<?php foreach ($client->promotionActions() as $promotion_action) { 
	if ($promotion_action->promotors_id == $promotor->id) { ?>
		<tr>
			<td width="80%"><?= $promotion_action->name ?></td>
			<td width="20%"><?= $client->promotionActionsValues()[$promotion_action->id] ?> pkt</td>
		</tr>
	<?php } } ?>
	<tr id="last_row"><td width="80%"><a href="<?= $path_rewards ?>"><button>Katalog nagród</button></a></td><td width="20%">Saldo: <?= $balance->balance ?> pkt</td></tr>	
</table>
<?php } ?>