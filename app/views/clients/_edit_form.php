<?php
	$router = Config::get('router');

	$path = $router->generate('update_client', ['client_id' => $params['client_id']]);
?>

<form class="form-page-form" method="POST" action="<?= $path ?>">
	Nazwa:<br />
	<input type="text" name="client[name]" value="<?= $client->name ?>"><br /><br />
	E-mail:<br />
	<input type="text" name="client[email]" value="<?= $client->email ?>"><br /><br />
	Numer telefonu<br />
	<input type="text" name="client[phone_number]" value="<?= $client->phone_number ?>" required="required"><br /><br /><br />

	<b>Zmień hasło</b><br />
	Nowe hasło:<br />
	<input type="password" name="client[password_digest]"><br /><br />
	Potwierdź hasło:<br />
	<input type="password" name="confirm_password"><br /><br />
	
	<?php
		if ($client->password_digest !== Password::encryptPassword('')) { ?>
			
			Aktualne hasło:<br />
			<input type="password" name="old_password"><br /><br />

		<?php } 
	?>
	<input class="form-page-button" type="submit" value="Zapisz zmiany">
</form>

<script type="text/javascript" src="/assets/javascript/previewAvatar.js"></script>