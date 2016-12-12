<?php 
	$router = Config::get('router');
	$action = $code->action();
	$avatar = $promotor->avatar();
	$code_value = $code->codeValue();
?>
<img style="display: block; width: 80px; height: 80px; margin: 0 auto;" src="<?= Config::get('host') ?>/static/smile.png" alt="smile">
<div style="color: #61C63F; margin: 0px 0px 15px 0px;">
	<p style="margin: 0px 0px 6px 0px; text-align: center; font-weight: 700; font-size: 36px;">Gratulacje</p>
	<p style="margin: 0px; text-align: center; font-weight: 700; font-size: 24px;">+ <?= $code_value ?> pkt</p>
	<p style="margin: 0px; text-align: center; font-weight: 700; font-size: 16px;"><?php if ($code_value > 1) { echo "zostało dodanych"; } else echo "został dodany"; ?> do Twojego konta w ramach akcji:</p>
</div>
<?php
	if (!empty($avatar)) { ?>
		<img style="display: block; width: 50px; height: 50px; margin: 2px auto;" src="<?= Config::get('host') ?>/system/promotor_avatars/<?= $promotor->id ?>/small/<?= $avatar->file_name ?>" alt="<?= $promotor->name ?>">
	<?php } else { ?>
		<div style="display: block; background-color: #E3EBF3; width: 50px; height: 50px; margin: 2px auto;"></div>
	<?php }
?>
<p style="margin: 0px; text-align: center; color: #373D42; font-size: 18px; font-weight: 700;"><?= $action->name ?></p>
<p style="text-align: center; margin: 0px; color: #7D8084;"><?= $promotor->name ?></p>
<br />
<br />
<p style="text-align: center; margin: 0px; color: #7D8084;">Sprawdź aktualny stan punktów</p>
<br />
<a href="<?= Config::get('host') ?>/login?hash=<?= $client->hash ?>">
	<button style="display: block;
			margin: 0 auto; 
			background-color: #60C43E;
			text-align: center;
			border: 0px solid;
			border-radius: 3px;
			color: white;
			font-weight: 600;
			font-size: 16px;
			padding: 8px 16px;">
		Przejdź do konta
	</button>
</a>
