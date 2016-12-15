<?php
	$router = Config::get('router');
	$path_new = $router->generate('new_rewards', ['promotors_id' => $params['promotors_id']]);
	
	#echo "<pre>";
	#die(print_r($active_actions));

	if (isset($params['notice'])) { ?>
		<div id="notice" data-cookie="index_clients_promotor_view">
			<p id="notice-text"><i class="fa fa-info-circle" aria-hidden="true"></i> W tym panelu możesz ...</p>
			<button type="button" class="close-notice" data-dismiss="alert" aria-hidden="true">
				<i class="fa fa-times" aria-hidden="true"></i>
			</button>
		</div>
	<?php }
?>	

<div id="title-box">
	<i class="fa fa-users title-box-icon light-purple-icon" aria-hidden="true"></i><p class="title-box-text"> Klienci</p>
</div>
<?php 
	if (count($promotor->clients()) !== 0) {
		include 'app/views/promotors/_clients.php';
	} else include 'app/views/layouts/_no_results.php';
?>

	