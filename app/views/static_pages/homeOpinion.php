<?php
	$action = $code->action();
	$opinion = $action->opinion();
	$promotor = $action->promotor();
?>
<form method="POST" action="<?= $router->generate('home_give_opinion', ['code'=>$code->code]) ?>">
    <img src="/assets/image/home/intro-banner-logo.png">
    <h1>Aktywuj swój kod promocyjny</h1>
    <div class="contest">
    	<p class="promotor"><?= $promotor->name ?></p>
    	<p class="question"><?= $opinion->question ?></p>
    	<div class='rating-selection'>
		 	<input checked id='rating_0' name='rating' type='radio' value='0'>
			  
			<label for='rating_0'>
				<span>0</span>
			</label>

			<input id='rating_1' name='rating' type='radio' value='1'>

			<label for='rating_1'>
			    <span>1</span>
			</label>

			<input id='rating_2' name='rating' type='radio' value='2'>

			<label for='rating_2'>
			    <span>2</span>
			</label>

			<input id='rating_3' name='rating' type='radio' value='3'>

			<label for='rating_3'>
			    <span>3</span>
			</label>

			<input id='rating_4' name='rating' type='radio' value='4'>

			<label for='rating_4'>
			 	<span>4</span>
			</label>

			<input id='rating_5' name='rating' type='radio' value='5'>

			<label for='rating_5'>
				<span>5</span>
			</label>

		</div>
	    <div>
	        <input type="email" name="client[email]" placeholder="Adres e-mail" required>
	        <input type="submit" value="Zatwierdź" disabled>
	        <br />
	        <input type="checkbox" name="agreement" required="required">
			<span class="note">
				Akceptuje regulamin i politykę prywatności programu Punktacja.pl oraz wyrażam zgodę na przetwarzanie danych.
			</span>
	    </div>
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