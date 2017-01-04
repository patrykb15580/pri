<table class="single-table" width="100%">
	<tr>
		<td class="first-row" width="80%">Klient</td>
		<td class="first-row" width="20%">Ocena</td>
	</tr>
<?php foreach ($rates as $rate) { 
	$client = $rate->client(); ?>
	<tr class="result">
		<td width="80%"><b><?= $client->email ?></b></td>
		<td width="20%"><b><?php for ($i=0; $i < $rate->rate; $i++) { ?>
		 <span class="rate-star">★</span>
	<?php } for ($i=$rate->rate; $i < 5; $i++) { ?>
		<span class="rate-star-inactive">★</span>
	<?php } ?></b></td>
	</tr>
<?php } ?>	
</table>

