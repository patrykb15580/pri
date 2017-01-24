<?php
	$action = $code->action();
	$contest = $action->contest();
	$promotor = $action->promotor();
	$client = $code->client();
?>
<form method="POST" action="<?= $router->generate('home_use_contest_code', ['code'=>$code->code, 'client_id'=>$client->id]) ?>">
    <img src="/assets/image/home/intro-banner-logo.png">
    <h1>Aktywuj swój kod promocyjny</h1>
    <div class="contest">
    	<p class="promotor"><?= $promotor->name ?></p>
    	<p class="question"><?= $contest->question ?></p>
	    <div>
	        <textarea rows="6" placeholder="Odpowiedź" name="answer[answer]" required="required"></textarea>
	        <br />
	        <input type="submit" value="Zatwierdź">
	    </div>
	    <?php 
	    	if (isset($params['errors']) && $params['errors'] == 'save') { ?>
	    		<div class="status">Nie udało się zapisać odpowiedzi, spróbuj jeszcze raz.</div>
	    	<?php }
	    ?>
    </div>
</form>

<script type="text/javascript">
	$('input[name=rating]').change(enableButton);

    function enableButton() {
    	if ($('input[name=rating]:checked').val() > 0) {

        	$('.contest input[type=submit]').removeAttr('disabled');

    	} else {
        	$('.contest input[type=submit]').attr('disabled', 'disabled');
    	}
    }
</script>