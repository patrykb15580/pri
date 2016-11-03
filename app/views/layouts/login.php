<!DOCTYPE html>
<html>
<head>
	<title>
		pri.dev
	</title>
	<link rel="stylesheet" type="text/css" href="/assets/css/main.css">
	<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet"> 
</head>
<body class="start_pages_body">
<?php
	$router = Config::get('router');
?>
<div id="top">
	<a href="<?= $router->generate('login', []); ?>" class="white_font">Logowanie</a> Pomoc
</div>
<hr class="opacity">
<h1 id="main_page_site_title">punktacja.pl</h1>
<?php 
	Alerts::showAlert();
?>
<form id="login" method="POST" action="<?= $router->generate('sign_in', []) ?>">
	<h1 class="text_align_center">Logowanie</h1>
	E-mail:
	<br /><input id="login" type="text" name="login">
	<br /><br />Hasło:
	<br /><input id="login" type="password" name="password">
	<br /><br /><input id="use_code" id="login" type="submit" value="Zaloguj">
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
</body>
</html>