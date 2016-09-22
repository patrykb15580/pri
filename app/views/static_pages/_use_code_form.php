<?php	
	$router = Config::get('router');
	$path = $router->generate('add_points', ['code'=>$params['code']]);
?>
<form id="use_code" method="POST" action="<?= $path ?>">
	<b><?= $promotor->name ?></b>
	<h1><?= $promotion_action->name ?></h1>
	<table id="use_code" width="40%">
		<tr><td id="first_row">Kod</td><td id="first_row">Wartość kodu</td></tr>
		<tr id="last_row"><td><?= $params['code'] ?></td><td><?= $package->codes_value ?></td></tr>
	</table>
	<br />
	Login (e-mail)
	<br /><input type="text" name="client[email]">
	<br /><br />Imię
	<br /><input type="text" name="client[name]">
	<br /><br />Telefon
	<br /><input type="text" name="client[phone_number]">
	<br /><input id="use_code" type="submit" value="Dodaj punkty">
</form>	