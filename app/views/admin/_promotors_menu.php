<div id="admin_menu_box">
	<a href="/admin/promotor/<?= $params['promotor_id'] ?>?show=actions">
		<div id="<?= H::adminCurrentMenu($params, 'actions') ?>">
			Akcje promocyjne
		</div>
	</a>
	<a href="/admin/promotor/<?= $params['promotor_id'] ?>?show=rewards">
		<div id="<?= H::adminCurrentMenu($params, 'rewards') ?>">
			Katalog nagród
		</div>
	</a>
	<a href="/admin/promotor/<?= $params['promotor_id'] ?>?show=clients">
		<div id="<?= H::adminCurrentMenu($params, 'clients') ?>">
			Klienci
		</div>
	</a>
	<a href="/admin/promotor/<?= $params['promotor_id'] ?>?show=orders">
		<div id="<?= H::adminCurrentMenu($params, 'orders') ?>">
			Zamówienia
		</div>
	</a>
</div>
