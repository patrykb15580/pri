<?php	
	$router = Config::get('router');
	$path = $router->generate('start_page', []);
?>
<div id="confirmation">
	<div class="confirmation-top">
		<p class="confirmation-block-title">
			Promotor
		</p>
		<div class="confirmation-promotor-info">
			<?php
				$avatar = PromotorAvatar::findBy('promotor_id', $promotor->id);
				if (!empty($avatar)) { ?>
					<img class="confirmation-avatar" src="/system/promotor_avatars/<?= $promotor->id ?>/small/<?= $avatar->file_name ?>">
				<?php } 
			?>
			<span>
				<?= $promotor->name ?>
			</span>
		</div>
		<p class="confirmation-block-title">
			Akcja promocyjna
		</p>
		<div class="confirmation-action-name">
			<?= $promotion_action->name ?>
		</div>
		<table>
			<tr>
				<td>
					Twój kod
				</td>
				<td>
					Wartość kodu
				</td>
			</tr>
			<tr>
				<td class="confirmation-code">
					<?= $params['code'] ?>
				</td>
				<td class="confirmation-prize">
					+ <?= $package->codes_value ?> pkt
				</td>
			</tr>
		</table>
	</div>
	<div class="confirmation-message">
		<div>
			<i class="fa fa-smile-o fa-5x" aria-hidden="true"></i>
			<p>Gratulacje,</p>
			punkty zostały dodane do Twojego konta.
		</div>
	</div>

	<a href="<?= $path ?>"><button>Wprowadź następny kod</button></a>
	<a class="link" href="<?= $path ?>">Powrót</a>
</div>


<!--
<div class="confirm-code-top">
	<?php
		$avatar = PromotorAvatar::findBy('promotor_id', $promotor->id);
		if (!empty($avatar)) { ?>
			<img class="code-info-avatar" src="/system/promotor_avatars/<?= $promotor->id ?>/small/<?= $avatar->file_name ?>">
		<?php } else { ?>
			<div class="code-info-avatar"></div>
		<?php } 
	?>
	<div class="code-info-title">
		<?= $promotor->name ?>
		<br />
		<p><?= $promotion_action->name ?></p>
	</div>
	<hr>
	<table class="code-info-table">
		<tr>
			<td class="left-first" width="50%">Kod</td>
			<td class="right-first" width="50%">Wartość kodu</td>
		</tr>
		<tr>
			<td class="left"><?= $params['code'] ?></td>
			<td class="right">+ <?= $package->codes_value ?> pkt</td>
		</tr>
	</table>
</div>
<div class="confirm_code_message" class="green_font">
	<i class="fa fa-smile-o fa-5x" aria-hidden="true"></i>
	<p>Gratulacje,</p>
	punkty zostały dodane do Twojego konta.
</div>
<div class="confirm_code_bottom">
	<a href="<?= $path ?>"><button>Wprowadź następny kod</button></a>
</div>
<a class="text_center white_font" href="<?= $path ?>">Powrót</a>
<script type="text/javascript" src="/assets/javascript/hashEmailFormGuardianInitialize.js"></script>
-->
