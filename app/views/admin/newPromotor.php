<?php
	$router = Config::get('router');
	$promotor = new Promotor;

	$path = $router->generate('create_promotors', []);
?>
<div class="form-page-container">
	<p class="form-page-icon light-purple-icon"><i class="fa fa-user" aria-hidden="true"></i></p><p class="form-page-title">Nowy promotor</p>
	<?php
		include 'app/views/admin/_form_create.php';
	?>
</div>

<script type="text/javascript" src="/assets/javascript/blueBg.js"></script>
