<?php	
	$path = $router->generate('start_page', []);
	$avatar = $promotor->avatar();
?>
<div class="confirm-code-top">
	<?php
		$avatar = PromotorAvatar::findBy('promotor_id', $promotor->id);
		if (!empty($avatar)) { ?>
			<img class="code-info-avatar" src="/system/promotor_avatars/<?= $promotor->id ?>/small/<?= $avatar->file_name ?>">
		<?php } else { ?>
			<div class="code-info-avatar"></div>
		<?php } 
	?>
	<div class="code-info-title">
		<?= $promotor->name ?>
		<br />
		<p><?= $promotion_action->name ?></p>
	</div>
	<hr>
	<table class="code-info-table">
		<tr>
			<td class="left-first" width="50%">Kod</td>
			<td class="right-first" width="50%">Wartość kodu</td>
		</tr>
		<tr>
			<td class="left" width="50%"><?= $params['code'] ?></td>
			<td class="right" width="50%">+ <?= $package->codes_value ?> pkt</td>
		</tr>
	</table>
</div>
<div class="code_message_error">
	<i class="fa fa-frown-o fa-5x" aria-hidden="true"></i>

	<p>Ups,</p>

	Ten kod został już wykorzystany.
</div>
<a class="text_center white_font" href="<?= $path ?>">Powrót</a>