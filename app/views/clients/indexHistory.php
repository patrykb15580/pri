<?php
	$router = Config::get('router');
?>	
<div id="notice">
	<p id="notice-text"><i class="fa fa-info-circle" aria-hidden="true"></i> W tym panelu możesz ...</p>
	<button type="button" class="close-notice" data-dismiss="alert" aria-hidden="true">
		<i class="fa fa-times" aria-hidden="true"></i>
	</button>
</div>

<div class="client-view-title-box">
	<i class="fa fa-history client-view-title-icon brown-icon" aria-hidden="true"></i><p class="client-view-title-text">Historia</p>
</div>

<?php 
	if (count($histories) == 0) {
		include 'app/views/layouts/_no_results.php';
	} else include 'app/views/clients/_history.php';
?>

<script type="text/javascript" src="/assets/javascript/blueBg.js"></script>
	