<table width="100%">
	<tr>
		<td id="first_row" width="60%">
			Nazwa promotora
		</td>
		<td id="first_row" width="20%">
			Akcji promocyjnych
		</td>
		<td id="first_row" width="10%">
			Klientów
		</td>
		<td id="first_row" width="10%">
			
		</td>
	</tr>
	<?php
		foreach ($promotors as $promotor) { 
			$clients_number = count($promotor->clients());
			$promotion_actions_number = count($promotor->promotion_actions());
			$path_edit = $router->generate('edit_promotor_by_admin', ['promotors_id'=>$promotor->id]); ?>
			<tr>
				<td width="60%">
					<?= $promotor->name ?>
				</td>
				<td width="20%">
					<?= $promotion_actions_number ?>
				</td>
				<td width="10%">
					<?= $clients_number ?>
				</td>
				<td width="10%">
					<a href="<?= $path_edit ?>">Edytuj</a>
				</td>
			</tr>
		<?php } ?>
</table>