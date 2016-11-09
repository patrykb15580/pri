<?php
	$router = Config::get('router');
?>
<!DOCTYPE html>
<html>
<head>
	<title>
		pri.dev
	</title>
	<link rel="stylesheet" type="text/css" href="/assets/css/normalize.css">
	<link rel="stylesheet" type="text/css" href="/assets/css/main.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700,800&amp;subset=latin-ext" rel="stylesheet"> 
	<script src="js/jquery.guardian-1.0.min.js"></script>
	<script src="https://use.fontawesome.com/e806e76f5f.js"></script>
	<script type="text/javascript" src="/assets/javascript/alerts.js"></script>
</head>
<body class="start_pages_body">
<?php Alerts::showAlert(); ?>
<div id="top">
	<a href="<?= $router->generate('login', []); ?>" class="white_font">Logowanie</a> Pomoc
</div>
<?php 
	include($path); 
?>
</body>
</html>