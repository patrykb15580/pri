<?php
	$path = $router->generate('client_enter_code', ['client_id'=>$client->id]);
?>

<div class="client-view-title-box">
	<i class="fa fa-ticket client-view-title-icon orange-icon" aria-hidden="true"></i><p class="client-view-title-text">Wpisz kod</p>
</div>

<form class="guardian-initialize client-view-item-box" method="POST" action="<?= $path ?>">
	<input type="text" name="code" required="required" maxlength="6">
	<input type="submit" value="Zatwierdź">
</form>

<script type="text/javascript" src="/assets/javascript/blueBg.js"></script>