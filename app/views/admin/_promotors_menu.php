<div id="admin_menu_box">
	<a href="/admin?action=actions">
		<div id="<?= H::adminCurrentMenu($params, 'actions') ?>">
			Akcje promocyjne
		</div>
	</a>
	<a href="/admin?action=rewards">
		<div id="<?= H::adminCurrentMenu($params, 'rewards') ?>">
			Katalog nagród
		</div>
	</a>
	<a href="/admin?action=clients">
		<div id="<?= H::adminCurrentMenu($params, 'clients') ?>">
			Klienci
		</div>
	</a>
	<a href="/admin?action=orders">
		<div id="<?= H::adminCurrentMenu($params, 'orders') ?>">
			Zamówienia
		</div>
	</a>
</div>

