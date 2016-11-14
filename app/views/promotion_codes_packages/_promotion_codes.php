<table class="single-table">
	<tr>
		<td id="first_row" width="60%">Kod</td>
		<td id="first_row" width="40%">Wykorzystany</td>
	</tr>
<?php foreach ($promotion_codes as $promotion_code) { ?>
	<tr class="result">
		<td width="60%"><b><?= $promotion_code->code ?></b></td>
		<td width="40%"><?php if ($promotion_code->used == NULL) { echo "Nie"; } else echo $promotion_code->used; ?></td>
	</tr>
<?php } ?>	
</table>

