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
</form>
</body>
</html>