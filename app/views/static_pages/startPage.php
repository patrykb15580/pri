<?php
	$path = $router->generate('enter_code', []);	
?>
<h1 id="main_page_site_title">punktacja.pl</h1>
<form method="POST" action="<?= $path ?>" id="insert-code" class="guardian-initialize">
	<input class="insert-code-input" type="text" name="code" placeholder="Twój kod promocyjny" required="required" maxlength="6">
	<input class="insert-code-button" type="submit" value="Zatwierdź">
</form>

<div class="static-pages-data">
Akcje promocyjne<br /><br />
	<?php
		$codes = Code::where('package_id=?', ['package_id'=>1]);
		foreach ($codes as $code) { ?>
			<p <?php if (!empty($code->used)) { echo 'class="linethrough"'; } ?>><?= $code->code ?></p>
		<?php }
	?>
</div>
<div class="static-pages-data">
Konkursy<br /><br />
	<?php
		$contest = Action::findBy('type', 'Contests');
		if (!empty($contest)) {
			foreach ($contest->codes() as $code) { ?>
				<p <?php if (!empty($code->used)) { echo 'class="linethrough"'; } ?>><?= $code->code ?></p>
			<?php }
		}
	?>
</div>

<script type="text/javascript" src="/assets/javascript/guardianInitialize.js"></script>