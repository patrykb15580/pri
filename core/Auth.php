<?php
 /**
 * 
 */
 class Auth
 {
 	
 	public static function isLogged()
 	{
 
 		if (empty($_SESSION['id'])) {
 
 			$router = Config::get('router');
 			
 			header('Location: '.$router->generate('login', []));
 		} 
 	}

 	public static function promotorFindByLoginAndPassword($params)
	{
		
		$promotor = Promotor::where('email=? AND password_degest=?', ['email'=>$params['login'], 'password_degest'=>Password::encryptPassword($params['password'])]);
		
		
		
		if (empty($promotor)) {
			
			return false;
		} else {
			
			return $promotor[0]->id;
		}
	} 

	public static function login($params)
	{
		session_start();
		$_SESSION['id'] = $params['promotor_id'];
	}
}

	
	