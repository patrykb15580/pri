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
<select id="admin-select-tabs">
	<option value="tab-1">Akcje promocyjne</option>
	<option value="tab-2">Konkurs</option>
	<option value="tab-3">Statystyki</option>
	<option value="tab-4">Nagrody</option>
	<option value="tab-5">Klienci</option>
	<option value="tab-6">Zamówienia</option>
</select>
<?php
	#include 'app/views/admin/_promotors_menu.php';
	#include 'app/views/admin/_show_promotor.php'
?>

<div id="admin-tab-1-content">
	<?php
		include '_promotor_actions.php';
	?>
</div>
<div id="admin-tab-2-content">
	<?php
		include '_promotor_contests.php';
	?>
</div>
<div id="admin-tab-3-content">
	
</div>
<div id="admin-tab-4-content">
	<?php
		include '_promotor_rewards.php';
	?>
</div>
<div id="admin-tab-5-content">
	<?php
		include '_promotor_clients.php';
	?>
</div>
<div id="admin-tab-6-content">
	<?php
		include '_promotor_orders.php';
	?>
</div>

