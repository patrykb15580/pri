<?php
	$router = Config::get('router');
	$path_actions = $router->generate('show_promotors', ['promotors_id' => $params['promotors_id']]);
	$path_update = $router->generate('edit_contests', ['promotors_id' => $params['promotors_id'], 'contest_id' => $params['contest_id']]);
	$prev_page = $router->generate('index_contests', ['promotors_id' => $params['promotors_id']]);

	$from_day = intval(date('d', strtotime($contest->from_at)));
	$from_month = PolishMonthName::NAMES_VARIETLY[date('m', strtotime($contest->from_at))];
	$from_year = date('Y', strtotime($contest->from_at));

	$from_at = $from_day." ".$from_month." ".$from_year;

	$to_day = intval(date('d', strtotime($contest->to_at)));
	$to_month = PolishMonthName::NAMES_VARIETLY[date('m', strtotime($contest->to_at))];
	$to_year = date('Y', strtotime($contest->to_at));
	
	$to_at = $to_day." ".$to_month." ".$to_year;
?>	
<div id="notice">
	<p id="notice-text"><i class="fa fa-info-circle" aria-hidden="true"></i> W tym panelu możesz ...</p>
	<button type="button" class="close-notice" data-dismiss="alert" aria-hidden="true">
		<i class="fa fa-times" aria-hidden="true"></i>
	</button>
</div>

<div id="title-box">
	<a href="<?= $prev_page ?>"><button class="prev-page-button"><i class="fa fa-chevron-left" aria-hidden="true"></i> Wstecz</button></a>
	
	<i class="fa fa-trophy title-box-icon green-icon" aria-hidden="true"></i>
	<p class="title-box-text"><?= $contest->name ?></p>
	<br /><br />
	<p class="title-box-details">
		Status: <b><?= Contest::STATUSES[$contest->status] ?></b><br />
		Czas trwania: <b><?= 'od '.$from_at." do ".$to_at ?></b><br />
		Pytanie: <b><?= $contest->question ?></b><br /><br />
	</p>
	<div class="title-box-options">
		<a href="<?= $path_update ?>">Edytuj</a><br /><br />
		<?php if (count($contest->answers()) > 10) { ?>
			<b class="get-random-answer" data-contestid="<?= $contest->id ?>">Pomóż mi wybrać odpowiedź</b>
		<?php } ?>
	</div>
</div>
<div class="modal-bg">
	<div class="random-answer">

	</div>
</div>
<?php 
	$answers = $contest->answers();

	if (count($answers) == 0) {
		include 'app/views/layouts/_no_results.php';
	} else include 'app/views/contests/_answers.php';
?>

<script type="text/javascript" src="/assets/javascript/randomAnswer.js"></script>