<table width="100%">
	<tr>
		<td id="first_row" width="60%">Kod</td>
		<td id="first_row" width="40%">Wykorzystany</td>
	</tr>
<?php foreach ($promotion_codes as $promotion_code) { ?>
	<tr>
		<td width="60%"><?= $promotion_code->code ?></td>
		<td width="40%"><?php if ($promotion_code->used == '0000-00-00') { echo "Nie"; } else echo $promotion_code->used; ?></td>
	</tr>
<?php } ?>	
</table>
