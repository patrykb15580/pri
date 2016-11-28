<?php 
	$path_create = $router->generate('create_contest_stickers_package', ['promotors_id'=>$params['promotors_id'], 'contest_id'=>$params['contest_id']]);
?>
<form class="form-page-form guardian-initialize" method="POST" action="<?= $path_create ?>">
	Ilość naklejek<br />
	<input class="guardian-initialize" type="number" name="package[quantity]" min="10" required="required"><br /><br>
	<input class="form-page-button" type="submit" value="Zamów pakiet naklejek">
</form>