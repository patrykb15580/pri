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
		$alert = '<div class="'.$type.'_message">'.$message.'</div><br />';
		
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