<div id="side_bar">
	<a id="menu" class="<?= H::promotorCurrentMenu($params, 'actions') ?> promotor_menu_actions" href="/promotors/<?= $params['promotors_id'] ?>">
		<i class="fa fa-product-hunt" aria-hidden="true"></i> <span>Akcje promocyjne</span>
	</a>
	<a id="menu" class="<?= H::promotorCurrentMenu($params, 'contests') ?> promotor_menu_actions" href="/promotors/<?= $params['promotors_id'] ?>/contests">
		<i class="fa fa-trophy" aria-hidden="true"></i> <span>Konkursy</span>
	</a>
	<a id="menu" class="<?= H::promotorCurrentMenu($params, 'stats') ?> promotor_menu_stats" href="/promotors/<?= $params['promotors_id'] ?>/stats">
		<i class="fa fa-line-chart" aria-hidden="true"></i> <span>Statystyki</span>
	</a>
	<a id="menu" class="<?= H::promotorCurrentMenu($params, 'rewards') ?> promotor_menu_rewards" href="/promotors/<?= $params['promotors_id'] ?>/rewards">
		<i class="fa fa-gift" aria-hidden="true"></i> <span>Katalog nagród</span>
	</a>
	<a id="menu" class="<?= H::promotorCurrentMenu($params, 'clients') ?> promotor_menu_clients" href="/promotors/<?= $params['promotors_id'] ?>/clients">
		<i class="fa fa-users" aria-hidden="true"></i> <span>Klienci</span>
	</a>
	<a id="menu" class="<?= H::promotorCurrentMenu($params, 'orders') ?> promotor_menu_orders" href="/promotors/<?= $params['promotors_id'] ?>/orders">
		<i class="fa fa-shopping-basket" aria-hidden="true"></i> <span>Zamówienia</span>
	</a>
	<a id="menu" class="<?= H::promotorCurrentMenu($params, 'info') ?> promotor_menu_info" href="">
		<i class="fa fa-bullhorn" aria-hidden="true"></i> <span>Regulamin</span>
	</a>
</div>
