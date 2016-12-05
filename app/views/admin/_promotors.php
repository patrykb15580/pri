<table class="single-table" width="100%">
	<tr>
		<td class="first-row" width="50%">
			Nazwa promotora
		</td>
		<td class="first-row text_align_right" width="20%">
			Akcji promocyjnych
		</td>
		<td class="first-row text_align_right" width="20%">
			Konkursów
		</td>
		<td class="first-row text_align_right" width="10%">
			Klientów
		</td>
	</tr>
	<?php
		foreach ($promotors as $promotor) { 
			$path_edit = $router->generate('show_promotor', ['promotor_id'=>$promotor->id]);?>
			<tr class="result">
				<td width="50%">
					<a href="<?= $path_edit ?>"><?= $promotor->name ?></a>
				</td>
				<td class="text_align_right" width="20%">
					<?= count($promotor->promotionActions()) ?>
				</td>
				<td class="text_align_right" width="20%">
					<?= count($promotor->contests()) ?>
				</td>
				<td class="text_align_right" width="10%">
					<?= count($promotor->clients()) ?>
				</td>
			</tr>
		<?php } ?>
</table>