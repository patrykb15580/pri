<?php
	$router = Config::get('router');
?>
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
<div id="top">
	<a href="<?= $router->generate('login', []); ?>" class="white_font">Logowanie</a> Pomoc
</div>
<hr>

<?php 
	Alerts::showAlert();
	include($path); 
?>
</body>
</html>