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
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800" rel="stylesheet"> 
	<script src="js/jquery.guardian-1.0.min.js"></script>
	<script src="https://use.fontawesome.com/e806e76f5f.js"></script>
	<script type="text/javascript" src="/assets/javascript/alerts.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body class="start_pages_body">
<?php Alerts::showAlert(); ?>
<div class="window-size"></div>
<div id="start-top">
	<a class="start-layout-top-link" href="<?= $router->generate('login', []); ?>">Logowanie</a>
	<a class="start-layout-top-link" href="" class="white_font">Pomoc</a>
</div>
<?php 
	include($path); 
?>
<script type="text/javascript">
	var w = $(window).width();
	var h = $(window).height();
	var size = w + 'x' + h;
	$('.window-size').html(size);
	$(window).resize(function(){
		w = $(window).width();
		h = $(window).height();
		size = w + 'x' + h;
		$('.window-size').html(size);
	});
</script>
</body>
</html>