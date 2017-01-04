<?php
	$router = Config::get('router');
	$prev_page = $router->generate('index_promotors_orders', ['promotors_id' => $params['promotors_id']]);
	$client = $order->client();
	if (empty($client->name)) {
		$client_name = explode('@', $client->email);
		$client_name = $client_name[0];
	} else {
		$client_name = $client->name;
	}

	if (isset($params['notice'])) { ?>
		<div id="notice" data-cookie="show_orders_promotor_view">
			<p id="notice-text"><i class="fa fa-info-circle" aria-hidden="true"></i> W tym panelu możesz ...</p>
			<button type="button" class="close-notice" data-dismiss="alert" aria-hidden="true">
				<i class="fa fa-times" aria-hidden="true"></i>
			</button>
		</div>
	<?php }
?>
<div id="title-box">
 	<a href="<?= $prev_page ?>"><button class="prev-page-button"><i class="fa fa-chevron-left" aria-hidden="true"></i> Wstecz</button></a>
	<i class="fa fa-shopping-basket title-box-icon dark-green-icon" aria-hidden="true"></i><p class="title-box-text"> Zamówienie nr <?= $order->id ?></p>
	<br />
	<br />
	<p class="title-box-details">
		Status: <b><?= Order::STATUSES[$order->status] ?></b><br />
		Klient: <b><?= $client_name ?></b><br />
	</p>
</div>

<table class="single-table">
	<tr class="result">
		<td class="result" width="20%">
			Nagroda:
		</td>
		<td class="result" width="40%">
			
		</td>
		<td class="result" width="40%">
			Dodatkowe informacje
		</td>
	</tr>
	<tr class="result">
		<td class="result" width="20%">
			<?php if (!empty($image)) { ?><img src="/system/reward_images/<?= $image->id ?>/small/<?= $image->file_name ?>"><?php } ?>
		</td>
		<td class="result" width="40%">
			<b><?= $reward->name ?></b><br />
			<?= StringUntils::truncate($reward->description, 220) ?>
		</td>
		<td class="result" width="40%">
			<?php
				if (!empty($order->comment)) { ?>
					<?= $order->comment ?>
				<?php } 
			?>	
		</td>
	</tr>
</table>



