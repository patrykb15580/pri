<div id="confirm_code_top">
	<div id="code_info_container">
		<img id="code_info_logo" src="/assets/image/booklet-logo.svg">
		<div id="code_info_inline_text">
			<?= $promotor->name ?>
			<br />
			<p class="extra_bold dark_font zero_margin"><?= $promotion_action->name ?></p>
		</div>
	</div>
	<hr class="clear_both">
	<table id="code_info_table" width="100%">
		<tr class="no_border_table">
			<td width="50%">Kod</td>
			<td width="50%">Wartość kodu</td>
		</tr>
		<tr class="no_border_table">
			<td class="dark_font extra_bold medium_font"><?= $params['code'] ?></td>
			<td class="green_font extra_bold medium_font"><?= $package->codes_value ?> ptk</td>
		</tr>
	</table>
</div>
<div id="confirm_code_message" class="green_font">
	<p class="zero_margin bold big_font">Gratulacje,</p>
	<?= $package->codes_value ?> punktów zostało dopisanych do Twojego konta.
</div>
<div id="confirm_code_bottom">
	<b class="dark_font">Sprawdź aktualny stan punktów.</b>
	<br><br>
	Wystarczy kliknąć<br />
	w dowolny link w dowolnej wiadomości email potwierdzającej dodanie punktów.
</div>
<?php	
	$router = Config::get('router');
	$path = $router->generate('start_page', []);
?>
<a class="text_center white_font" href="<?= $path ?>">Powrót</a>
<script type="text/javascript" src="/assets/javascript/hashEmailFormGuardianInitialize.js"></script>