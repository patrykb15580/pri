<div id="side_bar">
	<a id="menu" class="<?= H::clientCurrentMenu($params, 'actions') ?> client_menu_actions" href="/clients/<?= $params['client_id'] ?>">
		<i class="fa fa-product-hunt" aria-hidden="true"></i> Akcje promocyjne
	</a>
	<a id="menu" class="<?= H::clientCurrentMenu($params, 'contests') ?> client_menu_actions" href="/clients/<?= $params['client_id'] ?>/contests">
		<i class="fa fa-trophy" aria-hidden="true"></i> Konkursy
	</a>
	<!--
	<a id="menu" class="<?= H::clientCurrentMenu($params, 'orders') ?> client_menu_orders" href="/clients/<?= $params['client_id'] ?>/orders">
		<i class="fa fa-shopping-basket" aria-hidden="true"></i> Zamówienia
	</a>
	-->
	<a id="menu" class="<?= H::clientCurrentMenu($params, 'history') ?> client_menu_history" href="/clients/<?= $params['client_id'] ?>/history">
		<i class="fa fa-history" aria-hidden="true"></i> Historia
	</a>
	<a id="menu" class="<?= H::clientCurrentMenu($params, 'code') ?> client_menu_code" href="/clients/<?= $params['client_id'] ?>/code">
		<i class="fa fa-ticket" aria-hidden="true"></i> Wprowadź kod
	</a>
</div>
