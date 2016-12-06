<?php
	$router = Config::get('router');
	$path_edit = $router->generate('edit_promotor_by_admin', ['promotors_id' => $params['promotor_id']]);
?>	
<div id="title-box">
	<i class="fa fa-user title-box-icon light-purple-icon" aria-hidden="true"></i><p class="title-box-text"><?= $promotor->name ?></p>
</div>
<div id="title-box-options-bar">
	<a href="<?= $path_edit ?>"><button class="options-bar-button">Edytuj</button></a>
</div>
<select id="select-tab">
	<option value="tab-1">Akcje promocyjne</option>
	<option value="tab-2">Konkurs</option>
	<option value="tab-3">Statystyki</option>
	<option value="tab-4">Nagrody</option>
	<option value="tab-5">Klienci</option>
	<option value="tab-6">Zamówienia</option>
</select>

<div id="tab-1-content" class="tab-content">
	<?php
		$promotion_actions = $promotor->promotionActions(['order'=>'id DESC']);
		if (count($promotion_actions) == 0) {
			include 'app/views/layouts/_no_results.php';
		} else {
			include '_promotor_actions.php';
		}
	?>
</div>
<div id="tab-2-content" class="tab-content">
	<?php
		$contests = $promotor->contests(['order'=>'id DESC']);
		if (count($contests) == 0) {
			include 'app/views/layouts/_no_results.php';
		} else {
			include '_promotor_contests.php';
		}
	?>
</div>
<div id="tab-3-content" class="tab-content">
	<?php
		include 'app/views/layouts/_no_results.php';
	?>
</div>
<div id="tab-4-content" class="tab-content">
	<?php
		$rewards = $promotor->rewards();
		if (count($rewards) == 0) {
			include 'app/views/layouts/_no_results.php';
		} else {
			include '_promotor_rewards.php';
		}
	?>
</div>
<div id="tab-5-content" class="tab-content">
	<?php
		$rewards = $promotor->rewards();
		if (count($rewards) == 0) {
			include 'app/views/layouts/_no_results.php';
		} else {
			include '_promotor_clients.php';
		}
	?>
</div>
<div id="tab-6-content" class="tab-content">
	<?php
		$orders = $promotor->orders();
		if (count($orders) == 0) {
			include 'app/views/layouts/_no_results.php';
		} else {
			include '_promotor_orders.php';
		}
	?>
</div>
