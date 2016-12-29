<table class="single-table" width="100%">
	<tr>
		<td class="first-row" width="30%">Nazwa akcji</td>
		<td class="first-row" width="50%">Pytanie</td>
		<td class="first-row" width="20%">Ocena</td>
	</tr>
<?php foreach ($opinions as $opinion) { 
	$action = $opinion->action(); 
	$path_show = $router->generate('show_opinions', ['promotors_id'=>$params['promotors_id'], 'opinion_id'=>$action->id]); ?>
	<tr class="result">
		<td width="30%"><a href="<?= $path_show ?>"><b><?= $action->name ?></b></a></td>
		<td width="50%"><?= $opinion->question ?></td>
		<td width="20%"><b><?= $action->rate() ?> <?php for ($i=0; $i < $action->rate(); $i++) { ?>
		 <span class="rate-star">★</span>
	<?php } ?></b></td>
	</tr>
<?php } ?>	
</table>

