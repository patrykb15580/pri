<?php
	$router = Config::get('router');
	$path = $router->generate('insert_code', []);	
?>

<form method="POST" action="<?= $path ?>" id="insert_code">
	<br />Kod promocyjny:
	<br /><br /><input id="insert_code" type="text" name="code">
	<input id="insert_code" type="submit" value="Zatwierdź">
</form>