<?php
/**
* 
*/
class SessionController extends Controller
{
	public $non_authorized = ['create'];

	public function create()
	{
		if ($this->params['login'] == 'admin') {
			Auth::authorizeAdmin($this->params);
		}

		else {
			Auth::authorizePromotor($this->params);
		}
	}

	public function delete()
	{
		$this->auth(__FUNCTION__);
		$router = Config::get('router');
		$this->alert('info', 'Zostałeś pomyślnie wylogowany');
		header('Location: '.$router->generate('promotor_login', []));
		unset($_SESSION['user']);
	}

}
