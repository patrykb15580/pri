<?php
	$action = $package->action();
?>
<div class="form-page-container">
	<p class="form-page-icon green-icon"><i class="fa fa-product-hunt" aria-hidden="true"></i></p><p class="form-page-title">Edycja pakietu #<?= $package->id ?></p>
	<p class="form-page-parent-name"><?= $action->name ?></p>
	<?php
		include 'app/views/promotion_codes_packages/_form.php';
	?>
</div>

<script type="text/javascript" src="/assets/javascript/blueBg.js"></script>