<h3>Najnowsi klienci</h3>
<div id="stats_box">
Łączna liczba klientów: <?= count($promotor->clients()) ?><br /><br />
<table width="98%">
	<tr>
		<td id="first_row">
			Nazwa klienta
		</td>
		<td id="first_row">
			Email klienta
		</td>
		<td id="first_row">
			Numer telefonu
		</td>
		<td id="first_row">
			Ostatnia aktywność
		</td>
	</tr>
	<?php
		foreach ($promotor->newestClients() as $client) {
			$balance = $client->balance($promotor); ?>
			<tr class="result">
				<td>
					<?= $client->name ?>
				</td>
				<td>
					<?= $client->email ?>
				</td>
				<td>
					<?= $client->phone_number ?>
				</td>
				<td>
					<?= $balance->updated_at ?>
				</td>
			</tr>
		<?php }
	?>
</table>
</div>
<br /><br /><br />