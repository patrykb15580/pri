<table width="100%">
	<tr>
		<td width="20%">Wybrana nagroda</td>
		<td width="80%"></td>
	</tr>
	<tr>
		<td width="20%">
			<?php if (!empty($image)) { ?><img src="/system/reward_images/<?= $image->id ?>/tiny/<?= $image->file_name ?>"><?php } ?>
		</td>
		<td width="80%">
			<b><?= $reward->name ?></b><br />
			<?= StringUntils::truncate($reward->description, 220) ?>
		</td>
	</tr>
</table><br />