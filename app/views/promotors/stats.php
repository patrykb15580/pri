<?php
	$router = Config::get('router');
?>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript" src="/assets/javascript/promotorStats.js"></script>

<div id="notice">
	<p id="notice-text"><i class="fa fa-info-circle" aria-hidden="true"></i> W tym panelu możesz ...</p>
	<button type="button" class="close-notice" data-dismiss="alert" aria-hidden="true">
		<i class="fa fa-times" aria-hidden="true"></i>
	</button>
</div>

<div id="title-box">
	<i class="fa fa-line-chart fa-2x blue-icon" aria-hidden="true"></i><p class="title-box-text"> Statystyki</p>
</div>
<div id="title-box-tabs">
	<p class="clients-stats-tab tab-active">KLIENCI</p><p class="codes-stats-tab tab-inactive">KODY</p>
</div>

<div class="clients-charts">
<?php 
	include '_newest_clients.php';
	include '_clients_charts.php';
?>	
</div>

<div class="codes-charts">
<?php
	include '_recently_used_codes.php';
	include '_codes_charts.php';
?>
</div>
