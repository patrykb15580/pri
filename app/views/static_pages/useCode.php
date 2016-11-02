<?php
	if ($code->client_id == null) {
		include 'app/views/static_pages/_use_code_form.php';
	} else { 
		include 'app/views/static_pages/_code_is_used.php';
	} 
?>
	