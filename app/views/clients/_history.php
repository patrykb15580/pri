<table width="100%">
	<tr>
		<td id="first_row" width="46%"></td>
		<td id="first_row" width="24%">Kiedy</td>
		<td id="first_row" width="10%">Punkty</td>
		<td id="first_row" width="10%">Saldo przed</td>
		<td id="first_row" width="10%">Saldo po</td>
	</tr>
<?php foreach ($histories as $history) { ?> 
	<tr class="result">
		<td width="46%"><?= $history->description ?></td>
		<td width="24%"><?= $history->created_at ?></td>
		<td width="10%"><?= $history->points ?></td>
		<td width="10%"><?= $history->balance_before ?></td>
		<td width="10%"><?= $history->balance_after ?></td>
	</tr>
<?php } ?>
</table>