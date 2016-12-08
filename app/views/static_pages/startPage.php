<?php
	$path = $router->generate('enter_code', []);	
	$codes = Code::where('used IS NULL', [], ['order'=>'created_at DESC']);
	$actions_codes = [];
	$contests_codes = [];
	foreach ($codes as $code) { 
		$action = $code->action();
		if ($action->type == 'PromotionActions') {
	 	array_push($actions_codes, $code);
		} else { 
			array_push($contests_codes, $code); 
		}
	}
?>
<h1 id="main_page_site_title">punktacja.pl</h1>
<form method="POST" action="<?= $path ?>" id="insert-code" class="guardian-initialize">
	<input class="insert-code-input" type="text" name="code" placeholder="Twój kod promocyjny" required="required" maxlength="6">
	<input class="insert-code-button" type="submit" value="Zatwierdź">
</form>

<br /><br />
<div class="static-pages-data">
<b>Akcje promocyjne</b>
<?php
	foreach ($actions_codes as $code) { 
		if ($code->isActive()) {
			$action = $code->action(); ?>
			<p><?= $code->code.' -> '.$action->name ?></p>
		<?php }
	}
?>
</div>

<div class="static-pages-data">
<b>Konkursy</b>
<?php
	foreach ($contests_codes as $code) { 
		if ($code->isActive()) {
			$action = $code->action(); ?>
			<p><?= $code->code.' -> '.$action->name ?></p>
		<?php }
	}
?>
</div>


<script type="text/javascript" src="/assets/javascript/guardianInitialize.js"></script>