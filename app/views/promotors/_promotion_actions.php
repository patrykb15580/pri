<table width="100%">
	<tr>
		<td id="first_row" width="40%">Nazwa akcji</td>
		<td id="first_row" width="30%">Czas trwania akcji</td>
		<td id="first_row" width="15%">Liczba kodów</td>
		<td id="first_row" width="15%">Wykorzystane kody</td>
	</tr>
<?php foreach ($promotion_actions as $promotion_action) {			
	$path_show = $router->generate('show_promotion_actions', ['promotors_id' => $params['promotors_id'], 'id' => $promotion_action->id]);?>
	<tr>
		<td width="40%"><a href="<?= $path_show ?>"><?= $promotion_action->name ?></a></td>
		<td width="30%"><?php if ($promotion_action->indefinitely == 1) { echo "bezterminowo"; } else echo "od ".$promotion_action->from_at." do ".$promotion_action->to_at; ?></td>
		<td width="15%"></td>
		<td width="15%"></td>
	</tr>
<?php } ?>	
</table>

