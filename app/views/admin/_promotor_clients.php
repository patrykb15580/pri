<table class="single-table" width="100%">
	<tr>
		<td class="first-row" width="25%">Imię</td>
		<td class="first-row" width="30%">e-mail</td>
		<td class="first-row" width="30%">Ostatnia aktywność</td>
		<td class="first-row text_align_right" width="15%">Saldo w pkt</td>
	</tr>
<?php foreach ($promotor->clients() as $client) {		
	$balance = PointsBalance::where('client_id=? AND promotor_id=?', ['client_id'=>$client->id, 'promotor_id'=>$promotor->id]);
	$balance = $balance[0];?>
	<tr class="result">
		<td width="25%"><?= $client->name ?></td>
		<td width="30%"><?= $client->email ?></td>
		<td width="30%"><?= $balance->updated_at ?></td>
		<td class="text_align_right" width="15%"><?= $balance->balance ?></td>
	</tr>
<?php } ?>	
</table>

