<?php
	$router = Config::get('router');
?>	
<div id="title-box">
	<i class="fa fa-shopping-basket title-box-icon dark-green-icon" aria-hidden="true"></i><p class="title-box-text">Zamówienie #<?= $order->id ?></p>

	<br /><br />
	<p class="title-box-details">
		Status: <b><?= Order::STATUSES[$order->status] ?></b><br />
		Klient: <b><?= $order->client()->name ?></b><br />
	</p>
</div>

<br /><br />

<table width="100%">
	<tr class="result">
		<td class="first-row" width="20%">
			
		</td>
		<td class="first-row" width="80%">
			
		</td>
	</tr>
	<tr class="result">
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

