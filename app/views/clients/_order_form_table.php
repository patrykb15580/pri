<table width="100%">
	<tr class="result">
		<td width="20%">Wybrana nagroda</td>
		<td width="80%"></td>
	</tr>
	<tr class="result">
		<td width="20%">
			<?php if (!empty($reward->singleImage())) { ?><img src="/system/reward_images/<?= $reward->singleImage()->id ?>/tiny/<?= $reward->singleImage()->file_name ?>"><?php } ?>
		</td>
		<td width="80%">
			<b><?= $reward->name ?></b><br />
			<?= StringUntils::truncate($reward->description, 220) ?>
		</td>
	</tr>
</table><br />