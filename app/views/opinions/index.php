<?php
	$router = Config::get('router');
	#$path_new = $router->generate('new_contests', ['promotors_id' => $params['promotors_id']]);
	
	#$items_number = count($promotor->contests());

	if (isset($params['notice'])) { ?>
		<div id="notice" data-cookie="index_opinion_view">
			<p id="notice-text"><i class="fa fa-info-circle" aria-hidden="true"></i> W tym panelu możesz ...</p>
			<button type="button" class="close-notice" data-dismiss="alert" aria-hidden="true">
				<i class="fa fa-times" aria-hidden="true"></i>
			</button>
		</div>
	<?php }
?>	

<div id="title-box">
	<i class="fa fa-star title-box-icon gold-icon" aria-hidden="true"></i><p class="title-box-text">Opinie</p>
</div>

<?php 
	$opinions = $promotor->opinions();

	if (count($opinions) == 0) {
		include 'app/views/layouts/_no_results.php';
	} else include '_opinions.php';
?>



