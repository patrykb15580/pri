<?php
	$router = Config::get('router');
	$path_new = $router->generate('new_rewards', ['promotors_id' => $params['promotors_id']]);
	
	#echo "<pre>";
	#die(print_r($active_actions));
?>	
<div id="notice">
	<p id="notice-text"><i class="fa fa-info-circle" aria-hidden="true"></i> W tym panelu możesz ...</p>
	<button type="button" class="close-notice" data-dismiss="alert" aria-hidden="true">
		<i class="fa fa-times" aria-hidden="true"></i>
	</button>
</div>
<div id="title-box">
	<i class="fa fa-gift fa-2x red-icon" aria-hidden="true"></i><p class="title-box-text"> Katalog nagród</p>
	<a href="<?= $path_new ?>">
		<button class="title-box-button">
			<i class="zmdi zmdi-plus"></i> Nowa nagroda
		</button>
	</a>
</div>
<div id="title-box-tabs">
	<p class="tab1 tab-active">AKTYWNE</p><p class="tab2 tab-inactive">NIEAKTYWNE</p>
</div>

<div id="active">
	<?php 
		$rewards = $promotor->activeRewards();
		#echo "<pre>";
		#die(print_r($rewards));
		include 'app/views/rewards/_rewards.php';
	?>
</div>
<div id="inactive">
	<?php 
		$rewards = $promotor->inactiveRewards();
		#echo "<pre>";
		#die(print_r($rewards));
		include 'app/views/rewards/_rewards.php';
	?>
</div>