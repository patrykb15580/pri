<?php
/**
* 
*/
class SessionController extends Controller
{
	
	public function new()
	{
		(new View($this->params, [], 'login'))->render();
	}

	public function create()
	{

		$promotor_id = Auth::promotorFindByLoginAndPassword($this->params);
		$router = Config::get('router');

		if ($promotor !== false) {
			$this->params['promotor_id'] = $promotor_id;
			Auth::login($this->params);
			header('Location: '.$router->generate('show_promotors', ['promotors_id'=>$_SESSION['id']]));
		} else {
			header('Location: '.$router->generate('login', []).'?error=login');
		}
	}

	public function delete()
	{
		session_start();
		$router = Config::get('router');
		header('Location: '.$router->generate('login', []).'?logout');
		session_destroy();
	}

}