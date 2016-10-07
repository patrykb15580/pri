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
			$path_edit = $router->generate('show_promotor', ['promotor_id'=>$promotor->id]);?>
			<tr>
				<td width="70%">
					<a href="<?= $path_edit ?>"><?= $promotor->name ?></a>
				</td>
				<td width="20%">
					<?= count($promotor->promotionActions()) ?>
				</td>
				<td width="10%">
					<?= count($promotor->clients()) ?>
				</td>
			</tr>
		<?php } ?>
</table>