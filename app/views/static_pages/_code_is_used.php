<?php	
	$path = $router->generate('start_page', []);
	$avatar = PromotorAvatar::findBy('promotor_id', $promotor->id);
?>
<div id="code_info_top">
	<div id="code_info_container">
		<img id="code_info_logo" src="/system/promotor_avatars/<?= $promotor->id ?>/small/<?= $avatar->file_name ?>">
		<div id="code_info_inline_text">
			<?= $promotor->name ?>
			<br />
			<p class="extra_bold dark_font zero_margin"><?= $promotion_action->name ?></p>
		</div>
	</div>
	<hr class="clear_both">
	<table id="code_info_table" width="100%">
		<tr class="no_border_table">
			<td width="50%">Kod</td>
			<td width="50%">Wartość kodu</td>
		</tr>
		<tr class="no_border_table">
			<td class="dark_font extra_bold medium_font"><?= $params['code'] ?></td>
			<td class="green_font extra_bold medium_font"><?= $package->codes_value ?> ptk</td>
		</tr>
	</table>
</div>
<div id="code_message_error">
	<i class="fa fa-frown-o fa-5x" aria-hidden="true"></i>

	<p class="code_message_error">Ups,</p>

	Ten kod został już wykorzystany.
</div>
<a class="text_center white_font" href="<?= $path ?>">Powrót</a>