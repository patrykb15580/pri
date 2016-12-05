<form class="form-page-form" method="POST" action="<?= $path ?>">
	Nazwa:<br />
	<input type="text" name="promotor[name]" value="<?= $promotor->name ?>"><br /><br />
	E-mail:<br />
	<input type="text" name="promotor[email]" value="<?= $promotor->email ?>"><br /><br /><br />
	Hasło:<br />
	<input type="password" name="promotor[password_degest]">
	<?php if (isset($params['password'])) {
		if ($params['password'] == 'empty') { ?>
			<p id="red">Pole nie może być puste</p>
		<?php }
	} ?><br /><br />
	Potwierdź hasło:<br />
	<input type="password" name="confirm_password"><br /><br />
	<input class="form-page-button" type="submit" value="Zapisz zmiany"> <a href="/admin/">Anuluj</a>
</form>