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
		<a href="/clients/<?= $params['client_id'] ?>">Akcje promocyjne</a><br />
		<a href="/clients/<?= $params['client_id'] ?>/orders">Zamówienia</a><br />
		<a href="/clients/<?= $params['client_id'] ?>/history">Historia</a><br />
	</div>
	<div id="content">
	<?php include($path); ?>
	</div>
</div>	
<div id="bottom">
	
</div>
</body>
</html>