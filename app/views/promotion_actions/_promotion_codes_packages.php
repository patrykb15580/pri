<table width="100%">
	<tr>
		<td class="first-row" width="75%">Nazwa pakietu</td>
		<td class="first-row text_align_right" width="25%">Wykorzystanie kody</td>
	</tr>
<?php foreach ($packages as $package) {
	$path_show = $router->generate('show_promotion_codes_packages', ['promotors_id' => $params['promotors_id'], 'action_id' => $params['id'], 'id' => $package->id]);?>
	<tr class="result">
		<td width="75%"><a href="<?= $path_show ?>"><b>Pakiet #<?= $package->id ?></b></a></td>
		<td class="text_align_right" width="25%"><b><?= $package->usedCodesNumber() ?></b> / <?= $package->quantity ?></td>
	</tr>
<?php } ?>	
</table>

