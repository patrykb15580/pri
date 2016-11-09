<div id="side_bar">
	<p class="font-14-px margin-left-10-percent-bottom-10px">Moje konto</p>
	<a id="menu" class="<?= H::promotorCurrentMenu($params, 'actions') ?> promotor_menu_actions" href="/promotors/<?= $params['promotors_id'] ?>">
		<i class="fa fa-product-hunt" aria-hidden="true"></i> Akcje promocyjne
	</a>
	<a id="menu" class="<?= H::promotorCurrentMenu($params, 'stats') ?> promotor_menu_stats" href="/promotors/<?= $params['promotors_id'] ?>/stats">
		<i class="fa fa-line-chart" aria-hidden="true"></i> Statystyki
	</a>
	<a id="menu" class="<?= H::promotorCurrentMenu($params, 'rewards') ?> promotor_menu_rewards" href="/promotors/<?= $params['promotors_id'] ?>/rewards">
		<i class="fa fa-gift" aria-hidden="true"></i> Katalog nagród
	</a>
	<a id="menu" class="<?= H::promotorCurrentMenu($params, 'clients') ?> promotor_menu_clients" href="/promotors/<?= $params['promotors_id'] ?>/clients">
		<i class="fa fa-users" aria-hidden="true"></i> Klienci
	</a>
	<a id="menu" class="<?= H::promotorCurrentMenu($params, 'orders') ?> promotor_menu_orders" href="/promotors/<?= $params['promotors_id'] ?>/orders">
		<i class="fa fa-shopping-basket" aria-hidden="true"></i> Zamówienia
	</a>
	<a id="menu" class="<?= H::promotorCurrentMenu($params, 'info') ?> promotor_menu_info" href="">
		<i class="fa fa-bullhorn" aria-hidden="true"></i> Informacje dla klientów
	</a>
</div>