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