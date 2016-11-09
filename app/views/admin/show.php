<?php
	$router = Config::get('router');
	$path_new = $router->generate('new_promotors', []);
?>	
<div id="title_box">Promotorzy
<a href="<?= $path_new ?>"><button id="add_new">Nowy promotor</button></a></div>
<br />
<?php 
	include 'app/views/admin/_promotors.php';
?>


	