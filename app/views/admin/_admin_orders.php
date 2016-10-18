<?php
foreach ($promotors as $promotor) { 
	if (!empty($promotor->promotorOrders())) { ?>
		<h3><?= $promotor->name ?></h3>
			<table width="100%">
				<tr>
					<td id="first_row" width="20%">
						Nazwa paczki
					</td>
					<td id="first_row" width="35%">
						Data zamówienia
					</td>
					<td id="first_row" width="10%">
						Nakład
					</td>
					<td id="first_row" width="15%">
						Typ
					</td>
					<td id="first_row" width="20%">
						Status
					</td>
				</tr>
			<?php
			foreach ($promotor->promotorOrders() as $order) { 
			$path_show = $router->generate('show_admin_order', ['order_id' => $order->id]);?>
				<tr class="result">
					<td width="20%">
						<a href="<?= $path_show ?>">
							<?= $order->package()->name ?>
						</a>
					</td>
					<td width="35%">
						<?= $order->order_date ?>	
					</td>
					<td width="10%">
						<?= $order->quantity ?>
					</td>
					<td width="15%">
						<?= AdminOrder::TYPES[$order->reusable] ?>
					</td>
					<td width="20%">
						<?= AdminOrder::STATUSES[$order->status] ?>
					</td>
				</tr>
			<?php } ?>
			</table><br />
	<?php }
 } ?>
