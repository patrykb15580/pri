<?php
	$reward = $order->reward();
	$promotor = $reward->promotor();
?>
<h1 style="text-align: center;">Witaj</h1>
<p style="text-align: center; margin: 0px; color: #7D8084;"><?= $reward->prize ?> pkt zostało wymienionych na nagrodę <?= $reward->name ?> u promotota <?= $promotor->name ?>.</p>
<br />
<p style="text-align: center; margin: 0px; color: #7D8084;">Aby sprawdzić szczegóły zamówienia zaloguj się na swoje konto.</p>
<br />
<a href="<?= Config::get('host') ?>/login?hash=<?= $client->hash ?>">
	<button style="display: block;
			margin: 0 auto; 
			background-color: #60C43E;
			text-align: center;
			border: 0px solid;
			border-radius: 3px;
			color: white;
			font-weight: 600;
			font-size: 16px;
			padding: 8px 16px;">
		Przejdź do konta
	</button>
</a>