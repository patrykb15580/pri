<div id="admin_menu_box">
	<a href="/admin/promotor/<?= $params['promotor_id'] ?>?show=actions">
		<div id="<?= H::adminPromotorsCurrentMenu($params, 'actions') ?>">
			Akcje promocyjne
		</div>
	</a>
	<a href="/admin/promotor/<?= $params['promotor_id'] ?>?show=stats">
		<div id="<?= H::adminPromotorsCurrentMenu($params, 'stats') ?>">
			Statystyki
		</div>
	</a>
	<a href="/admin/promotor/<?= $params['promotor_id'] ?>?show=rewards">
		<div id="<?= H::adminPromotorsCurrentMenu($params, 'rewards') ?>">
			Katalog nagród
		</div>
	</a>
	<a href="/admin/promotor/<?= $params['promotor_id'] ?>?show=clients">
		<div id="<?= H::adminPromotorsCurrentMenu($params, 'clients') ?>">
			Klienci
		</div>
	</a>
	<a href="/admin/promotor/<?= $params['promotor_id'] ?>?show=orders">
		<div id="<?= H::adminPromotorsCurrentMenu($params, 'orders') ?>">
			Zamówienia
		</div>
	</a>
</div>
