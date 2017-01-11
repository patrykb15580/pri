<?php
	$router = Config::get('router');

	$promotor = $reward->promotor();

	$path = $router->generate('get_reward', ['client_id' => $params['client_id'], 'reward_id' => $params['reward_id']]);
	$prev_page = $router->generate('client_index_rewards', ['client_id' => $params['client_id'], 'promotors_id' => $promotor->id]);
	$image = $reward->singleImage();
?>
<div class="client-view-order-box">
	<div class="details">
		<p class="promotor">
			<?= $promotor->name ?>
		</p>
		<div class="reward-info">
			<?php if (!empty($image)) { ?>
				<img class="reward-img" src="/system/reward_images/<?= $image->id ?>/very_small/<?= $image->file_name ?>">
			<?php } else { ?>
				<div class="reward-img"><i class="fa fa-picture-o" aria-hidden="true"></i></div>
			<?php } ?>

			<div class="reward-name">
				<?= $reward->name ?>
			</div>
			<div class="reward-description">
				<?= $reward->description ?>
			</div>
			<div class="balance">
				Saldo po: <span><?= $points_balance->balance - $reward->prize ?> pkt</span>
			</div>
		</div>
	</div>
	<form method="POST" action="<?= $path ?>">
		Uwagi do zamówienia
		<br /><textarea rows="8" name="order[comment]"></textarea>
		<br /><br />
		<input class="" type="submit" value="Zamawiam">
		<a href="<?= $prev_page ?>">Anuluj i wróć do listy nagród</a>
	</form>
</div>

<!--
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
-->