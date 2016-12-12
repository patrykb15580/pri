<?php
	$router = Config::get('router');
	$path_new = $router->generate('new_promotors', []);
?>	
<div id="title-box">
	<i class="fa fa-users title-box-icon light-purple-icon" aria-hidden="true"></i><p class="title-box-text">Promotorzy</p>
</div>
<div id="title-box-options-bar">
	<a href="<?= $path_new ?>"><button class="options-bar-button">Nowy promotor</button></a>
</div>
<?php 
	include 'app/views/admin/_promotors.php';
?>
