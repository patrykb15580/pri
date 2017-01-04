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
	<link rel="stylesheet" type="text/css" href="/assets/css/startPage.css">
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
<div id="start-top">
	<button class="toggle-start-menu"><i class="fa fa-bars" aria-hidden="true"></i></button>
</div>
<div class="start-menu">
	<a href="<?= $router->generate('start_page', []); ?>">Wprowadź kod</a>
	<a href="<?= $router->generate('login', []); ?>">Zaloguj jako klient</a>
	<a href="<?= $router->generate('promotor_login', []) ?>">Zaloguj jako promotor</a>
	<a href="<?= $router->generate('forgot_password', []) ?>">Problemy z logowaniem?</a>
	<a href="" class="white_font">Pomoc</a>
</div>
<div id="start-content">
<?php 
	include($path); 
?>
</div>
<script type="text/javascript">
	$('.start-menu').hide();
	$('.toggle-start-menu').click(function(){

		if ($('.start-menu').not(':visible')) {
			$('#start-content').fadeOut(function(){
				$('.start-menu').fadeIn();
			});
		} 
		if ($('.start-menu').is(':visible')) {
			$('.start-menu').fadeOut(function(){
				$('#start-content').fadeIn();
			});
		}
	});
</script>
</body>
</html>
