<?php
	$router = Config::get('router');
	$path_edit = $router->generate('edit_promotor_by_admin', ['promotors_id' => $params['promotor_id']]);
	#echo "<pre>";
	#die(print_r($params));
?>	
<h1 id="show_top_title"><?= $promotor->name ?></h1>
<div id="show_top_options">
	<a href="<?= $path_edit ?>">Edytuj</a>
</div>
<br /><br /><br />
<?php
	include 'app/views/admin/_promotors_menu.php';
	include 'app/views/admin/_show_promotor.php'
?>
