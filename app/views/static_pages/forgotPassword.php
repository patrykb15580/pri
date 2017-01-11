<div id="forgot-password">
	<form method="POST" action="<?= $router->generate('forgot_password_send_mail', []) ?>">
		<h1>
			Zapomniałeś hasła?
		</h1>
		<p>
			Bez obaw, wpisz poniżej swój adres email a pomożemy ci odzyskać hasło.
		</p>
		<input type="email" placeholder="Adres e-mail" name="email" required>
		<br /><input type="submit" value="Odzyskaj hasło">
	</form>
	<!--
	<form method="POST" action="<?= $router->generate('send_client_hash', []) ?>">
		<h1>
			Zapomnij o loginach i hasłach.
		</h1>
		<p>
			Wpisz poniżej swój adres mailowy a otrzymasz link do logowania.
		</p>
		<input type="email" placeholder="Adres e-mail" name="client_email" required>
		<br /><input type="submit" value="Wyślij link do logowania">
	</form>
	-->
</div>