<div id="login_box">
	<div class="login_left_block">
		<h1>
			Koniec z hasłami!
		</h1>
		Aby zalogować się do panelu wystarczy kliknąć w dowolny link w dowolnej wiadomości email od nas.
		<br /><br />
	</div>
	<div class="login_right_block">
		<p>
			Skasowałeś wszystkie wiadomości od nas?
		</p>
		Nie ma problemu, wpisz poniżej Twój adres e-mail a po chwili otrzymasz na swoją pocztę wiadomość z linkiem do logowania.
		<br /><br />
		<form class="guardianInitialize" method="POST" action="<?= $router->generate('send_client_hash', []) ?>">
			<label>
				E-mail
			</label>
			<br /><input type="text" name="client_email" required="required">
			<br /><input class="login_submit" type="submit" value="Wyślij link do logowania">
		</form>
		<br />
		<a class="promotor-login-link" href="<?= $router->generate('promotor_login', []) ?>">Zaloguj jako promotor</a>
	</div>
</div>