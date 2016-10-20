<?php
	$router = Config::get('router');
	$path = $router->generate('insert_code', []);	
?>

<form method="POST" action="<?= $path ?>" id="insert_code">
	<br />Kod promocyjny:
	<br /><br /><input id="insert_code" type="text" name="code">
	<input id="insert_code" type="submit" value="Zatwierdź"><br /><br />
	<?php
		$codes = PromotionCode::where('package_id=?', ['package_id'=>1]);
		foreach ($codes as $code) { ?>
			<p <?php if (!empty($code->used)) { echo 'class="linethrough"'; } ?>><?= $code->code ?><br /></p>
		<?php }
	?>
</form>
<br /><a href="<?= $router->generate('login', []); ?>"><button id="center">Logowanie promotora</button></a>

