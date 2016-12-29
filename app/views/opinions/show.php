<?php
	$prev_page = $router->generate('index_opinions', ['promotors_id' => $params['promotors_id']]);

	$opinion = $action->opinion();

	if (isset($params['notice'])) { ?>
		<div id="notice" data-cookie="show_contest_view">
			<p id="notice-text"><i class="fa fa-info-circle" aria-hidden="true"></i> W tym panelu możesz ...</p>
			<button type="button" class="close-notice" data-dismiss="alert" aria-hidden="true">
				<i class="fa fa-times" aria-hidden="true"></i>
			</button>
		</div>
	<?php }
?>	
<div id="title-box">
	<a href="<?= $prev_page ?>"><button class="prev-page-button"><i class="fa fa-chevron-left" aria-hidden="true"></i> Wstecz</button></a>
	
	<i class="fa fa-star title-box-icon gold-icon" aria-hidden="true"></i>
	<p class="title-box-text"><?= $action->name ?></p>
	<br />
	<p class="title-box-details">
		Pytanie: <b><?= $opinion->question ?></b>
	</p>
</div>

<?php 
	$rates = $action->rates();

	if (count($rates) == 0) {
		include 'app/views/layouts/_no_results.php';
	} else include 'app/views/opinions/_rates.php';
?>
