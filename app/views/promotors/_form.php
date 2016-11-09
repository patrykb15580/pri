<?php
	$router = Config::get('router');

	$path = $router->generate('update_promotor', ['promotors_id' => $params['promotors_id']]);
	$image = PromotorAvatar::findBy('promotor_id', $promotor->id);
?>
<div id="notice">
	<p id="notice-text"><i class="fa fa-info-circle" aria-hidden="true"></i> W tym panelu możesz ...</p>
	<button type="button" class="close-notice" data-dismiss="alert" aria-hidden="true">
		<i class="fa fa-times" aria-hidden="true"></i>
	</button>
</div>

<div id="title_box">
	<i class="fa fa-cog fa-2x dark-purple-icon" aria-hidden="true"></i><p class="title-box-text"> Edycja konta</p>
</div>
<form method="POST" action="<?= $path ?>" enctype="multipart/form-data">
	<?php
		$avatar = PromotorAvatar::findBy('promotor_id', $promotor->id);
		if (!empty($avatar)) { ?>
			<img class="avatar-big" src="/system/promotor_avatars/<?= $promotor->id ?>/tiny/<?= $avatar->file_name ?>">
		<?php } else { ?>
			<div class="avatar-big"></div>
		<?php }  
	?>
	<input type="file" name="image[]" accept="image/jpeg, image/png, image/gif" value="Wybierz logo"><br />
	Nazwa:<br />
	<input type="text" name="promotor[name]" value="<?= $promotor->name ?>"><br /><br />
	E-mail:<br />
	<input type="text" name="promotor[email]" value="<?= $promotor->email ?>"><br /><br /><br />
	<b>Zmiana hasła</b><br />
	Nowe hasło:<br />
	<input type="password" name="promotor[password]"><br /><br />
	Bieżące hasło:<br />
	<input type="password" name="old_password"><br /><br />
	<input type="submit" value="Zapisz zmiany">
</form>