<?php
	$client_email = '';
	if (isset($_COOKIE['remember_client_email']) && !empty($_COOKIE['remember_client_email'])) {
		$client_email = 'value="'.$_COOKIE['remember_client_email'].'"';
	}
?>

<div id="login">
	<h1 class="text_align_center">Klient</h1>
	<form class="login-form guardian-initialize" method="POST" action="<?= $router->generate('sign_in', []) ?>">
		<input type="email" name="client[email]" placeholder="Adres e-mail" <?= $client_email ?> required="required">
		<br /><input type="password" name="client[password]" placeholder="Hasło" required="required">
		<br /><br /><input type="submit" value="Zaloguj">
	</form>
</div>
