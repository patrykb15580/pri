<?php
/**
* 
*/
class Controller
{
	public $params;

	function __construct($params)
	{
		$this->params = $params;

		if (isset($this->params['hash'])) {
			Auth::authorizeClient($this->params);
		}
		if (isset($this->non_authorized)) {
			if (!in_array($this->params['action'], $this->non_authorized)) {
				Auth::isLogged();
			}
		}
		#echo "<pre>";
		#die(print_r($_SESSION));
	}

	public function auth($method, $obj = [])
	{
	
		$polices_class = str_replace('Controller', '', $this->params['controller']).'Polices';
		$polices = new $polices_class($this->currentUser(), $obj);
		if ($polices->$method() == true) {
			return true;
		} else {
			die("Nope");
		}
	}

	public function currentUser()
	{
		$user_type = get_class($_SESSION['user']);
		return $user_type::find($_SESSION['user']->id);
	}
}