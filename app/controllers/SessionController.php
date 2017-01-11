<?php
/**
* 
*/
class SessionController extends Controller
{
	public $non_authorized = ['create'];

	public function create()
	{
		if (isset($this->params['login']) && $this->params['login'] == 'admin@punktacja.pl') {
			Auth::authorizeAdmin($this->params);
		} else if (isset($this->params['client'])) {
			Auth::authorizeClient($this->params);
		} else {
			Auth::authorizePromotor($this->params);
		}
	}

	public function delete()
	{
		$this->auth(__FUNCTION__);
		$router = Config::get('router');
		$this->alert('info', 'Zostałeś pomyślnie wylogowany');

		if (get_class($_SESSION['user']) == 'Client') {
			$path = $router->generate('login', []);
		} else {
			$path = $router->generate('promotor_login', []);
		}
		header('Location: '.$path);
		unset($_SESSION['user']);
	}

}
