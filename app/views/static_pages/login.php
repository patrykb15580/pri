<div id="login_box">
	<div class="login_left_block">
		<h1 class="text_align_center">Logowanie</h1>
		<form class="guardian-initialize" method="POST" action="<?= $router->generate('sign_in', []) ?>">
			E-mail
			<br /><input type="email" name="client[email]" required="required">
			<br />Hasło
			<br /><input type="password" name="client[password]" required="required">
			<br /><br /><input type="submit" value="Zaloguj"><br />
			<p><a href="<?= $router->generate('forgot_password', []) ?>">Zapomniałeś hasła?</a></p>
		</form>
	</div>
	<div class="login_right_block">
		<p>
			Zapomnij o loginach i hasłach
		</p>
		Wpisz swój adres mailowy a otrzymasz link do logowania.
		<br /><br />
		<form method="POST" action="<?= $router->generate('send_client_hash', []) ?>">
			<label>
				E-mail
			</label>
			<br /><input type="email" name="client_email" required="required">
			<br /><input class="login_submit" type="submit" value="Wyślij link do logowania">
		</form>
		<br />
		<a class="promotor-login-link" href="<?= $router->generate('promotor_login', []) ?>">Zaloguj jako promotor</a>
	</div>
</div>


