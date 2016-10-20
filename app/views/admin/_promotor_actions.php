<table width="100%">
	<tr>
		<td id="first_row" width="30%">Nazwa akcji</td>
		<td id="first_row" width="40%">Czas trwania akcji</td>
		<td id="first_row" width="15%">Liczba kodów</td>
		<td id="first_row" width="15%">Wykorzystane kody</td>
	</tr>
	<?php foreach ($promotor->promotionActions() as $promotion_action) { 
		$path_show = $router->generate('show_promotor_action', ['promotor_id' => $promotor->id, 'action_id' => $promotion_action->id]); ?>
		<tr class="result">
			<td width="30%"><a href="<?= $path_show ?>"><?= $promotion_action->name ?></a></td>
			<td width="40%"><?php if ($promotion_action->indefinitely == 1) { echo "bezterminowo"; } else echo "od ".$promotion_action->from_at." do ".$promotion_action->to_at; ?></td>
			<td width="15%"><?= $promotion_action->codesNumber() ?></td>
			<td width="15%"><?= $promotion_action->usedCodesNumber() ?></td>
		</tr>
	<?php } ?>	
	</table>