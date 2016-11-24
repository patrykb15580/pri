<div class="client-view-item-box">
	<table width="100%">
		<tr>
			<td class="first-row" width="46%"></td>
			<td class="first-row" width="24%">Kiedy</td>
			<td class="first-row" width="10%">Punkty</td>
			<td class="first-row" width="10%">Saldo przed</td>
			<td class="first-row" width="10%">Saldo po</td>
		</tr>
	<?php foreach ($histories as $history) { ?> 
		<tr class="result">
			<td width="46%"><?= $history->description ?></td>
			<td width="24%"><?= $history->created_at ?></td>
			<td <?php if (intval($history->points) < 0) { echo 'class="red_font"'; } else if (intval($history->points) > 0) { echo 'class="green_font"'; } ?>" width="10%"><?= $history->points ?></td>
			<td width="10%"><?= $history->balance_before ?></td>
			<td width="10%"><?= $history->balance_after ?></td>
		</tr>
	<?php } ?>
	</table>
</div>