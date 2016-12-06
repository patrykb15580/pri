<table class="single-table" width="100%">
	<tr>
		<td class="first-row" width="55%">Nazwa akcji</td>
		<td class="first-row" width="30%">Czas trwania akcji</td>
		<td class="first-row text_align_right" width="15%">Wykorzystane kody</td>
	</tr>
	<?php foreach ($promotion_actions as $action) { 
		$promotion_action = $action->promotionAction();
		$path_show = $router->generate('show_promotor_action', ['promotor_id' => $promotor->id, 'action_id' => $promotion_action->id]); ?>
		<tr class="result">
			<td width="55%"><a href="<?= $path_show ?>"><?= $action->name ?></a></td>
			<td width="30%"><?php if ($promotion_action->indefinitely == 1) { echo "bezterminowo"; } else echo "od ".$promotion_action->from_at." do ".$promotion_action->to_at; ?></td>
			<td class="text_align_right" width="15%"><b><?= $action->usedCodesNumber() ?></b>/<?= $action->codesNumber() ?></td>
		</tr>
	<?php } ?>	
</table>