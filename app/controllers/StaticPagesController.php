<?php
/**
* 
*/
class StaticPagesController
{
	public function start_page($params)
	{
		$path = 'app/views/'.StringUntils::camelCaseToUnderscore(str_replace('Controller', '', __CLASS__)).'/'.__FUNCTION__.'.php';
		include 'app/views/layouts/start.php';
	}

	public function insert_code($params)
	{
		$code = CodeChecker::check_code_exist($params);

		if ($code !== null && $code->isActive()) {
			$router = Config::get('router');
			$path = $router->generate('use_code', ['code'=>$params['code']]);
			header('Location: '.$path);
		}
		else{
			$router = Config::get('router');
			$path = $router->generate('start_page', []);
			header('Location: '.$path.'?error=code');
		}
	}

	public function use_code($params)
	{
		$code = PromotionCode::findBy('code', $params['code']);
		$package = $code->package();
		$promotion_action = $package->promotion_action();
		$promotor = $promotion_action->promotor();
		$path = 'app/views/'.StringUntils::camelCaseToUnderscore(str_replace('Controller', '', __CLASS__)).'/'.__FUNCTION__.'.php';
		include 'app/views/layouts/start.php';
	}

	public function add_points($params)
	{
		$client = $this->getOrCreateClient($params);
		#echo "<pre>";
		#die(print_r($client));
		
		$code = PromotionCode::findBy('code', $params['code']);
		$code->update(['used'=>date(Config::get('mysqltime')), 'client_id'=>$client->id]);
		$router = Config::get('router');
		$path = $router->generate('confirmation', ['code'=>$params['code']]);
		header('Location: '.$path);
	}

	public function confirmation($params)
	{
		$path = 'app/views/'.StringUntils::camelCaseToUnderscore(str_replace('Controller', '', __CLASS__)).'/'.__FUNCTION__.'.php';
		include 'app/views/layouts/start.php';
	}
	private function getOrCreateClient($params)
	{
		$client = Client::findBy('email', $params['client']['email']);

		if (!$client) {
			$client = new Client($params['client']);
			$client->save();
			return $client;
		} else {
			return $client;
		}
	}
}