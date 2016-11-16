<?php
	$router = Config::get('router');

	$path = $router->generate('update_promotor', ['promotors_id' => $params['promotors_id']]);
	$image = PromotorAvatar::findBy('promotor_id', $promotor->id);
?>

<form class="form-page-form" method="POST" action="<?= $path ?>" enctype="multipart/form-data">
	<div class="avatar-box">
		<?php
			$avatar = PromotorAvatar::findBy('promotor_id', $promotor->id);
			if (!empty($avatar)) { ?>
				<img class="avatar-big" src="/system/promotor_avatars/<?= $promotor->id ?>/tiny/<?= $avatar->file_name ?>">
			<?php } else { ?>
				<div class="avatar-big"></div>
			<?php }  
		?>
		<label class="form-page-avatar-button" for="form-page-file-button"><?php if (empty($avatar)){ echo '<i class="zmdi zmdi-plus"></i>'; } else echo "Zmień"; ?></label>
	</div>

	<input id="form-page-file-button" type="file" name="image[]" accept="image/jpeg, image/png, image/gif" value="Wybierz logo">
	<br /><br />
	Nazwa:<br />
	<input type="text" name="promotor[name]" value="<?= $promotor->name ?>"><br /><br />
	E-mail:<br />
	<input type="text" name="promotor[email]" value="<?= $promotor->email ?>"><br /><br /><br />
	<b>Zmiana hasła</b><br />
	Nowe hasło:<br />
	<input type="password" name="promotor[password]"><br /><br />
	Bieżące hasło:<br />
	<input type="password" name="old_password"><br /><br />
	<input class="form-page-button" type="submit" value="Zapisz zmiany">
</form>