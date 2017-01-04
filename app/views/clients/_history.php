<div class="client-view-item-box">
	<?php foreach ($histories as $history) { ?> 
		<div id="data-box">
			<span><?= $history->description ?></span><i class="fa fa-angle-down" aria-hidden="true"></i>
			<table class="details">
				<tr>
					<td>
						Promotor
					</td>
					<td>
						<?= ($history->promotor())->name ?>
					</td>
				</tr>
				<tr>
					<td>
						Data utworzenia wpisu
					</td>
					<td>
						<?php 
							$day = date('d', strtotime($date));

							if ($day < 10) {
								$day = number_format($day, 0);
							}

							$month = PolishMonthName::NAMES_VARIETLY[date('m', strtotime($date))];
							$year = date('Y', strtotime($date));

							echo $day.' '.$month.' '.$year; 
						?>
					</td>
				</tr>
				<tr>
					<td>
						Punkty
					</td>
					<td <?php if (intval($history->points) < 0) { echo 'class="red_font"'; } else if (intval($history->points) > 0) { echo 'class="green_font"'; } ?>>
						<?= $history->points ?> pkt
					</td>
				</tr>
				<tr>
					<td>
						Saldo przed
					</td>
					<td>
						<?= $history->balance_before ?> pkt
					</td>
				</tr>
				<tr>
					<td>
						Saldo po
					</td>
					<td>
						<?= $history->balance_after ?> pkt
					</td>
				</tr>
			</table>
		</div>
	<?php } ?>
</div>

<!--
<div class="client-view-item-box">
	<table width="100%">
		<tr>
			<td class="first-row" width="36%"></td>
			<td class="first-row" width="14%">Promotor</td>
			<td class="first-row" width="20%">Kiedy</td>
			<td class="first-row" width="10%">Punkty</td>
			<td class="first-row" width="10%">Saldo przed</td>
			<td class="first-row" width="10%">Saldo po</td>
		</tr>
	<?php foreach ($histories as $history) { ?> 
		<tr class="result">
			<td width="36%"><?= $history->description ?></td>
			<td width="14%"><?= ($history->promotor())->name ?></td>
			<td width="20%"><?= $history->created_at ?></td>
			<td <?php if (intval($history->points) < 0) { echo 'class="red_font"'; } else if (intval($history->points) > 0) { echo 'class="green_font"'; } ?>" width="10%"><?= $history->points ?></td>
			<td width="10%"><?= $history->balance_before ?></td>
			<td width="10%"><?= $history->balance_after ?></td>
		</tr>
	<?php } ?>
	</table>
</div>
-->