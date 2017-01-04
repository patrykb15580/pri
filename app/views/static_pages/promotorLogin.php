<?php
	$promotor_email = '';
	if (isset($_COOKIE['remember_promotor_email']) && !empty($_COOKIE['remember_promotor_email'])) {
		$promotor_email = 'value="'.$_COOKIE['remember_promotor_email'].'"';
	}
?>
<div id="login">
	<h1 class="text_align_center">Promotor</h1>
	<form class="promotor-login-form login-form guardian-initialize" method="POST" action="<?= $router->generate('sign_in', []) ?>">
		<input type="email" placeholder="Adres e-mail" name="login" <?= $promotor_email ?> required="required">
		<br /><input type="password" placeholder="Hasło" name="password" required="required">
		<br /><br /><input type="submit" value="Zaloguj">
	</form>
</div>
<div class="static-pages-data">
	admin@punktacja.pl -> zaq1@WSX
	<br /><br /><br />

	Promotors:<br />
	<br />test1@test.com -> password1
	<br />test2@test.com -> password2
	<br />test3@test.com -> password3
	<br /><br /><br />

	Clients:<br /><br />
	<?php
		foreach (Client::all() as $client) {
			echo $client->email.' -> hash='.$client->hash.'<br />';
		}
	?>
</div>

