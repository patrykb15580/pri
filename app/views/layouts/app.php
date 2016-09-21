<!DOCTYPE html>
<html>
<head>
	<title>
		pri.dev
	</title>
	<link rel="stylesheet" type="text/css" href="/assets/css/main.css">
</head>
<body>
<div id="top">
<br />
</div>
<hr>
<div id="container">
	<div id="side_bar">
		<a href="/promotors/<?= $params['promotors_id'] ?>">Akcje promocyjne</a><br />
		<a href="/promotors/<?= $params['promotors_id'] ?>/rewards">Katalog nagród</a><br />
		<a href="">Klienci</a><br />
		<a href="">Zamówienia</a><br />
		<a href="">Ustawienia konta</a><br />
		<a href="">Informacje dla klientów</a><br />

	</div>
	<div id="content">
	<?php include($path); ?>
	</div>
</div>	
<div id="bottom">
	
</div>
</body>
</html>