<?php
	$code = Code::findBy('code', $params['code']);
	$path = $router->generate('client_give_answer', ['client_id'=>$client->id, 'code'=>$code->code]);
	$action = $code->action();
	$contest = $action->contest();
?>

<div class="client-view-title-box">
	<i class="fa fa-trophy client-view-title-icon green-icon" aria-hidden="true"></i><p class="client-view-title-text">Odpowiedz na pytanie</p>
</div>

<form class="guardian-initialize client-view-item-box" method="POST" action="<?= $path ?>">
	<h2><?= $contest->question ?></h2>
	<textarea rows="6" name="answer[answer]" required="required"></textarea><br />
	<input type="submit" value="Zatwierdź">
</form>

<script type="text/javascript" src="/assets/javascript/blueBg.js"></script>