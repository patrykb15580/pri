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
	if (isset($params['error']) && $params['error'] == 'login') { ?>
		<div id="error_message">
			Błędny login lub hasło
		</div>
	<?php } 
	
	if (isset($params['logout'])) { ?>
		<div id="confirm_message">
			Zostałeś pomyślnie wylogowany
		</div>
	<?php } 
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