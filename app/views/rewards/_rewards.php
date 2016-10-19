<table width="100%">
	<tr>
		<td id="first_row" width="80%">Nazwa nagrody</td>
		<td id="first_row" width="10%">Wydano</td>
		<td id="first_row" width="10%">Cena</td>
	</tr>
<?php foreach ($rewards as $reward) {			
	$path_show = $router->generate('show_rewards', ['promotors_id' => $params['promotors_id'], 'id' => $reward->id]);?>
	<tr class="result">
		<td width="80%"><a href="<?= $path_show ?>"><?= $reward->name ?></a></td>
		<td width="10%"></td>
		<td width="10%"><?= $reward->prize ?></td>
	</tr>
<?php } ?>	
</table>

