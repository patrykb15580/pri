<?php	
	$path = $router->generate('add_points', ['code'=>$params['code']]);
?>
<div id="use_code_container">
	<div class="use_code_top">
		<?php
			$avatar = PromotorAvatar::findBy('promotor_id', $promotor->id);
			if (!empty($avatar)) { ?>
				<img class="use-code-avatar" src="/system/promotor_avatars/<?= $promotor->id ?>/small/<?= $avatar->file_name ?>">
			<?php } else { ?>
				<div class="use-code-avatar"></div>
			<?php } 
		?>
		<div class="promotor-name"><?= $promotor->name ?></div>
		<div class="action-name"><?= $promotion_action->name ?></div>
		<table class="use-code-table">
			<tr>
				<td class="left-first" width="50%">Twój kod</td>
				<td class="right-first" width="50%">Wartość kodu</td>
			</tr>
			<tr>
				<td class="left" width="50%"><?= $params['code'] ?></td>
				<td class="right" width="50%">+ <?= $package->codes_value ?> pkt</td>
			</tr>
		</table>
	</div>	
	<form id="use_code" method="POST" action="<?= $path ?>">
		<label>E-mail<p class="zero_margin red_font inline">*</p></label>
		<br />
		<input type="email" name="client[email]" required="required">
		<br /><br />
		<label>Imię<p class="zero_margin red_font inline">*</p></label>
		<br />
		<input type="text" name="client[name]" required="required">
		<br /><br />
		<label>Telefon<p class="zero_margin red_font inline">*</p></label>
		<br />
		<input type="text" name="client[phone_number]" required="required">
		<br />
		<input id="static_pages_submit" type="submit" value="Dodaj punkty">
	</form>	
</div>
<script type="text/javascript" src="/assets/javascript/useCodeFormGuardianInitialize.js"></script>