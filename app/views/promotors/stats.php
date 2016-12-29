<?php
	$router = Config::get('router');
	$path_report = $router->generate('get_report', ['promotors_id'=>$promotor->id]);

	if (isset($params['notice'])) { ?>
		<div id="notice" data-cookie="show_promotor_view">
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
<!--
<form id="title-box-options-bar" method="POST" action="<?= $path_report ?>">
	<input class="options-bar-button" type="submit" value="Pobierz raport">
</form>
-->
<select id="select-tab">
	<option value="tab-1">
		Klienci
	</option>
	<option value="tab-2">
		Kody
	</option>
</select>
<br />
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
