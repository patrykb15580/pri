<table class="single-table" width="100%">
	<tr>
		<td class="first-row" width="80%">Nazwa akcji</td>
		<td class="first-row" width="20%">Ocena</td>
	</tr>
<?php foreach ($rates as $rate) { 
	$client = $rate->client(); ?>
	<tr class="result">
		<td width="80%"><a href="<?= $path_show ?>"><b><?= $action->name ?></b></a></td>
		<td width="20%"><b><?php for ($i=0; $i < $rate->rate; $i++) { ?>
		 <span class="rate-star">★</span>
	<?php } ?></b></td>
	</tr>
<?php } ?>	
</table>

