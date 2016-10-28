<?php	
	$router = Config::get('router');
	$user = StringUntils::camelCaseToUnderscore(str_replace('Controller', '', $params['controller']));
	if ($user == 'clients') {
		$user_type = 'client';
		$side_bar = '_clients_side_bar.php';
		$client = Client::find($params['client_id']);
		$user = $client->name;
	} elseif ($user == 'admin') {
		$user_type = 'admin';
		$side_bar = '_admin_side_bar.php';
		$user = 'Administrator';
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
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
</head>
<body>
<div id="top">
<h3><?= $user ?></h3>
<a href="<?= $router->generate('sign_out', []) ?>">Wyloguj</a>
</div>
<hr>
<?php Alerts::showAlert(); ?>
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