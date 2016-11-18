<table width="100%">
	<tr>
		<td id="first_row" width="45%">Nazwa pakietu</td>
		<td id="first_row" width="40%">Rodzaj</td>
		<td id="first_row" class="text_align_right" width="15%">Wykorzystanie kody</td>
	</tr>
<?php foreach ($packages as $package) {
	$path_show = $router->generate('show_promotion_codes_packages', ['promotors_id' => $params['promotors_id'], 'action_id' => $params['id'], 'id' => $package->id]);?>
	<tr class="result">
		<td width="45%"><a href="<?= $path_show ?>"><b><?= $package->name ?></b></a></td>
		<td width="40%"><?php if ($package->reusable == 1) {echo "wielorazowe";}else echo "jednorazowe";?></td>
		<td class="text_align_right" width="15%"><b><?= $package->usedCodesNumber() ?></b> / <?= $package->quantity ?></td>
	</tr>
<?php } ?>	
</table>

