<?php	
	$path = $router->generate('add_points', ['code'=>$params['code']]);
?>
<div id="use_code_container">
	<div class="use_code_top">
		<img id="use_code_logo" src="/assets/image/booklet-logo.svg"><br />
		<h3 class="none_bold_text zero_margin"><?= $promotor->name ?></h3>
		<h2 class="zero_margin dark_font"><b><?= $promotion_action->name ?></b></h2>
		<table id="use_code">
			<tr class="no_border_table">
				<td class="small_font" width="50%">Twój kod</td>
				<td class="small_font" width="50%">Wartość kodu</td>
			</tr>
			<tr class="no_border_table">
				<td class="dark_font extra_bold medium_font" width="50%"><?= $params['code'] ?></td>
				<td class="green_font extra_bold medium_font" width="50%"><?= $package->codes_value ?> pkt</td>
			</tr>
		</table>
	</div>	
	<form id="use_code" method="POST" action="<?= $path ?>">
		<label>E-mail<p class="zero_margin red_font inline">*</p></label>
		<br />
		<input id="use_code_input" type="email" name="client[email]" required="required">
		<br /><br />
		<label>Imię<p class="zero_margin red_font inline">*</p></label>
		<br />
		<input id="use_code_input" type="text" name="client[name]" required="required">
		<br /><br />
		<label>Telefon<p class="zero_margin red_font inline">*</p></label>
		<br />
		<input id="use_code_input" type="text" name="client[phone_number]" required="required">
		<br />
		<input id="static_pages_submit" type="submit" value="Dodaj punkty">
	</form>	
</div>
<script type="text/javascript" src="/assets/javascript/useCodeFormGuardianInitialize.js"></script>