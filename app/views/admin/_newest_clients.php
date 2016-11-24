<h3>Najnowsi klienci</h3>
<div id="stats_box">
Łączna liczba klientów: <?= count($promotor->clients()) ?>
<table width="98%">
	<tr>
		<td class="first-row">
			Nazwa klienta
		</td>
		<td class="first-row">
			Email klienta
		</td>
		<td class="first-row">
			Numer telefonu
		</td>
		<td class="first-row">
			Ostatnia aktywność
		</td>
	</tr>
	<?php
		foreach ($promotor->newestClients() as $client) {
			$balance = $client->balance($promotor); ?>
			<tr>
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