<?php
	$router = Config::get('router');
?>
<!DOCTYPE html>
<html>
<head>
	<title>
		punktacja.pl
	</title>
	<link rel="stylesheet" type="text/css" href="/assets/css/normalize.css">
	<link rel="stylesheet" type="text/css" href="/assets/css/main.css">
	<link rel="stylesheet" type="text/css" href="/assets/css/insertCode.css">
	<link rel="stylesheet" type="text/css" href="/assets/css/useCode.css">
	<link rel="stylesheet" type="text/css" href="/assets/css/useCodeConfirmation.css">
	<link rel="stylesheet" type="text/css" href="/assets/css/login.css">
	<link rel="stylesheet" type="text/css" href="/assets/css/promotorLogin.css">
	<link rel="stylesheet" type="text/css" href="/assets/css/answerForm.css">
	<link rel="stylesheet" type="text/css" href="/assets/css/tables.css">
	<link rel="stylesheet" type="text/css" href="/assets/css/alerts.css">
	<link rel="stylesheet" type="text/css" href="/assets/css/forgotPassword.css">
	<link rel="stylesheet" type="text/css" href="/assets/css/newPassword.css">
	<link rel="stylesheet" type="text/css" href="/assets/css/rating.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800" rel="stylesheet"> 
	<script src="js/jquery.guardian-1.0.min.js"></script>
	<script src="https://use.fontawesome.com/e806e76f5f.js"></script>
	<script type="text/javascript" src="/assets/javascript/alerts.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body class="start_pages_body">
<?php Alerts::showAlert(); ?>

<button class="toggle-start-menu"><i class="fa fa-bars" aria-hidden="true"></i></button>
<div id="start-menu">
	<div class="hide-start-menu"><i class="fa fa-angle-left" aria-hidden="true"></i><span>Zwiń</span></div>
	<a class="img" href="<?= $router->generate('home', []) ?>"><img src="/assets/image/punktacja-logo-grey.png"></a>
	<a href="<?= $router->generate('app', []); ?>">Wprowadź kod</a>
	<a href="<?= $router->generate('login', []); ?>">Zaloguj jako klient</a>
	<a href="<?= $router->generate('promotor_login', []) ?>">Zaloguj jako promotor</a>
	<a href="<?= $router->generate('forgot_password', []) ?>">Problemy z logowaniem?</a>
	<a href="">Pomoc</a>
</div>
<div id="start-content">
<?php 
	include($path); 
?>
</div>
<script type="text/javascript" src="/assets/javascript/startMenu.js"></script>

<!--
<div id="start-top">
	<button class="toggle-start-menu"><i class="fa fa-bars" aria-hidden="true"></i></button>
</div>
-->
</body>
</html>
