<?php 
foreach ($client->promotors() as $promotor) { 
	$i = 0;
	foreach ($contests as $contest) { 
		if ($contest->promotor_id == $promotor->id) { 
			$i++;
		}
	}
	if ($i !== 0) { 
		$avatar = $promotor->avatar();?>
		<div class="client-view-item-top">
			<?= $promotor->name ?>
		</div>
		<div class="client-view-item-box">
			<?php foreach ($contests as $contest) { 
				if ($contest->promotor_id == $promotor->id) { 
					$question = ($contest->contest())->question; ?>
					<div id="data-box">
						<span><?= $contest->name ?></span><i class="fa fa-angle-down" aria-hidden="true"></i>
						<div class="details">
							<p>Pytanie konkursowe</p>
							<p><b><?= $question ?></b></p>
							<br />							
							<p>Odpowiedź</p>
							<p><b><?= nl2br(($client->contestAnswer($contest->id))->answer) ?></b></p>
						</div>
					</div>
				<?php } 
			} ?>	
		</div>
	<?php } 
}
?>
<!--
<?php 
foreach ($client->promotors() as $promotor) { 
	$i = 0;
	foreach ($contests as $contest) { 
		if ($contest->promotor_id == $promotor->id) { 
			$i++;
		}
	}
	if ($i !== 0) { 
		$avatar = $promotor->avatar();?>
		<div class="client-view-item-top">
			<p class="client-view-item-title"><?= $promotor->name ?></p>
		</div>
		<div class="client-view-item-box">
			<table width="100%">
				<tr>
					<td class="first-row" width="40%">Nazwa konkursu</td>
					<td class="first-row" width="30%">Pytanie</td>
					<td class="first-row" width="30%">Odpowiedź</td>
				</tr>
			<?php foreach ($contests as $contest) { 
				if ($contest->promotor_id == $promotor->id) { 
					$answer = ($contest->contest())->question; ?>
					<tr class="result">
						<td width="40%"><?= $contest->name ?></td>
						<td width="30%"><?= $answer ?></td>
						<td width="30%"><?= nl2br(($client->contestAnswer($contest->id))->answer) ?></td>
					</tr>
				<?php } } ?>
				<tr id="last_row"><td width="40%">Liczba konkursów: <b><?= $i ?></b></td><td width="30%"></td><td width="30%"></td></tr>	
			</table>
		</div>
	<?php } 
}
?>
-->