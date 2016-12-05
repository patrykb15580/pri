<table class="single-table" width="100%">
	<tr>
		<td class="first-row" width="75%">Pakiet</td>
		<td class="first-row text_align_right" width="20%">Wykorzystane kody</td>
	</tr>
<?php foreach ($packages as $package) {
	$path_show = $router->generate('show_promotor_package', ['promotor_id' => $params['promotor_id'], 'action_id' => $params['action_id'], 'package_id' => $package->id]);?>
	<tr class="result">
		<td width="75%"><a href="<?= $path_show ?>">Pakiet #<?= $package->id ?></a></td>
		<td class="text_align_right" width="20%"><b><?= count($package->usedCodes()) ?></b>/<?= $package->quantity ?></td>
	</tr>
<?php } ?>	
</table>

