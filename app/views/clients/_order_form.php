<?php
	$router = Config::get('router');

	$promotor = $reward->promotor();

	$path = $router->generate('get_reward', ['client_id' => $params['client_id'], 'reward_id' => $params['reward_id']]);
	$prev_page = $router->generate('client_index_rewards', ['client_id' => $params['client_id'], 'promotors_id' => $promotor->id]);
?>
<div class="client-view-item-box">
<?php
	if ($points_balance->balance<$reward->prize) { ?>
		<div class="client-order-error">Niewystarczająca ilość punktów</div>
		<?php include '_order_form_table.php';	
	} else { 
		include '_order_form_table.php';?>
		<form class="client-order-form" method="POST" action="<?= $path ?>">
			Saldo po: <b><?= $points_balance->balance - $reward->prize ?> pkt</b><br /><br />
			Uwagi do zamówienia
			<br /><textarea rows="6" name="order[comment]"></textarea>
			<br /><br /><input class="form-page-button" type="submit" value="Zamawiam"> <a href="<?= $prev_page ?>">Anuluj i wróć do listy nagród</a>
		</form>
	<?php }
?>
</div>