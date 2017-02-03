<?php
	$router = Config::get('router');
?>	
<!--
<div id="notice">
	<p id="notice-text"><i class="fa fa-info-circle" aria-hidden="true"></i> W tym panelu możesz ...</p>
	<button type="button" class="close-notice" data-dismiss="alert" aria-hidden="true">
		<i class="fa fa-times" aria-hidden="true"></i>
	</button>
</div>
-->

<div class="client-view-title-box">
	<i class="fa fa-trophy client-view-title-icon green-icon" aria-hidden="true"></i><p class="client-view-title-text">Konkursy</p>
</div>
<?php 
	$contests = $client->contests();

	if (count($contests) == 0) {
		include 'app/views/clients/_no_contests.php';
	} else include '_contests.php';
?>


<script type="text/javascript" src="/assets/javascript/blueBg.js"></script>

	