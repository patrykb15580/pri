<h1 class="stats-title">Kody użyte przez ostatnie 7 dni</h1>
<div id="stats_box">
Ilość użytych kodów: <?= count($promotor->recentlyUsedCodes()) ?><br /><br />
<table width="100%">
	<tr>
		<td class="first-row">
			Kod
		</td>
		<td class="first-row">
			Klient
		</td>
		<td class="first-row">
			Data użycia
		</td>
		<td class="first-row">
			Akcja promocyjna
		</td>
		<td class="first-row">
			Paczka kodów
		</td>
	</tr>
	<?php
		foreach ($promotor->recentlyUsedCodes() as $code) { ?>
			<tr class="result">
				<td>
					<?= $code->code ?>
				</td>
				<td>
					<?= $code->client()->name ?>
				</td>
				<td>
					<?= $code->used ?>
				</td>
				<td>
					<?= $code->action()->name ?>
				</td>
				<td>
					Pakiet #<?= $code->package()->id ?>
				</td>
			</tr>
		<?php }
	?>
</table>
</div>
<br /><br /><br />