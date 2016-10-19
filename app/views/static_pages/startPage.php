<?php
	$router = Config::get('router');
	$path = $router->generate('insert_code', []);	
?>

<form method="POST" action="<?= $path ?>" id="insert_code">
	<br />Kod promocyjny:
	<br /><br /><input id="insert_code" type="text" name="code">
	<input id="insert_code" type="submit" value="Zatwierdź">
</form>
<br /><a href="<?= $router->generate('login', []); ?>"><button id="center">Logowanie promotora</button></a>

<?php
	$codes = PromotionCode::where('package_id=?', ['package_id'=>1]);
	foreach ($codes as $code) {
		echo $code->code."<br />";
	}
?>