<p class="order-table-title">Promotor</p>
<table id="order-form-table" width="100%">
	<tr class="result">
		<td width="100%">
			<?php 
				$promotor = $reward->promotor();
				$avatar = $promotor->avatar();
				if (!empty($avatar)) { ?>
					<img class="order-table-avatar" src="/system/promotor_avatars/<?= $promotor->id ?>/small/<?= $avatar->file_name ?>">
				<?php } else { ?>
					<div class="order-table-avatar"></div>
				<?php } 
			?>
			<p class="promotor-name"><?= $promotor->name ?></p>
		</td>
	</tr>
</table>
<br /><br />
<p class="order-table-title">Wybrana nagroda</p>
<table id="order-form-table" width="100%">
	<tr class="result">
		<td width="120px">
			<?php if (!empty($reward->singleImage())) { ?><img src="/system/reward_images/<?= $reward->singleImage()->id ?>/very_small/<?= $reward->singleImage()->file_name ?>"><?php } ?>
		</td>
		<td>
			<b><?= $reward->name ?></b><br />
			<?= StringUntils::truncate($reward->description, 220) ?>
		</td>
		<td class="order-table-prize" width="100px"><?= $reward->prize ?></td>
	</tr>
</table><br />