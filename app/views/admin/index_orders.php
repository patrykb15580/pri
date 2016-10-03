<?php
	$router = Config::get('router');
	$path_new = $router->generate('new_promotors', []);
?>	
<div id="show_title_box">Promotorzy
<a href="<?= $path_new ?>"><button id="add_new">Nowy promotor</button></a></div>

<?php 
	if (isset($params['promotor'])) {
		if ($params['promotor'] == 'confirm') { ?>
			<div id="confirm_message"> Dodano nowego promotora</div>
		<?php } 
	}
	#echo "<pre>";
	#die(print_r($promotors));
	include 'app/views/admin/_promotors.php';
?>


	