<table class="single-table">
	<tr>
		<td id="first_row" width="25%">Imię</td>
		<td id="first_row" width="30%">e-mail</td>
		<td id="first_row" width="30%">Ostatnia aktywność</td>
		<td id="first_row" width="15%">Saldo w pkt</td>
	</tr>
<?php foreach ($promotor->clients() as $client) {		
	$balance = PointsBalance::where('client_id=? AND promotor_id=?', ['client_id'=>$client->id, 'promotor_id'=>$params['promotors_id']]);
	$balance = $balance[0];
	#echo "<pre>";
	#die(print_r($balance));?>
	<tr class="result">
		<td width="25%"><?= $client->name ?></td>
		<td width="30%"><?= $client->email ?></td>
		<td width="30%"><?= $balance->updated_at ?></td>
		<td width="15%"><?= $balance->balance ?></td>
	</tr>
<?php } ?>	
</table>

