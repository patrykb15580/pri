<table class="single-table" width="100%">
	<tr>
		<td class="first-row" width="80%">Nazwa nagrody</td>
		<td class="first-row" width="10%"></td>
		<td class="first-row text_align_right" width="10%">Cena</td>
	</tr>
<?php foreach ($promotor->rewards() as $reward) { 
	$path_show = $router->generate('show_promotor_reward', ['promotor_id' => $promotor->id, 'reward_id' => $reward->id]);?>
	<tr class="result">
		<td width="80%"><a href="<?= $path_show ?>"><?= $reward->name ?></a></td>
		<td width="10%"></td>
		<td class="text_align_right" width="10%"><?= $reward->prize ?></td>
	</tr>
<?php } ?>	
</table>

