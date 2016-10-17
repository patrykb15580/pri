<?php
	$router = Config::get('router');

	$path = $router->generate('update_promotor', ['promotors_id' => $params['promotors_id']]);
?>
<form method="POST" action="<?= $path ?>">
	<h1>Edycja konta</h1>
	Nazwa:<br />
	<input type="text" name="promotor[name]" value="<?= $promotor->name ?>"><br /><br />
	E-mail:<br />
	<input type="text" name="promotor[email]" value="<?= $promotor->email ?>"><br /><br /><br />
	<b>Zmiana hasła</b><br />
	Nowe hasło:<br />
	<input type="password" name="promotor[password]"><br /><br />
	Bieżące hasło:<br />
	<input type="password" name="old_password"><br /><br />
	<input type="submit" value="Zapisz zmiany">
</form>