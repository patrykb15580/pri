<?php
	$router = Config::get('router');

	$path = $router->generate('update_client', ['client_id' => $params['client_id']]);
?>

<form class="form-page-form" method="POST" action="<?= $path ?>">
	Nazwa:<br />
	<input type="text" name="client[name]" value="<?= $client->name ?>"><br /><br />
	E-mail:<br />
	<input type="text" name="client[email]" value="<?= $client->email ?>"><br /><br /><br />
	<b>Zmiana hasła</b><br />
	Nowe hasło:<br />
	<input type="password" name="client[password]"><br /><br />
	Bieżące hasło:<br />
	<input type="password" name="old_password"><br /><br />
	<input class="form-page-button" type="submit" value="Zapisz zmiany">
</form>

<script type="text/javascript" src="/assets/javascript/previewAvatar.js"></script>