<div id="use-code">
	<div class="use-code-top">
		<p class="use-code-block-title">
			Promotor
		</p>
		<div class="use-code-promotor-info">
			<?php
				$avatar = PromotorAvatar::findBy('promotor_id', $promotor->id);
				if (!empty($avatar)) { ?>
					<img class="use-code-avatar" src="/system/promotor_avatars/<?= $promotor->id ?>/small/<?= $avatar->file_name ?>">
				<?php } 
			?>
			<span>
				<?= $promotor->name ?>
			</span>
		</div>
		<p class="use-code-block-title">
			Akcja promocyjna
		</p>
		<div class="use-code-action-name">
			<?= $promotion_action->name ?>
		</div>
		<table>
			<tr>
				<td>
					Twój kod
				</td>
				<td>
					Wartość kodu
				</td>
			</tr>
			<tr>
				<td class="use-code-code">
					<?= $params['code'] ?>
				</td>
				<td class="use-code-prize">
					+ <?= $package->codes_value ?> pkt
				</td>
			</tr>
		</table>
	</div>
<?php
	if ($code->isUsed()) {
		include 'app/views/static_pages/_code_is_used.php';
	} else { 
		include 'app/views/static_pages/_use_code_form.php';
	} 
?>
</div>
