<?php
	$contest = $action->contest();
	$contest_answer_path = $router->generate('give_answer', ['id'=>$action->id, 'code'=>$params['code'], 'client_id'=>$params['client_id']]);
	$promotor = $action->promotor();
	$avatar = $promotor->avatar();
?>
<div id="contest-answer">
	<div class="contest-opinion-top">
		<p class="contest-opinion-block-title">
			Promotor
		</p>
		<div class="contest-opinion-promotor-info">
			<?php
				if (!empty($avatar)) { ?>
					<img class="contest-opinion-avatar" src="/system/promotor_avatars/<?= $promotor->id ?>/small/<?= $avatar->file_name ?>">
				<?php } 
			?>
			<span>
				<?= $promotor->name ?>
			</span>
		</div>
		<p class="contest-opinion-block-title">
			Konkurs
		</p>
		<div class="contest-opinion-action-name">
			<?= $action->name ?>
		</div>
	</div>
	<form method="POST" action="<?= $contest_answer_path ?>">
		<p class="contest-opinion-block-title">
			Aby wziąć udział w konkursie odpowiedź na poniższe pytanie.<br />
		</p>
		<p class="question"><?= $contest->question ?></p>

		<textarea rows="6" placeholder="Odpowiedź" name="answer[answer]" required="required"></textarea><br />

		<input type="submit" value="Biorę udział w konkursie">
	</form>
</div>

<!--
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
		<br /><br />
		Pytanie konkursowe:<br />
		<b><?= $contest->question ?></b>
	</div>
	<form class="answer-form guardian-initialize" method="POST" action="<?= $contest_answer_path ?>">
		Odpowiedź<br />
		<textarea rows="4" name="answer[answer]" required="required"></textarea><br />

		<input type="submit" value="Biorę udział w konkursie">
	</form>
</div>
-->