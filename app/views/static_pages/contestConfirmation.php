<?php	
	$router = Config::get('router');
	$path = $router->generate('app', []);
	$contest = $promotion_action->contest();
	
	$day = date('d', strtotime($contest->to_at));
	$month = PolishMonthName::NAMES_VARIETLY[date('m', strtotime($contest->to_at))];
	$year = date('Y', strtotime($contest->to_at));

	if ($day < 10) {
		$day = str_replace('0', '', $day);
	}

	$end_date = $day.' '.$month.' '.$year.'r';
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
			Konkurs
		</p>
		<div class="confirmation-action-name">
			<?= $promotion_action->name ?>
		</div>
	</div>
	<div class="confirmation-message">
		<div>
			<i class="fa fa-smile-o fa-5x" aria-hidden="true"></i><br />
			Dziękujemy za wzięcie udziału w konkursie.<br /><br />
			O wynikach konkursu zostaniesz poinformowany mailowo <br />
			<b><?= $end_date ?></b>.
		</div>
	</div>

	<a class="link" href="<?= $path ?>">Przejdź do strony głównej</a>
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
			<td class="left-first" width="100%">Kod</td>
		</tr>
		<tr>
			<td class="left"><?= $params['code'] ?></td>
		</tr>
	</table>
</div>
<div class="confirm_code_message" class="green_font">
	<i class="fa fa-smile-o fa-5x" aria-hidden="true"></i>
	<br />
	Dziękujemy za wzięcie udziału w konkursie.
</div>
<div class="confirm_code_bottom">
	<a href="<?= $path ?>"><button>Wprowadź następny kod</button></a>
</div>
<a class="text_center white_font" href="<?= $path ?>">Powrót</a>
<script type="text/javascript" src="/assets/javascript/hashEmailFormGuardianInitialize.js"></script>
-->