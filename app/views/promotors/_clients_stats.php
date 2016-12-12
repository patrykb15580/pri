<h1 class="stats-title">Najnowsi klienci</h1>
<div id="stats_box">
Łączna liczba klientów: <?= count($promotor->clients()) ?><br /><br />
<table width="100%">
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
		<td class="first-row text_align_right">
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
				<td class="text_align_right">
					<?= $balance->updated_at ?>
				</td>
			</tr>
		<?php }
	?>
</table>
</div>
<br /><br /><br />