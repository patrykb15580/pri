<table class="single-table" width="100%">
	<tr>
		<td id="first_row" width="20%">Nazwa klienta</td>
		<td id="first_row" width="30%">Email klienta</td>
		<td id="first_row" width="50%">Odpowiedź</td>
	</tr>
<?php foreach ($answers as $answer) { ?>
	<tr class="result">
		<td width="20%"><b><?= ($answer->client())->name ?></b></td>
		<td width="30%"><?= ($answer->client())->email ?></td>
		<td width="50%"><?= $answer->answer ?></td>
	</tr>
<?php } ?>	
</table>

