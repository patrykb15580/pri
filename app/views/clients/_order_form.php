<?php
	$router = Config::get('router');

	$path = $router->generate('get_reward', ['client_id' => $params['client_id'], 'reward_id' => $params['reward_id']]);
	if ($points_balance->balance<$reward->prize) { ?>
			<div id="error_message">Niewystarczająca ilość punktów</div>
			<br />
		<?php include __DIR__.'/_order_form_table.php';	
	} else { ?>
		<form method="POST" action="<?= $path ?>">
			<?php include __DIR__.'/_order_form_table.php'; ?>
			Saldo po: <?= $points_balance->balance - $reward->prize ?> pkt<br /><br />
			Dodatkowe uwagi dla <?= $promotor->name ?>
			<br /><textarea rows="6" name="order[comment]"></textarea>
			<br /><br /><input type="submit" value="Złóż zamówienie">
		</form>
	<?php }?>