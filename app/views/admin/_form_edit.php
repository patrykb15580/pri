<?php
	$router = Config::get('router');

	$path = $router->generate('update_promotor_by_admin', ['promotors_id' => $params['promotors_id']]);
	
	if (isset($params['update'])) {
		if ($params['update'] == 'error') { ?>
			<div id="error_message">
				Nie udało się zaktualizować prifilu.<br /> Spróbuj jeszcze raz
			</div><br /><br />
		<?php }
	}
?>
<form method="POST" action="<?= $path ?>">
	<h1>Edycja konta promotora</h1>
	Nazwa:<br />
	<input type="text" name="promotor[name]" value="<?= $promotor->name ?>"><br /><br />
	E-mail:<br />
	<input type="text" name="promotor[email]" value="<?= $promotor->email ?>"><br /><br />
	Nowe hasło:<br />
	<input type="password" name="promotor[password_degest]">
	<?php if (isset($params['password'])) {
		if ($params['password'] == 'empty') { ?>
			<p id="red">Pole nie może być puste</p>
		<?php }
	} ?><br /><br />
	Stare hasło:<br />
	<input type="password" name="confirm_password"><br /><br />
	<input type="submit" value="Zapisz zmiany">
</form>