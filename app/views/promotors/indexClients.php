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
	<i class="fa fa-users fa-2x light-purple-icon" aria-hidden="true"></i><p class="title-box-text"> Klienci</p>
</div>
<?php 
	#echo "<pre>";
	#die(print_r($rewards));
	include 'app/views/promotors/_clients.php';
?>

	