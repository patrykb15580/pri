<?php
	$path = $router->generate('insert_code', []);	
?>
<h1 id="main_page_site_title">punktacja.pl</h1>
<form method="POST" action="<?= $path ?>" id="insert-code">
	<input class="insert-code-input" type="text" name="code" placeholder="Twój kod promocyjny">
	<input class="insert-code-button" type="submit" value="Zatwierdź">
</form>

<div class="static-pages-data">
	<?php
		$codes = PromotionCode::where('package_id=?', ['package_id'=>1]);
		foreach ($codes as $code) { ?>
			<p <?php if (!empty($code->used)) { echo 'class="linethrough"'; } ?>><?= $code->code ?></p>
		<?php }
	?>
</div>