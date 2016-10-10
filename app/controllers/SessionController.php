<?php
/**
* 
*/
class SessionController extends Controller
{
	public $non_authorized = ['new', 'create'];
	
	public function new()
	{	
		(new View($this->params, [], 'login'))->render();
	}

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
		header('Location: '.$router->generate('login', []).'?logout');
		session_destroy();
	}

}
