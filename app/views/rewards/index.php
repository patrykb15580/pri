<?php
	$router = Config::get('router');
	$path_new = $router->generate('new_rewards', ['promotors_id' => $params['promotors_id']]);
	
	$items_number = count($promotor->rewards());
	#echo "<pre>";
	#die(print_r($active_actions));

	if (isset($params['notice'])) { ?>
		<div id="notice">
			<p id="notice-text"><i class="fa fa-info-circle" aria-hidden="true"></i> W tym panelu możesz ...</p>
			<button type="button" class="close-notice" data-dismiss="alert" aria-hidden="true">
				<i class="fa fa-times" aria-hidden="true"></i>
			</button>
		</div>
	<?php }
?>	

<div id="title-box">
	<i class="fa fa-gift title-box-icon red-icon" aria-hidden="true"></i><p class="title-box-text"> Katalog nagród</p>
</div>
<div id="title-box-options-bar">
	<a href="<?= $path_new ?>"><button class="options-bar-button">Nowa nagroda</button></a>
</div>

<select id="select-tab">
	<option value="tab-1">
		Aktywne
	</option>
	<option value="tab-2">
		Nieaktywne
	</option>
	<option value="tab-3">
		Wszystkie
	</option>
</select>

<div id="tab-1-content" class="tab-content">
	<?php 
		$rewards = $promotor->activeRewards();
		
		if (count($rewards) == 0 && $items_number !== 0) {
			include 'app/views/layouts/_no_results.php';
		} else if ($items_number == 0) {
			include 'app/views/rewards/_make_first.php';
		} else include 'app/views/rewards/_rewards.php';
	?>
</div>
<div id="tab-2-content" class="tab-content">
	<?php 
		$rewards = $promotor->inactiveRewards();
		
		if (count($rewards) == 0 && $items_number !== 0) {
			include 'app/views/layouts/_no_results.php';
		} else if ($items_number == 0) {
			include 'app/views/rewards/_make_first.php';
		} else include 'app/views/rewards/_rewards.php';
	?>
</div>
<div id="tab-3-content" class="tab-content">
	<?php 
		$rewards = $promotor->rewards();
		
		if ($items_number == 0) {
			include 'app/views/rewards/_make_first.php';
		} else include 'app/views/rewards/_rewards.php';
	?>
</div>

<div id="reward-catalog-example">
	<h1 class="title">
		Przykładoy katalog nagród
	</h1>
	<table>
		<tr>
			<td>

			</td>
			<td>
				Nazwa nagrody
			</td>
			<td>
				Cena
			</td>
		</tr>
		<tr>
			<td>
				<img src="/assets/image/image-placeholder.png">
			</td>
			<td>
				<b>Voucher - bon 25zł</b>
			</td>
			<td>
				100 pkt
			</td>
		</tr>
		<tr>
			<td>
				<img src="/assets/image/image-placeholder.png">
			</td>
			<td>
				<b>Voucher - zniżka 20%</b>
			</td>
			<td>
				160 pkt
			</td>
		</tr>
		<tr>
			<td>
				<img src="/assets/image/image-placeholder.png">
			</td>
			<td>
				<b>Wysyłka gratis</b>
			</td>
			<td>
				50 pkt
			</td>
		</tr>
		<tr>
			<td>
				<img src="/assets/image/image-placeholder.png">
			</td>
			<td>
				<b>Drugi produkt gratis</b>
			</td>
			<td>
				400 pkt
			</td>
		</tr>
	</table>
</div>
