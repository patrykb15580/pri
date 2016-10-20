<?php
	$router = Config::get('router');
?>	
<div id="show_title_box"><h2>Statystyki</h2></div>

<?php 
	include 'app/views/admin/_newest_clients.php';
	include 'app/views/admin/_recently_used_codes.php';
?>