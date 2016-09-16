<?php
	$router = new AltoRouter;
	$path = $router->generate('create_promotion_actions');
	die(print_r($path));
?>
	<h2>Akcje promocyjne promotora <?= $promotor->name ?></h2>
	<hr>
	<?php foreach ($promotor->promotion_actions() as $promotion_action) { ?>
		<?= $promotion_action->name ?><hr>
	<?php } ?>
	<a href="<?= $path ?>"><button>Nowa akcja promocyjna</button></a>