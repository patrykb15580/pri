<table class="single-table" width="100%">
	<tr>
		<td class="first-row" width="40%">
			Promotor
		</td>
		<td class="first-row" width="20%">
			Data zamówienia
		</td>
		<td class="first-row text_align_right" width="10%">
			Nakład
		</td>
		<td class="first-row text_align_right" width="20%">
			Status
		</td>
	</tr>
	<?php
		foreach (AdminOrder::all(['order'=>'id DESC']) as $order) { 
		$promotor = $order->promotor();
		$path_show = $router->generate('show_admin_order', ['order_id' => $order->id]);?>
			<tr class="result">
				<td width="40%">
					<a href="<?= $path_show ?>">
						<?= $promotor->name ?>
					</a>
				</td>
				<td width="25%">
					<?= $order->order_date ?>	
				</td>
				<td class="text_align_right" width="10%">
					<?= $order->quantity ?>
				</td>
				<td class="text_align_right" width="25%">
					<?= AdminOrder::STATUSES[$order->status] ?>
				</td>
			</tr>
	<?php } ?>
</table>
