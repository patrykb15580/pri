<?php
/**
* 
*/
class Alerts
{
	function __construct($type, $message)
	{
		if (isset($_SESSION['alerts'])) {
			$i = count($_SESSION['alerts']);
		} else {
			$i = 0;
		}
		
		$_SESSION['alerts'][$i++] = ['type' => $type,
									 'message' => $message];
	}

	static function render($type, $message)
	{
		$icon = '';
		if ($type == 'error') {
			$icon = '<i class="fa fa-exclamation-circle" aria-hidden="true"></i>';
		}
		$alert = '<div class="'.$type.'_message alert"><p id="alert_text">'.$icon.' '.$message.'</p><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>';
		
		return $alert;
	}

	public static function showAlert()
	{
		if (isset($_SESSION['alerts'])) {
			foreach ($_SESSION['alerts'] as $alert) {
				$show = self::render($alert['type'], $alert['message']);
				echo $show;
			}
			unset($_SESSION['alerts']);
		}
	}
}