<table width="100%">
	<tr>
		<td class="first-row" width="50%">
			Promotor
		</td>
		<td class="first-row" width="35%">
			Data zamówienia
		</td>
		<td class="first-row text_align_right" width="15%">
			Nakład
		</td>
	</tr>
	<?php
		foreach ($orders as $order) { 
		$promotor = $order->promotor();
		$path_show = $router->generate('show_admin_order', ['order_id' => $order->id]);?>
			<tr class="result">
				<td width="50%">
					<a href="<?= $path_show ?>">
						<?= $promotor->name ?>
					</a>
				</td>
				<td width="35%">
					<?= $order->order_date ?>	
				</td>
				<td class="text_align_right" width="15%">
					<?= $order->quantity ?>
				</td>
			</tr>
	<?php } ?>
</table>
