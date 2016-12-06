<?php
	$router = Config::get('router');
	$contest = $action->contest();
?>	
<div id="title-box">
	<i class="fa fa-product-hunt title-box-icon green-icon" aria-hidden="true"></i><p class="title-box-text"><?= $action->name ?></p>

	<br /><br />
	<p class="title-box-details">
		Status: <b><?= Contest::STATUSES[$action->status] ?></b><br />
		Czas trwania: <b>od <?= $contest->from_at ?> do <?= $contest->to_at ?></b><br />
		Ilość zamówionych naklejek: <b><?= $action->codesNumber() ?></b><br />
		Pytanie: <b><?= $contest->question ?></b>
	</p>
</div>

<table class="single-table" width="100%">
	<tr>
		<td class="first-row" width="25%">
			Klient
		</td>
		<td class="first-row" width="25%">
			Email klienta
		</td>
		<td class="first-row" width="50%">
			Odpowiedź
		</td>
	</tr>
	<?php
		foreach ($action->answers() as $answer) { 
			$client = $answer->client(); ?>
			<tr class="result">
				<td width="25%">
					<?= $client->name ?>
				</td>
				<td width="25%">
					<?= $client->email ?>	
				</td>
				<td width="50%">
					<?= $answer->answer ?>
				</td>
			</tr>
	<?php } ?>
</table>
