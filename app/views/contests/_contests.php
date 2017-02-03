<table width="100%">
	<tr>
		<td class="first-row" width="55%">Nazwa konkursu</td>
		<td class="first-row" width="15%">Liczba odpowiedzi</td>
		<td class="first-row text_align_right" width="30%"></td>
	</tr>
<?php foreach ($actions as $action) {

	$contest = $action->contest();

	$path_show = $router->generate('show_contests', ['promotors_id' => $params['promotors_id'], 'contest_id' => $contest->action_id]);

	$from_day = intval(date('d', strtotime($contest->from_at)));
	$from_month = PolishMonthName::NAMES_VARIETLY[date('m', strtotime($contest->from_at))];
	$from_year = date('Y', strtotime($contest->from_at));

	$from_at = $from_day." ".$from_month." ".$from_year;

	$to_day = intval(date('d', strtotime($contest->to_at)));
	$to_month = PolishMonthName::NAMES_VARIETLY[date('m', strtotime($contest->to_at))];
	$to_year = date('Y', strtotime($contest->to_at));
	
	$to_at = $to_day." ".$to_month." ".$to_year;?>
	<tr class="result">
		<td width="55%"><a href="<?= $path_show ?>"><b><?= $action->name ?></b></a></td>
		<td width="30%"><?= $from_at." - ".$to_at ?></td>
		<td class="text_align_right" width="15%"><b><?= count($action->answers()) ?></b></td>
	</tr>
<?php } ?>	
</table>



<!--
<table width="100%">
	<tr>
		<td class="first-row" width="55%">Nazwa konkursu</td>
		<td class="first-row" width="30%">Czas trwania</td>
		<td class="first-row text_align_right" width="15%">Liczba odpowiedzi</td>
	</tr>
<?php foreach ($actions as $action) {

	$contest = $action->contest();

	$path_show = $router->generate('show_contests', ['promotors_id' => $params['promotors_id'], 'contest_id' => $contest->action_id]);

	$from_day = intval(date('d', strtotime($contest->from_at)));
	$from_month = PolishMonthName::NAMES_VARIETLY[date('m', strtotime($contest->from_at))];
	$from_year = date('Y', strtotime($contest->from_at));

	$from_at = $from_day." ".$from_month." ".$from_year;

	$to_day = intval(date('d', strtotime($contest->to_at)));
	$to_month = PolishMonthName::NAMES_VARIETLY[date('m', strtotime($contest->to_at))];
	$to_year = date('Y', strtotime($contest->to_at));
	
	$to_at = $to_day." ".$to_month." ".$to_year;?>
	<tr class="result">
		<td width="55%"><a href="<?= $path_show ?>"><b><?= $action->name ?></b></a></td>
		<td width="30%"><?= $from_at." - ".$to_at ?></td>
		<td class="text_align_right" width="15%"><b><?= count($action->answers()) ?></b></td>
	</tr>
<?php } ?>	
</table>
-->

<!--
<?php foreach ($actions as $action) {

	$contest = $action->contest();

	$path_show = $router->generate('show_contests', ['promotors_id' => $params['promotors_id'], 'contest_id' => $contest->action_id]);

	$from_day = intval(date('d', strtotime($contest->from_at)));
	$from_month = PolishMonthName::NAMES_VARIETLY[date('m', strtotime($contest->from_at))];
	$from_year = date('Y', strtotime($contest->from_at));

	$from_at = $from_day." ".$from_month." ".$from_year;

	$to_day = intval(date('d', strtotime($contest->to_at)));
	$to_month = PolishMonthName::NAMES_VARIETLY[date('m', strtotime($contest->to_at))];
	$to_year = date('Y', strtotime($contest->to_at));
	
	$to_at = $to_day." ".$to_month." ".$to_year; ?>
	<div id="data-box">
		<div class="data-box-title">
			<a href="<?= $path_show ?>"><?= $action->name ?></a>
		</div>
		<div class="data-box-data">
			Termin: <b><?= $from_at." - ".$to_at ?></b><br />
			Uczestników: <b><?= count($action->answers()) ?></b><br />
			Ilość kodów: <b><?= count($action->codes()) ?></b><br />
		</div>
	</div>
<?php } ?>
-->