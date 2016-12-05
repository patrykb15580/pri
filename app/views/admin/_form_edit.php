<?php
	$router = Config::get('router');

	$path = $router->generate('update_promotor_by_admin', ['promotors_id' => $params['promotors_id']]);
	
	if (isset($params['update'])) {
		if ($params['update'] == 'error') { ?>
			<div class="error_message">
				Nie udało się zaktualizować prifilu.<br /> Spróbuj jeszcze raz
			</div><br /><br />
		<?php }
	}
?>
<form class="form-page-form" method="POST" action="<?= $path ?>">
	<h1>Edycja konta promotora</h1>
	Nazwa:<br />
	<input type="text" name="promotor[name]" value="<?= $promotor->name ?>"><br /><br />
	E-mail:<br />
	<input type="text" name="promotor[email]" value="<?= $promotor->email ?>"><br /><br />
	<b>Zmiana hasła:</b><br />
	Nowe hasło:<br />
	<input type="password" name="promotor[password]">
	<br /><br />
	Bieżące hasło:<br />
	<input type="password" name="old_password"><br /><br />
	<input class="form-page-button" type="submit" value="Zapisz zmiany"> <a href="/admin/promotor/<?= $promotor->id ?>">Anuluj</a>
</form>