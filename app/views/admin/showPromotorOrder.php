<?php
	$router = Config::get('router');
?>	
<h2 id="show_top_title">
	<a href="<?= $router->generate('show_promotor', ['promotor_id' => $params['promotor_id']]) ?>" id="link_underline">
		<?= $promotor->name ?>
	</a> > 
	<a href="<?= $router->generate('show_promotor', ['promotor_id' => $params['promotor_id']]).'?show=orders' ?>" id="link_underline">
		Zamówienia
	</a> > Zamówienie nr <?= $order->id ?>
</h2>
<br /><br />
Status: <b><?= Order::STATUSES[$order->status] ?></b><br />
Klient: <b><?= $order->client()->name ?></b><br />
<table width="100%">
	<tr>
		<td width="20%">
			Nagroda:
		</td>
		<td width="80%">
			
		</td>
	</tr>
	<tr>
		<td width="20%">
			<?php if (!empty($order->reward()->singleImage())) { ?><img src="/system/reward_images/<?= $order->reward()->singleImage()->id ?>/tiny/<?= $order->reward()->singleImage()->file_name ?>"><?php } ?>
		</td>
		<td width="80%">
			<b><?= $order->reward()->name ?></b><br />
			<?= StringUntils::truncate($order->reward()->description, 220) ?>
		</td>
	</tr>
</table><br />
<?php
	if (!empty($order->comment)) { ?>
		Dodatkowe informacje:<br />
		<?= $order->comment ?>
	<?php } ?>
<br /><br />

