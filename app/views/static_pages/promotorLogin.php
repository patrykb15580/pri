<h1 id="main_page_site_title">punktacja.pl</h1>
<form id="promotor_login" method="POST" action="<?= $router->generate('sign_in', []) ?>">
	<h1 class="text_align_center">Logowanie</h1>
	E-mail:
	<br /><input id="promotor_login" type="text" name="login">
	<br /><br />Hasło:
	<br /><input id="promotor_login" type="password" name="password">
	<br /><br /><input id="static_pages_submit" id="login" type="submit" value="Zaloguj">
</form>
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