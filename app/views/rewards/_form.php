<?php
	$router = Config::get('router');
	
	if ($params['action'] == 'edit') {
		$path = $router->generate('update_rewards', ['promotors_id' => $params['promotors_id'], 'id' => $params['id']]);
		$images = RewardImage::where('reward_id=?', ['reward_id'=>$params['id']]);
	}else $path = $router->generate('create_rewards', ['promotors_id' => $params['promotors_id']]);
	
	#die(print_r($path));
?>
<form method="POST" action="<?= $path ?>" enctype="multipart/form-data">
	Nazwa:<br />
	<input type="text" name='reward[name]' value="<?= $reward->name ?>"><br /><br />
	Status:<br />
	<select name='reward[status]'>
		<?php foreach (Reward::STATUSES as $lang_en => $lang_translated) { ?>
			<option value="<?= $lang_en ?>"<?php if ($reward->status == $lang_en){echo ' selected="selected"';}?>><?= $lang_translated ?></option>
		<?php } ?>
	</select>
	<br /><br />Cena:
	<br /><input id="prize" type="text" name="reward[prize]" value="<?= $reward->prize ?>"> pkt
	<br /><br />Opis:
	<br /><textarea rows ="6" name="reward[description]"><?= $reward->description ?></textarea>
	<br /><br />
	<div id="reward_images_container">
	<?php if ($params['action'] == 'edit'){ foreach ($images as $image) { 
	$img_path = "/system/".StringUntils::camelCaseToUnderscore(get_class($image))."s/".$image->id.'/small/'.$image->file_name;?>
		<img id="reward_image" src="<?= $img_path ?>">
	<?php }} ?>
	</div>
	<br /><input type="file" name="image[]" accept="image/jpeg, image/png, image/gif" multiple="multiple">
	<br /><br /><input type="submit" value="Zapisz zmiany">
</form>