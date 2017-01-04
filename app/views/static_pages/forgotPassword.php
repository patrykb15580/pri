<!--
<div class="forgot-password-top">
	Zapomniałeś hasła?
</div>
<form class="forgot-password-form" method="POST" action="<?= $router->generate('forgot_password_send_mail', []) ?>">
	<p>Bez obaw, wpisz poniżej swój adres email a pomożemy ci odzyskać hasło.</p>
	<input type="email" name="email" required="required">
	<input type="submit" value="Wyślij">
</form>
<div class="forgot-password-bottom">
	<a href="<?= $router->generate('login', []) ?>">Powrót do logowania</a>
</div>

<div id="login_box">
	<div class="login_left_block">
		<p>Zapomniałeś hasła?</p>
		<form class="forgot-password-form" method="POST" action="<?= $router->generate('forgot_password_send_mail', []) ?>">
			<p>Bez obaw, wpisz poniżej swój adres email a pomożemy ci odzyskać hasło.</p>
			<input type="email" name="email" required="required">
			<input type="submit" value="Wyślij">
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
-->

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