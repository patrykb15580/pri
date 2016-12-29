<?php
	$contest = $action->contest();
	$opinion = $action->opinion();
	$contest_opinion_path = $router->generate('give_contest_opinion', ['id'=>$action->id, 'code'=>$params['code']]);
	$promotor = $action->promotor();
	$avatar = $promotor->avatar();
?>
<div class="answer-box">
	<div class="answer-form-top">
		<?php if (empty($avatar)) { ?>
			<div class="answer-form-avatar"></div>			
		<?php } else { ?>
			<img class="answer-form-avatar" src="/system/promotor_avatars/<?= $promotor->id ?>/small/<?= $avatar->file_name ?>">
		<?php } ?>
		<div class="answer-form-title">
			<p><?= $promotor->name ?></p>
			<?= $action->name ?>
		</div>
	</div>
	<form class="answer-form guardian-initialize" method="POST" action="<?= $contest_opinion_path ?>">
		
		<b><?= $opinion->question ?></b>
		<div class='rating_selection'>
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

		Email<p class="red">*</p><br />
		<input type="email" name="client[email]" required="required"><br />

		<input class="next" type="submit" value="Dalej" disabled><br />

		<input type="checkbox" name="rules" required="required"><span class="checkbox-text">Akceptuje regulamin programu Punktacja.pl <p class="red">*</p></span><br />
		<input type="checkbox" name="privacy_policy" required="required"><span class="checkbox-text">Akceptuje politykę prywatności <p class="red">*</p></span><br />
		<input type="checkbox" name="personal_data" required="required"><span class="checkbox-text">Wyrażam zgodę na przetwarzanie danych <p class="red">*</p></span><br />

	</form>
</div>

<script type="text/javascript">

	$('input[name=rules]').click(enableButton);
	$('input[name=privacy_policy]').click(enableButton);
	$('input[name=personal_data]').click(enableButton);
	$('input[type=email]').change(enableButton);
	$('input[name=rating]').change(enableButton);

    function enableButton() {
    	if ($('input[name=rules]').is(':checked') && $('input[name=privacy_policy]').is(':checked') && $('input[name=personal_data]').is(':checked') && $.trim($('input[type=email]').val()) !== '' && $('input[name=rating]:checked').val() > 0) {

        	$('.next').removeAttr('disabled');

    	} else {
        	$('.next').attr('disabled', 'disabled');
    	}
    }

</script>