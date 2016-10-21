<?php
	$router = Config::get('router');
?>	
<div id="show_title_box"><h2>Statystyki</h2></div>

<?php 
	include '_newest_clients.php';
	include '_recently_used_codes.php';
	include '_codes_in_month_chart.php';
	include '_codes_in_year_chart.php';
?>
    
