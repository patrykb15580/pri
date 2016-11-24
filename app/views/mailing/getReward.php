<?php
	$reward = $order->reward();
	$promotor = $reward->promotor();
?>
Get reward test<br />
Order id: <?= $order->id ?><br />
Promotor: <?= $promotor->name ?><br />
Reward: <?= $reward->name ?>