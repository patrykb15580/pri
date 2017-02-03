<table class="single-table" width="100%">
	<tr>
		<td class="first-row" width="30%">Nazwa akcji</td>
		<td class="first-row" width="45%">Pytanie</td>
		<td class="first-row" width="25%">Ocena</td>
	</tr>
<?php foreach ($opinions as $opinion) { 
	$action = $opinion->action(); 
	$rate = $action->rate();
	$path_show = $router->generate('show_opinions', ['promotors_id'=>$params['promotors_id'], 'opinion_id'=>$action->id]); 
	
	if ($rate !== 0) {
		$stars = [];

		for ($i=1; $i <= 5; $i++) { 
			if ($rate >= $i) {
				array_push($stars, '<i class="fa fa-star rate-star" aria-hidden="true"></i>');
			}
			if (($i + 0.5) <= $rate && ($i + 1) > $rate) {
				array_push($stars, '<i class="fa fa-star-half-o rate-star" aria-hidden="true"></i>');
			}
			if ($i > $rate) { 
				array_push($stars, '<i class="fa fa-star-o rate-star-inactive" aria-hidden="true"></i>');
			}
			
			$rate_rounded = number_format($rate, 1);
			if ($rate_rounded == 5) {
				array_push($stars, '<i class="fa fa-star rate-star" aria-hidden="true"></i>');
			}
		}

		$rate = $rate.' '.$stars[0].$stars[1].$stars[2].$stars[3].$stars[4];
	} else {
		$rate = 'Brak opini';
	}
	
	?>
	<tr class="result">
		<td width="30%">
			<a href="<?= $path_show ?>"><b><?= $action->name ?></b></a>
		</td>
		<td width="45%">
			<?= $opinion->question ?>
		</td>
		<td width="25%">
			<?= $rate ?>
		</td>
	</tr>
<?php } ?>	
</table>

<?php
/*	$rate = 0.9;
	$rates = [];
	for ($i=0; $i < 41; $i++) { 
		$rate = $rate + 0.1;
		array_push($rates, $rate);
	}

	foreach ($rates as $rate) {
		$stars = [];
		for ($i=1; $i <= 5; $i++) { 
			if ($rate >= $i) {
				array_push($stars, '<i class="fa fa-star rate-star" aria-hidden="true"></i>');
			}
			if (($i + 0.5) <= $rate && ($i + 1) > $rate) {
				array_push($stars, '<i class="fa fa-star-half-o rate-star" aria-hidden="true"></i>');
			}
			if ($i > $rate) { 
				array_push($stars, '<i class="fa fa-star-o rate-star-inactive" aria-hidden="true"></i>');
			}

			$rate_rounded = number_format($rate, 1);
			if ($rate_rounded == 5) {
				array_push($stars, '<i class="fa fa-star rate-star" aria-hidden="true"></i>');
			}

			#if ($i <= round(($rate - 0.5), 0)) { 
			#	array_push($stars, '<i class="fa fa-star rate-star" aria-hidden="true"></i>');
			#}
			#if ($i >= round(($rate - 0.5), 0) && $i < $rate) {
			#	array_push($stars, '<i class="fa fa-star-half-o rate-star" aria-hidden="true"></i>');
			#}
			#if ($i > round(($rate - 0.5), 0)) { 
			#	array_push($stars, '<i class="fa fa-star-o rate-star-inactive" aria-hidden="true"></i>');
			#}
		}
		
		echo $stars[0].$stars[1].$stars[2].$stars[3].$stars[4].' --> '.$rate.'<br />';
	}
*/
?>