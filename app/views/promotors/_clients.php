<table class="single-table">
	<tr>
		<td class="first-row" width="25%">E-mail</td>
		<td class="first-row" width="20%">Imię</td>
		<td class="first-row" width="20%">Numer telefonu</td>
		<td class="first-row" width="25%">Ostatnia aktywność</td>
		<td class="first-row" width="10%">Saldo w pkt</td>
	</tr>
<?php foreach ($promotor->clients() as $client) {		
	$balance = PointsBalance::where('client_id=? AND promotor_id=?', ['client_id'=>$client->id, 'promotor_id'=>$params['promotors_id']]);
	$balance = $balance[0];
	#echo "<pre>";
	#die(print_r($balance));?>
	<tr class="result">
		<td width="25%"><?= $client->email ?></td>
		<td width="20%"><?= $client->name ?></td>
		<td width="20%"><?= $client->phone_number ?></td>
		<td width="25%"><?= $balance->updated_at ?></td>
		<td width="10%"><?= $balance->balance ?></td>
	</tr>
<?php } ?>	
</table>

