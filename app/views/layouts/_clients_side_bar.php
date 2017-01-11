<div id="side_bar">
	<?php
		if ($client->password_digest == Password::encryptPassword('')) { ?>
			<div class="set-password-info">
				Aby móc logować się za pomocą loginu i hasła ustaw swoje hasło.
			</div>
		<?php }
	?>
	<a id="menu" class="<?= H::clientCurrentMenu($params, 'actions') ?> client_menu_actions" href="/clients/<?= $params['client_id'] ?>">
		<i class="fa fa-bullhorn" aria-hidden="true"></i> Akcje promocyjne
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
		<i class="fa fa-qrcode" aria-hidden="true"></i> Wprowadź kod
	</a>
	<a id="menu" class="<?= H::clientCurrentMenu($params, 'account') ?> client_menu_account" href="<?= $router->generate('edit_client', ['client_id'=>$params['client_id']]) ?>">
		<i class="fa fa-cog fa-lg" aria-hidden="true"></i> Ustawienia konta
	</a>
	<a id="menu" class="<?= H::clientCurrentMenu($params, 'sign-out') ?> client_menu_logout" href="<?= $router->generate('sign_out', []) ?>">
		<i class="fa fa-sign-out" aria-hidden="true"></i> <span>Wyloguj</span>
	</a>
</div>
