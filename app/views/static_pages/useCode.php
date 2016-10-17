<?php
	if ($code->client_id == null) {
		include 'app/views/static_pages/_use_code_form.php';
	} else { ?>
		<div class="error_message">Kod został już wykorzystany</div>
	<?php } ?>
	