<?php
	$router = Config::get('router');

	$path = $router->generate('update_client', ['client_id' => $params['client_id']]);

	if ($client->password_digest == Password::encryptPassword('')) { 
		$password_title = 'Utwórz hasło';
	} else {
		$password_title = 'Zmień hasło';
	}

?>

<form class="client-view-item-box" method="POST" action="<?= $path ?>">
	Nazwa:<br />
	<input type="text" name="client[name]" value="<?= $client->name ?>" <?php if (!empty($client->name)) { ?> required <?php } ?>>
	E-mail:<br />
	<input type="text" name="client[email]" value="<?= $client->email ?>" required>
	Numer telefonu<br />
	<input type="text" name="client[phone_number]" value="<?= $client->phone_number ?>" <?php if (!empty($client->phone_number)) { ?> required <?php } ?>><br />


	<b><?= $password_title ?></b><br />
	Nowe hasło:<br />
	<input type="password" name="client[password_digest]">
	Potwierdź hasło:<br />
	<input type="password" name="confirm_password">
	
	<?php
		if ($client->password_digest !== Password::encryptPassword('')) { ?>
			
			Aktualne hasło:<br />
			<input type="password" name="old_password">

		<?php } 
	?>
	<br />
	<input type="submit" value="Zapisz zmiany">
</form>
