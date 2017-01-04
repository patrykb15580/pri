<!--
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
-->

<?php foreach ($packages as $package) {
	$path_show = $router->generate('show_promotion_codes_packages', ['promotors_id' => $params['promotors_id'], 'action_id' => $params['id'], 'id' => $package->id]);?>
	<div id="data-box">
		<div class="data-box-title">
			<a href="<?= $path_show ?>">Pakiet #<?= $package->id ?></a>
		</div>
		<div class="data-box-data">
			Wykorzystanie kody: <b><?= $package->usedCodesNumber() ?> / <?= $package->quantity ?></b><br />
			Wartość kodów: <b><?= $package->codes_value ?> pkt</b><br />
			Wartość paczki: <b><?= $package->packageValue() ?> pkt</b><br />
		</div>
	</div>
<?php } ?>

