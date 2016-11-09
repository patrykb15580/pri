<table width="100%">
	<tr>
		<td id="first_row" width="35%">Nazwa akcji</td>
		<td id="first_row" width="50%">Czas trwania akcji</td>
		<td class="text_align_right" id="first_row" width="15%">Wykorzystane kody</td>
	</tr>
<?php foreach ($promotion_actions as $promotion_action) {			
	$path_show = $router->generate('show_promotion_actions', ['promotors_id' => $params['promotors_id'], 'id' => $promotion_action->id]);?>
	<tr class="result">
		<td width="35%"><a href="<?= $path_show ?>"><b><?= $promotion_action->name ?></b></a></td>
		<td width="50%"><?php if ($promotion_action->indefinitely == 1) { echo "bezterminowo"; } else echo "od ".$promotion_action->from_at." do ".$promotion_action->to_at; ?></td>
		<td class="text_align_right" width="15%"><b><?= $promotion_action->usedCodesNumber() ?></b>/<?= $promotion_action->codesNumber() ?></td>
	</tr>
<?php } ?>	
</table>

