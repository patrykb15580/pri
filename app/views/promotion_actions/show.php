<table border="1" width="40%">
	<tr><td>Nazwa akcji</td><td>Id promotora</td></tr>
	<?php foreach ($promotion_actions as $promotion_action) { ?>
		<tr><td><?= $promotion_action->name ?></td><td><?= $promotion_action->promotors_id ?></td></tr>
	<?php } ?>
</table>