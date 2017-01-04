<?php
	$router = Config::get('router');
?>
<div id="side_bar">
	<a id="menu" class="<?= H::adminCurrentMenu($params, 'promotors') ?> admin_menu_promotors" href="/admin">
		<i class="fa fa-users" aria-hidden="true"></i> Promotorzy
	</a>
	<a id="menu" class="<?= H::adminCurrentMenu($params, 'orders') ?> admin_menu_orders" href="/admin/orders">
		<i class="fa fa-shopping-basket" aria-hidden="true"></i> Zamówienia
	</a>
	<a id="menu" class="<?= H::adminCurrentMenu($params, 'stats') ?> admin_menu_stats" href="">
		<i class="fa fa-line-chart" aria-hidden="true"></i> Statystyki
	</a>
	<a id="menu" class="<?= H::adminCurrentMenu($params, 'sign-out') ?> admin_menu_logout" href="<?= $router->generate('sign_out', []) ?>">
		<i class="fa fa-sign-out" aria-hidden="true"></i> <span>Wyloguj</span>
	</a>
</div>
