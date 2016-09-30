<?php
	$router = Config::get('router');
	
	#echo "<pre>";
	#die(print_r($params));
?>	
<div id="show_title_box">Twoje zamówienia</div>
<?php 
#die(print_r($_GET['order']));
if (isset($params['order'])) {
	if ($params['order'] == 'confirm') { ?>
		<div id="confirm_message"><?= 'Gotowe<br />Zamówienie zostało przekazane do realizacji' ?></div><br /><br />
	<?php } 
	else if ($params['order'] == 'error') { ?>
		<div id="error_message"><?= 'Nie udało się zamówić nagrody<br />Spróbuj jeszcze raz' ?></div><br /><br />
	<?php }
}
	include 'app/views/clients/_orders.php';
?>
