<?php
	$router = Config::get('router');
	
	if ($params['action'] == 'edit') {
		$path = $router->generate('update_promotion_actions', ['promotors_id' => $params['promotors_id'], 'id' => $params['id']]);
	}else $path = $router->generate('create_promotion_actions', ['promotors_id' => $params['promotors_id']]);
	#echo "<pre>";
	#die(print_r($promotion_action));
?>
<form class="form-page-form" method="POST" action="<?= $path ?>">
	Nazwa akcji<br />
	<input type="text" name='promotion_action[name]' value="<?= $promotion_action->name ?>"><br /><br />
	Dodatkowy opis (widoczny tylko dla promotora)<br />
	<textarea>
		
	</textarea>
	<br />

	<?php 
		if ($params['action'] == 'edit') { ?>
			Status:<br />
			<div id="select-button" class="left active" data-status="active">Aktywne</div>
				<div id="select-button" class="right inactive" data-status="inactive">Nieaktywne</div>
				<br />
				<script type="text/javascript">
					$(document).ready(function(){
						$('#select-button').click({

						})
					});
				</script>
				<?php
					foreach (PromotionAction::STATUSES as $lang_en => $lang_translated) { ?>
						<input class="hidden-input" type="radio" name="promotion_action[status]" value="<?= $lang_en ?>" data-status="<?= $lang_en ?>">
					<?php }
				?>

				<select name='promotion_action[status]'>
					<?php foreach (PromotionAction::STATUSES as $lang_en => $lang_translated) { ?>
						<option value="<?= $lang_en ?>"<?php if ($promotion_action->status == $lang_en){echo ' selected="selected"';}?>><?= $lang_translated ?></option>
					<?php } ?>
				</select>
				<br /><br />
		<?php }
	?>
	<br />
	Czas trwania akcji:<br /><br />
	<input type="radio" name='promotion_action[indefinitely]' value="1" <?php if ($promotion_action->indefinitely == 1) {echo 'checked="checked"';} ?>>bezterminowo
	<br /><input type="radio" name='promotion_action[indefinitely]' value="0" <?php if ($promotion_action->indefinitely == 0) {echo 'checked="checked"';} ?>>
	od 
	<input type="text" class="datepick" name="promotion_action[from_at]" <?php if ($promotion_action->from_at !== '0000-00-00' && $promotion_action->indefinitely == 0) {echo 'value="'.$promotion_action->from_at.'"';}  ?>>
	 do 
	<input type="text" class="datepick" name='promotion_action[to_at]' <?php if ($promotion_action->from_at !== '0000-00-00' && $promotion_action->indefinitely == 0) {echo 'value="'.$promotion_action->to_at.'"';}  ?>>
	<br /><br /><input class="form-page-button" type="submit" value="<?php if ($params['action']=='new') { echo "Utwórz akcję promocyjną";	} ?>">
</form>
<script type="text/javascript">
	$(document).ready(function(){
	$('.datepick').datepicker({ dateFormat: 'yy-mm-dd' });
});
</script>