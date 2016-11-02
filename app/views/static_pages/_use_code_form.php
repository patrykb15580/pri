<?php	
	$router = Config::get('router');
	$path = $router->generate('add_points', ['code'=>$params['code']]);
?>
<div class="use_code_top">
	<img src="/assets/image/booklet-logo.svg" width="20%"><br />
	<h2><?= $promotor->name ?></h2>
	<h1 class="bold"><b><?= $promotion_action->name ?></b></h1>
	<table id="use_code">
		<tr>
			<td id="first_row">Kod</td>
			<td id="first_row">Wartość kodu</td>
		</tr>
		<tr id="last_row" class="use_code_table_row">
			<td><?= $params['code'] ?></td>
			<td class="green_font"><b><?= $package->codes_value ?></b></td>
		</tr>
	</table>
</div>	
<form id="use_code" method="POST" action="<?= $path ?>">
	<label>Login (e-mail)</label>
	<br />
	<input class="use_code_input" type="text" name="client[email]">
	<br /><br />
	<label>Imię</label>
	<br />
	<input class="use_code_input" type="text" name="client[name]">
	<br /><br />
	<label>Telefon</label>
	<br />
	<input class="use_code_input" type="text" name="client[phone_number]">
	<br />
	<input id="use_code" type="submit" value="Dodaj punkty">
</form>	