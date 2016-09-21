<?php
	$router = Config::get('router');
	$path = $router->generate('insert_code', []);	
?>

<?php if (isset($_GET['error']) == 'code') { ?>
	<div id="error_message"><?= 'Błędny lub nieaktywny kod'; ?></div>
<?php } ?>

<form method="POST" action="<?= $path ?>" id="insert_code">
	<br />Kod promocyjny:
	<br /><br /><input id="insert_code" type="text" name="code">
	<input id="insert_code" type="submit" value="Zatwierdź">
</form>