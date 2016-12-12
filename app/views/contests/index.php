<?php
	$router = Config::get('router');
	$path_new = $router->generate('new_contests', ['promotors_id' => $params['promotors_id']]);
	
	$items_number = count($promotor->contests());

	if (isset($params['notice'])) { ?>
		<div id="notice">
			<p id="notice-text"><i class="fa fa-info-circle" aria-hidden="true"></i> W tym panelu możesz ...</p>
			<button type="button" class="close-notice" data-dismiss="alert" aria-hidden="true">
				<i class="fa fa-times" aria-hidden="true"></i>
			</button>
		</div>
	<?php }
?>	

<div id="title-box">
	<i class="fa fa-trophy title-box-icon green-icon" aria-hidden="true"></i><p class="title-box-text">Konkursy</p>
</div>
<div id="title-box-options-bar">
	<a href="<?= $path_new ?>"><button class="options-bar-button">Nowy konkurs</button></a>
</div>

<select id="select-tab">
	<option value="tab-1">
		Aktywne
	</option>
	<option value="tab-2">
		Nieaktywne
	</option>
	<option value="tab-3">
		Wszystkie
	</option>
</select>

<div id="tab-1-content" class="tab-content">
   	<?php 
		$actions = $promotor->activeContests();

		if (count($actions) == 0 && $items_number !== 0) {
			include 'app/views/layouts/_no_results.php';
		} else if ($items_number == 0) {
			include '_make_first.php';
		} else include '_contests.php';
	?>
</div>

<div id="tab-2-content" class="tab-content">
   	<?php 
		$actions = $promotor->inactiveContests();
		
		if (count($actions) == 0 && $items_number !== 0) {
			include 'app/views/layouts/_no_results.php';
		} else if ($items_number == 0) {
			include '_make_first.php';
		} else include '_contests.php';
	?>
</div>

<div id="tab-3-content" class="tab-content">
   	<?php 
		$actions = $promotor->contests();
		
		if ($items_number == 0) {
			include '_make_first.php';
		} else include '_contests.php';
	?>
</div>

