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
<body>
<?php Alerts::showAlert(); ?>

<div id="home-page-top">
	<img class="logo" src="/assets/image/punktacja-logo.png"><span class="logo">Punktacja.pl</span>
	<!--
	<div class="options">
		<a href="<?= $router->generate('login', []) ?>">Logowanie</a><a href="<?= $router->generate('app', []) ?>">Wprowadź kod</a>
	</div>
	-->
</div>
<div id="home-page-menu">
	<!--
	<div class="fb-like" data-href="https://www.facebook.com/Punktacjapl-1803082866630893/" data-width="100" data-layout="button_count" data-action="like" data-size="large" data-show-faces="true" data-share="true"></div>
	
	<a href="<?= $router->generate('app', []) ?>">Wprowadź kod</a>
	-->
	
	<span class="scroll" data-bar="about-punktacja">O Punktacja</span>
	<span class="scroll" data-bar="for-clients">Dla Klienta</span>
	<span class="scroll" data-bar="for-promotors">Dla Biznesu</span>
	<span class="scroll" data-bar="contact">Kontakt</span>
	<a class="fb" href="https://www.facebook.com/Punktacjapl-1803082866630893/" target="_blank">Odwiedź nas <i class="fa fa-facebook-official" aria-hidden="true"></i></a>
</div>
<div id="home-page-content">
<?php 
	include($path); 
?>
</div>
<div id="home-page-footer">
	<div class="fb-page-plugin">
		<div class="fb-page" data-href="https://www.facebook.com/Punktacjapl-1803082866630893/" data-width="500" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
			<blockquote cite="https://www.facebook.com/Punktacjapl-1803082866630893/" class="fb-xfbml-parse-ignore">
				<a href="https://www.facebook.com/Punktacjapl-1803082866630893/">
					Punktacja.pl
				</a>
			</blockquote>
		</div>
	</div>
</div>

<script type="text/javascript" src="/assets/javascript/homePageFbPlugin.js"></script>
<script type="text/javascript" src="/assets/javascript/homePageScrollMenu.js"></script>
<script type="text/javascript" src="/assets/javascript/homePageScrollTo.js"></script>
<script type="text/javascript" src="/assets/javascript/homePageBackToTop.js"></script>
<!--
<div id="start-top">
	<button class="toggle-start-menu"><i class="fa fa-bars" aria-hidden="true"></i></button>
</div>
-->
</body>
</html>
