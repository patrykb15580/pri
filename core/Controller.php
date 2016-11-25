<?php
/**
* 
*/
class Controller
{
	public $params;

	function __construct($params = [])
	{	
		$this->params = $params;

		if (isset($this->params['hash'])) {
			Auth::authorizeClient($this->params);
		}
		if (isset($this->non_authorized)) {
			if (!in_array($this->params['action'], $this->non_authorized)) {
				Auth::isLogged();
			}
		} else Auth::isLogged();
	}

	public function auth($method, $obj = [])
	{
		$polices_class = str_replace('Controller', '', $this->params['controller']).'Polices';
		$polices = new $polices_class($this->currentUser(), $obj);
		if ($polices->$method() == true) {
			return true;
		} else {
			$router = Config::get('router');
			header('Location: '.$router->generate('access_denied', []));
		}
	}

	public function currentUser()
	{
		$user_type = get_class($_SESSION['user']);
		if ($user_type !== 'Admin') {
			return $user_type::find($_SESSION['user']->id);
		} else return new Admin;
	}

	public function alert($type, $message)
	{
		new Alerts($type, $message);
	}
}