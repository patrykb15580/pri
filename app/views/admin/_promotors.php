<table width="100%">
	<tr>
		<td class="first-row" width="70%">
			Nazwa promotora
		</td>
		<td class="first-row" width="20%">
			Akcji promocyjnych
		</td>
		<td class="first-row" width="10%">
			Klientów
		</td>
	</tr>
	<?php
		foreach ($promotors as $promotor) { 
			$path_edit = $router->generate('show_promotor', ['promotor_id'=>$promotor->id]);?>
			<tr class="result">
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