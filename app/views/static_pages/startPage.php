<?php
	$path = $router->generate('insert_code', []);	
?>
<h1 id="main_page_site_title">punktacja.pl</h1>
<form method="POST" action="<?= $path ?>" id="insert_code">
	<input id="insert_code" type="text" name="code" placeholder="Twój kod promocyjny">
	<input id="insert_code" type="submit" value="Zatwierdź">
</form>
<?php
	$codes = PromotionCode::where('package_id=?', ['package_id'=>1]);
	foreach ($codes as $code) { ?>
		<p <?php if (!empty($code->used)) { echo 'class="linethrough"'; } ?>><?= $code->code ?></p>
	<?php }
?>