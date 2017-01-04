<?php	
	$path = $router->generate('start_page', []);
	$avatar = $promotor->avatar();
?>
<div class="use-code-is-used-message">
	<div>
		<i class="fa fa-frown-o fa-5x" aria-hidden="true"></i>

		<p>Ups,</p>

		Ten kod został już wykorzystany.
	</div>
</div>
<a class="link" href="<?= $path ?>">Powrót</a>