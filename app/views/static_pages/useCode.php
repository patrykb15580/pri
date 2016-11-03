<?php
	if ($code->isUsed()) {
		include 'app/views/static_pages/_code_is_used.php';
	} else { 
		include 'app/views/static_pages/_use_code_form.php';
	} 
?>
	