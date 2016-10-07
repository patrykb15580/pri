<table width="100%">
	<tr>
		<td id="first_row" width="80%">Nazwa nagrody</td>
		<td id="first_row" width="10%">Wydano</td>
		<td id="first_row" width="10%">Cena</td>
	</tr>
<?php foreach ($promotor->rewards() as $reward) { 
	$path_show = $router->generate('show_promotor_reward', ['promotor_id' => $promotor->id, 'reward_id' => $reward->id]);?>
	<tr>
		<td width="80%"><a href="<?= $path_show ?>"><?= $reward->name ?></a></td>
		<td width="10%"></td>
		<td width="10%"><?= $reward->prize ?></td>
	</tr>
<?php } ?>	
</table>

