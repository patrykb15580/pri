<?php
 /**
 * 
 */
 class Auth
 {
 	
 	public static function isLogged()
 	{
 
 		if (empty($_SESSION['user'])) {
 
 			$router = Config::get('router');
 			
 			header('Location: '.$router->generate('login', []));
 		} 
 	}

 	public static function authorizePromotor($params)
	{
		
		$promotor = Promotor::where('email=? AND password_degest=?', ['email'=>$params['login'], 'password_degest'=>Password::encryptPassword($params['password'])]);
		
		$router = Config::get('router');

		if (!empty($promotor)) {
			Auth::login($promotor[0]);
			header('Location: '.$router->generate('show_promotors', ['promotors_id'=>$_SESSION['user']->id]));
		} else {
			header('Location: '.$router->generate('login', []).'?error=login');
		}
	} 

	public static function authorizeAdmin($params)
	{
		
		$router = Config::get('router');

		if ($params['password'] == Config::get('admin_password')) {
			Auth::login(new Admin);
			header('Location: '.$router->generate('show_admin', []));
		} else {
			header('Location: '.$router->generate('login', []).'?error=login');
		}
	}

	public static function authorizeClient($params)
	{
		
		$client = Client::findBy('hash', $params['hash']);
		
		$router = Config::get('router');

		if (!empty($client)) {
			Auth::login($client);
			header('Location: '.$router->generate('show_client', ['client_id'=>$_SESSION['user']->id]));
		} else {
			header('Location: '.$router->generate('login', []).'?error=hash');
		}
	} 

	public static function login($user)
	{
		$_SESSION['user'] = $user;
	}
}

	
	