<table width="100%">
	<tr>
		<td id="first_row" width="70%">
			Nazwa promotora
		</td>
		<td id="first_row" width="20%">
			Akcji promocyjnych
		</td>
		<td id="first_row" width="10%">
			Klientów
		</td>
	</tr>
	<?php
		foreach ($promotors as $promotor) { 
			$clients_number = count($promotor->clients());
			$promotion_actions_number = count($promotor->promotion_actions()); ?>
			<tr>
				<td width="70%">
					<?= $promotor->name ?>
				</td>
				<td width="20%">
					<?= $promotion_actions_number ?>
				</td>
				<td width="10%">
					<?= $clients_number ?>
				</td>
			</tr>
		<?php } ?>
</table>