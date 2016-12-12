<?php
	$router = Config::get('router');
?>	
<div class="client-view-box">
<!--
	<div id="notice">
		<p id="notice-text"><i class="fa fa-info-circle" aria-hidden="true"></i> W tym panelu możesz ...</p>
		<button type="button" class="close-notice" data-dismiss="alert" aria-hidden="true">
			<i class="fa fa-times" aria-hidden="true"></i>
		</button>
	</div>
-->

	<div class="client-view-title-box">
		<i class="fa fa-product-hunt client-view-title-icon green-icon" aria-hidden="true"></i><p class="client-view-title-text">Akcje promocyjne</p>
	</div>
	<?php 
		$promotion_actions = $client->promotionActions();

		if (count($promotion_actions) == 0) {
			include 'app/views/clients/_no_actions.php';
		} else include '_promotion_actions.php';
	?>
</div>

<script type="text/javascript" src="/assets/javascript/blueBg.js"></script>