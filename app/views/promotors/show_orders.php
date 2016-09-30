<?php
	
?>	
<h1 id="show_top_title">Zamówienie nr <?= $order->id ?></h1>
<br /><br />
Status: <b><?= Order::STATUSES[$order->status] ?></b><br />
Klient: <b><?= $client->name ?></b><br />
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
			<?php if (!empty($image)) { ?><img src="/system/reward_images/<?= $image->id ?>/tiny/<?= $image->file_name ?>"><?php } ?>
		</td>
		<td width="80%">
			<b><?= $reward->name ?></b><br />
			<?= StringUntils::truncate($reward->description, 220) ?>
		</td>
	</tr>
</table><br />
<?php
	if (!empty($order->comment)) { ?>
		Dodatkowe informacje:<br />
		<?= $order->comment ?>
	<?php } ?>
<br /><br />

