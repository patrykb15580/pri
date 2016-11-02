<?php
	$router = Config::get('router');
?>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript" src="/assets/javascript/promotorStats.js"></script>

<div id="show_title_box"><h2>Statystyki</h2></div>

<?php 
	include '_newest_clients.php';
	include '_recently_used_codes.php';
	include '_clients_charts.php';
	include '_codes_charts.php';
?>

    
