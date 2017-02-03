<table class="single-table" width="100%">
	<tr>
		<td class="first-row" width="20%">Nazwa klienta</td>
		<td class="first-row" width="30%">Email klienta</td>
		<td class="first-row" width="50%">Odpowiedź</td>
	</tr>
<?php foreach ($answers as $answer) { ?>
	<tr class="result">
		<td width="20%"><b><?= ($answer->client())->name ?></b></td>
		<td width="30%"><?= ($answer->client())->email ?></td>
		<td width="50%"><?= nl2br($answer->answer) ?></td>
	</tr>
<?php } ?>	
</table>

