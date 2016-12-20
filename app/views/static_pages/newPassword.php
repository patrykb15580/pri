<?php
	$router = Config::get('router');
?>
<form class="new-password" method="POST" action="<?= $router->generate('change_password', ['token'=>$token->token]) ?>">
	<h1>Zmień hasło</h1>
	Nowe hasło
	<br /><input type="password" name="new_password[password]">
	<br />Potwierdź hasło
	<br /><input type="password" name="new_password[confirm]">
	<br /><input type="submit" value="Zmień hasło">
</form>
