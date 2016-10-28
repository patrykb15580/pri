<?php
	$router = Config::get('router');
?>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<div id="show_title_box"><h2>Statystyki</h2></div>

<?php 
	include '_newest_clients.php';
	include '_recently_used_codes.php';
	include '_clients_in_month_chart.php';
	include '_codes_charts.php';
?>

    
