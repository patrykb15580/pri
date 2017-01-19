<div id="side_bar">
	<a id="menu" class="<?= H::promotorCurrentMenu($params, 'actions') ?> promotor_menu_actions" href="/promotors/<?= $params['promotors_id'] ?>">
		<i class="fa fa-bullhorn" aria-hidden="true"></i> <span>Akcje promocyjne</span>
	</a>
	<a id="menu" class="<?= H::promotorCurrentMenu($params, 'contests') ?> promotor_menu_actions" href="/promotors/<?= $params['promotors_id'] ?>/contests">
		<i class="fa fa-trophy" aria-hidden="true"></i> <span>Konkursy</span>
	</a>
	<a id="menu" class="<?= H::promotorCurrentMenu($params, 'opinions') ?> promotor_menu_opinions" href="/promotors/<?= $params['promotors_id'] ?>/opinions">
		<i class="fa fa-star" aria-hidden="true"></i> <span>Opinie</span>
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
	<a id="menu" class="<?= H::promotorCurrentMenu($params, 'mailing') ?> promotor_menu_mailing" href="/promotors/<?= $params['promotors_id'] ?>/mailing">
		<i class="fa fa-envelope-open-o" aria-hidden="true"></i> <span>Mailing</span>
	</a>
	<a id="menu" class="<?= H::promotorCurrentMenu($params, 'info') ?> promotor_menu_info" href="">
		<i class="fa fa-file-text-o" aria-hidden="true"></i> <span>Regulamin</span>
	</a>
	<a id="menu" class="<?= H::promotorCurrentMenu($params, 'account') ?> promotor_menu_account" href="<?= $router->generate('edit_promotor', ['promotors_id'=>$params['promotors_id']]) ?>">
		<i class="fa fa-cog fa-lg" aria-hidden="true"></i> Ustawienia konta
	</a>
	<a id="menu" class="<?= H::promotorCurrentMenu($params, 'sign-out') ?> promotor_menu_logout" href="<?= $router->generate('sign_out', []) ?>">
		<i class="fa fa-sign-out" aria-hidden="true"></i> <span>Wyloguj</span>
	</a>
</div>
