<?php	
	$user = StringUntils::camelCaseToUnderscore(str_replace('Controller', '', $params['controller']));
	if ($user == 'clients') {
		$user_type = 'client';
		$side_bar = '_clients_side_bar.php';
		$client = Client::find($params['client_id']);
		$user = $client->name;
	} else {
		$user_type = 'promotor';
		$side_bar = '_promotors_side_bar.php';
		$promotor = Promotor::find($params['promotors_id']);
		$user = $promotor->name;
	}
?>
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
<h3><?= $user ?></h3>
</div>
<hr>
<div id="container">
	<?php 
	include './app/views/layouts/'.$side_bar;?>
	<div id="content">
	<?php include($path); ?>
	</div>
</div>	
<div id="bottom">
	
</div>
</body>
</html>