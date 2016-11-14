<?php
	$router = Config::get('router');
	$path_new = $router->generate('new_promotion_actions', ['promotors_id' => $params['promotors_id']]);
?>	
<div id="notice">
	<p id="notice-text"><i class="fa fa-info-circle" aria-hidden="true"></i> W tym panelu możesz ...</p>
	<button type="button" class="close-notice" data-dismiss="alert" aria-hidden="true">
		<i class="fa fa-times" aria-hidden="true"></i>
	</button>
</div>

<div id="title-box">
	<i class="fa fa-product-hunt title-box-icon green-icon" aria-hidden="true"></i><p class="title-box-text"> Akcje promocyjne</p>
	<a href="<?= $path_new ?>"><button class="title-box-button"><i class="zmdi zmdi-plus"></i> Nowa akcja promocyjna</button></a>
</div>
<div id="title-box-tabs">
	<p class="tab1 tab-active">AKTYWNE</p><p class="tab2 tab-inactive">NIEAKTYWNE</p>
</div>

<div id="active">
   	<?php 
		$promotion_actions = $promotor->activeActions();
		include '_promotion_actions.php';
	?>
</div>
<div id="inactive">
   	<?php 
		$promotion_actions = $promotor->inactiveActions();
		include '_promotion_actions.php';
	?>
</div>

