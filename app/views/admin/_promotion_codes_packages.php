<table width="100%">
	<tr>
		<td id="first_row" width="40%">Nazwa pakietu</td>
		<td id="first_row" width="30%">Rodzaj</td>
		<td id="first_row" width="15%">Liczba kodów</td>
		<td id="first_row" width="15%">Wykorzystane kody</td>
	</tr>
<?php foreach ($packages as $package) {
	$path_show = $router->generate('show_promotor_package', ['promotor_id' => $params['promotor_id'], 'action_id' => $params['action_id'], 'package_id' => $package->id]);?>
	<tr>
		<td width="40%"><a href="<?= $path_show ?>"><?= $package->name ?></a></td>
		<td width="30%"><?php if ($package->reusable == 1) {echo "wielorazowe";}else echo "jednorazowe";?></td>
		<td width="15%"><?= $package->quantity ?></td>
		<td width="15%"><?= count($package->usedCodes()) ?></td>
	</tr>
<?php } ?>	
</table>

