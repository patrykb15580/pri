<h3>Kody użyte przez ostatnie 7 dni</h3>
<div id="stats_box">
Ilość użytych kodów: <?= count($promotor->recentlyUsedCodes()) ?>
<table width="98%">
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
			<tr>
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
					<?= $code->promotionAction()->name ?>
				</td>
				<td>
					<?= $code->package()->name ?>
				</td>
			</tr>
		<?php }
	?>
</table>
</div>
<?php 
/*
*/
?>