<?php
	$router = Config::get('router');

	if (isset($params['notice'])) { ?>
		<div id="notice">
			<p id="notice-text"><i class="fa fa-info-circle" aria-hidden="true"></i> W tym panelu możesz ...</p>
			<button type="button" class="close-notice" data-dismiss="alert" aria-hidden="true">
				<i class="fa fa-times" aria-hidden="true"></i>
			</button>
		</div>
	<?php }
?>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript" src="/assets/javascript/promotorStats.js"></script>

<div id="title-box">
	<i class="fa fa-line-chart title-box-icon blue-icon" aria-hidden="true"></i><p class="title-box-text"> Statystyki</p>
</div>
<div id="title-box-tabs">
	<p class="tab tab1 tab-active" data-tab="tab-1">KLIENCI</p><p class="tab tab2 tab-inactive" data-tab="tab-2">KODY</p>
</div>

<div id="tab-1-content" class="tab-content">
<?php 
	#include '_clients_stats.php';
	include '_clients_charts.php';
?>	
</div>

<div id="tab-2-content" class="tab-content">
<?php
	#include '_codes_stats.php';
	include '_codes_charts.php';
?>
</div>
