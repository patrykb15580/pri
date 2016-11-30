<?php
	$router = Config::get('router');

	$disabled = '';

	if ($params['action'] == 'edit') {
		$path = $router->generate('update_contests', ['promotors_id' => $params['promotors_id'], 'contest_id' => $params['contest_id']]);
		$disabled = 'disabled';
		$prev_page = '';
		#$prev_page = $router->generate('show_promotion_actions', ['promotors_id' => $params['promotors_id'], 'id' => $params['id']]);
		$contest = Contest::findBy('action_id', $action->id);
	} else { 
		$path = $router->generate('create_contests', ['promotors_id' => $params['promotors_id']]); 
		$prev_page = $router->generate('index_contests', ['promotors_id' => $params['promotors_id']]);
		$contest = new Contest;
	}
	
	#echo "<pre>";
	#die(print_r($params));
?>
<form class="form-page-form" method="POST" action="<?= $path ?>">
	Nazwa konkursu<br />
	<input type="text" name='actions[name]' value="<?= $action->name ?>" required="required"><br /><br />
	Pytanie<br />
	<textarea rows="6" name="contest[question]" <?= $disabled ?> required="required"><?= $contest->question ?></textarea>
	<br />

	<?php 
		if ($params['action'] == 'edit') { ?>
			<br />Status<br />
			<select name='actions[status]'>
				<?php foreach (Contest::STATUSES as $lang_en => $lang_translated) { ?>
					<option value="<?= $lang_en ?>" <?php if ($action->status == $lang_en){echo ' selected="selected"';}?>><?= $lang_translated ?></option>
				<?php } ?>
			</select>
			<br /><br />
		<?php }
	?>
	<br />
	Czas trwania akcji<br />
	od 
	<input type="datetime" class="datepick" name="contest[from_at]" <?php if ($contest->from_at !== '0000-00-00') {echo 'value="'.$contest->from_at.'"';} ?> required="required">
	 do 
	<input type="datetime" class="datepick" name='contest[to_at]' <?php if ($contest->from_at !== '0000-00-00') {echo 'value="'.$contest->to_at.'"';} ?> required="required">
	<br /><br />Opis
	<br /><textarea rows="6" name="actions[description]"><?= $action->description ?></textarea>
	<br /><br /><input class="form-page-button" type="submit" value="<?php if ($params['action']=='new') { echo "Utwórz konkurs"; } else { echo "Zapisz zmiany"; } ?>">
	<a href="<?= $prev_page ?>">Anuluj</a>
</form>