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
	admin->zaq1@WSX
	promotor1 -> test1@test.com -> password1
	promotor2 -> test2@test.com -> password2
	promotor3 -> test3@test.com -> password3
</form>
</body>
</html>