<?php
	$router = Config::get('router');
	$path_new = $router->generate('new_rewards', ['promotors_id' => $params['promotors_id']]);
	
	$items_number = count($promotor->rewards());
	#echo "<pre>";
	#die(print_r($active_actions));
?>	
<!--
<div id="notice">
	<p id="notice-text"><i class="fa fa-info-circle" aria-hidden="true"></i> W tym panelu możesz ...</p>
	<button type="button" class="close-notice" data-dismiss="alert" aria-hidden="true">
		<i class="fa fa-times" aria-hidden="true"></i>
	</button>
</div>
-->

<div id="title-box">
	<i class="fa fa-gift title-box-icon red-icon" aria-hidden="true"></i><p class="title-box-text"> Katalog nagród</p>
</div>
<div id="title-box-options-bar">
	<a href="<?= $path_new ?>"><button class="options-bar-button"><i class="zmdi zmdi-plus"></i> Nowa nagroda</button></a>
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
		$rewards = $promotor->activeRewards();
		
		if (count($rewards) == 0 && $items_number !== 0) {
			include 'app/views/layouts/_no_results.php';
		} else if ($items_number == 0) {
			include 'app/views/rewards/_make_first.php';
		} else include 'app/views/rewards/_rewards.php';
	?>
</div>
<div id="tab-2-content" class="tab-content">
	<?php 
		$rewards = $promotor->inactiveRewards();
		
		if (count($rewards) == 0 && $items_number !== 0) {
			include 'app/views/layouts/_no_results.php';
		} else if ($items_number == 0) {
			include 'app/views/rewards/_make_first.php';
		} else include 'app/views/rewards/_rewards.php';
	?>
</div>
<div id="tab-3-content" class="tab-content">
	<?php 
		$rewards = $promotor->rewards();
		
		if ($items_number == 0) {
			include 'app/views/rewards/_make_first.php';
		} else include 'app/views/rewards/_rewards.php';
	?>
</div>