<table width="100%">
	<tr>
		<td class="first-row" width="50%">Nazwa akcji</td>
		<td class="first-row" width="35%">Czas trwania akcji</td>
		<td class="text_align_right first-row" width="15%">Wykorzystane kody</td>
	</tr>
<?php foreach ($promotion_actions as $promotion_action) {			
	$path_show = $router->generate('show_promotion_actions', ['promotors_id' => $params['promotors_id'], 'id' => $promotion_action->id]);

	$from_day = intval(date('d', strtotime($promotion_action->from_at)));
	$from_month = PolishMonthName::NAMES_VARIETLY[date('m', strtotime($promotion_action->from_at))];
	$from_year = date('Y', strtotime($promotion_action->from_at));

	$from_at = $from_day." ".$from_month." ".$from_year;

	$to_day = intval(date('d', strtotime($promotion_action->to_at)));
	$to_month = PolishMonthName::NAMES_VARIETLY[date('m', strtotime($promotion_action->to_at))];
	$to_year = date('Y', strtotime($promotion_action->to_at));
	
	$to_at = $to_day." ".$to_month." ".$to_year; ?>
	<tr class="result">
		<td width="50%"><a href="<?= $path_show ?>"><b><?= $promotion_action->name ?></b></a></td>
		<td width="35%"><?php if ($promotion_action->indefinitely == 1) { echo "bezterminowo"; } else echo $from_at." - ".$to_at; ?></td>
		<td class="text_align_right" width="15%"><b><?= $promotion_action->usedCodesNumber() ?></b> / <?= $promotion_action->codesNumber() ?></td>
	</tr>
<?php } ?>	
</table>
