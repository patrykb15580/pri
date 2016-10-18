<?php
	$router = Config::get('router');
?>	
<h1 id="show_top_title">Zamówienie nr <?= $order->id ?></h1>
<div id="show_top_options">

</div>
<hr>
Promotor: <?= $order->promotor()->name ?>
<br />Paczka kodów: <?= $order->package()->name ?>
<br />Id paczki kodów: <?= $order->package()->id ?>
<br />Status: <?= AdminOrder::STATUSES[$order->status] ?>
<br />Nakład: <?= $order->quantity ?> szt
<br />Typ: <?= AdminOrder::TYPES[$order->reusable] ?>
<br />Data zamówienia: <?= $order->order_date ?>

