<table class="single-table" width="100%">
	<tr>
		<td class="first-row" width="45%">Nazwa konkusru</td>
		<td class="first-row" width="40%">Czas trwania konkursu</td>
		<td class="first-row text_align_right" width="15%">Liczba odpowiedzi</td>
	</tr>
	<?php foreach ($contests as $action) { 
		$contest = $action->contest();
		$path_show_contest = $router->generate('show_promotor_contest', ['promotor_id' => $promotor->id, 'action_id' => $action->id]); ?>
		<tr class="result">
			<td width="45%"><a href="<?= $path_show_contest ?>"><?= $action->name ?></a></td>
			<td width="40%">od <?= $contest->from_at ?> do <?= $contest->to_at ?></td>
			<td class="text_align_right" width="15%"><?= count($action->answers()) ?></td>
		</tr>
	<?php } ?>	
</table>