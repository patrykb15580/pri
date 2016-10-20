<!DOCTYPE html>
<html>
<head>
	<title>
		pri.dev
	</title>
	<link rel="stylesheet" type="text/css" href="/assets/css/main.css">
</head>
<body>
<?php 
	$router = Config::get('router');
	Alerts::showAlert();
?>
<form id="login" method="POST" action="<?= $router->generate('sign_in', []) ?>">
	Login:
	<br /><input id="login" type="text" name="login">
	<br /><br />Hasło:
	<br /><input id="login" type="password" name="password">
	<br /><br /><input id="login" type="submit" value="Zaloguj">
	<br />admin -> zaq1@WSX
	<br /><br />
	<hr>
	Promotors:<br /><br />
	<br />test1@test.com -> password1
	<br />test2@test.com -> password2
	<br />test3@test.com -> password3
	<br /><br />
	<hr>
	Clients:<br /><br />
	<?php
		foreach (Client::all() as $client) {
			echo $client->name.' -> hash='.$client->hash.'<br />';
		}
	?>
</form>
</body>
</html>