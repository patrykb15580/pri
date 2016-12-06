<?php
	$router = Config::get('router');
?>	
<div id="title-box">
	<i class="fa fa-shopping-basket title-box-icon dark-green-icon" aria-hidden="true"></i><p class="title-box-text">Zamówienia</p>
</div>

<select id="select-tab">
	<option value="tab-1">Wszystkie</option>
	<option value="tab-2">Oczekujące</option>
	<option value="tab-3">W trakcie realizacji</option>
	<option value="tab-4">Wysłane</option>
	<option value="tab-5">Zrealizowane</option>
	<option value="tab-6">Anulowane</option>
</select>

<div id="tab-1-content" class="tab-content">
	<?php
		$orders = AdminOrder::all(['order'=>'id DESC']);
		if (count($orders) == 0) {
			include 'app/views/layouts/_no_results.php';
		} else {
			include '_admin_orders.php';
		}
	?>
</div>
<div id="tab-2-content" class="tab-content">
	<?php
		$orders = AdminOrder::waitingOrders(['order'=>'id DESC']);
		if (count($orders) == 0) {
			include 'app/views/layouts/_no_results.php';
		} else {
			include '_waiting_orders.php';
		}
	?>
</div>
<div id="tab-3-content" class="tab-content">
	<?php
		$orders = AdminOrder::activeOrders(['order'=>'id DESC']);
		if (count($orders) == 0) {
			include 'app/views/layouts/_no_results.php';
		} else {
			include '_active_orders.php';
		}
	?>
</div>
<div id="tab-4-content" class="tab-content">
	<?php
		$orders = AdminOrder::sentOrders(['order'=>'id DESC']);
		if (count($orders) == 0) {
			include 'app/views/layouts/_no_results.php';
		} else {
			include '_sent_orders.php';
		}
	?>
</div>
<div id="tab-5-content" class="tab-content">
	<?php
		$orders = AdminOrder::completedOrders(['order'=>'id DESC']);
		if (count($orders) == 0) {
			include 'app/views/layouts/_no_results.php';
		} else {
			include '_completed_orders.php';
		}
	?>
</div>
<div id="tab-6-content" class="tab-content">
	<?php
		$orders = AdminOrder::canceledOrders(['order'=>'id DESC']);
		if (count($orders) == 0) {
			include 'app/views/layouts/_no_results.php';
		} else {
			include '_canceled_orders.php';
		}
	?>
</div>


	