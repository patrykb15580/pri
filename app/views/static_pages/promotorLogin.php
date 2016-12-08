<h1 id="main_page_site_title">punktacja.pl</h1>
<div id="login">
	<h1 class="text_align_center">Logowanie</h1>
	<form class="promotor-login-form login-form guardian-initialize" method="POST" action="<?= $router->generate('sign_in', []) ?>">
		E-mail:
		<br /><input type="text" name="login" required="required">
		<br />Hasło:
		<br /><input type="password" name="password" required="required">
		<br /><br /><input type="submit" value="Zaloguj">
	</form>
</div>
<div class="static-pages-data">
	admin -> zaq1@WSX
	<br /><br /><br />

	Promotors:<br />
	<br />test1@test.com -> password1
	<br />test2@test.com -> password2
	<br />test3@test.com -> password3
	<br /><br /><br />

	Clients:<br /><br />
	<?php
		foreach (Client::all() as $client) {
			echo $client->name.' -> hash='.$client->hash.'<br />';
		}
	?>
</div>

