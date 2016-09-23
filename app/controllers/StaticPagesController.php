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
		$code = PromotionCode::findBy('code', $params['code']);
		$package = $code->package();
		$promotion_action = $package->promotion_action();
		$promotor = $promotion_action->promotor();
		#echo "<pre>";
		#die(print_r($package));

		$code = PromotionCode::findBy('code', $params['code']);
		$code->update(['used'=>date(Config::get('mysqltime')), 'client_id'=>$client->id]);

		$points_balance = PointsBalance::where('client_id=? AND promotor_id=?', ['client_id'=>$client->id, 'promotor_id'=>$promotor->id]);

		if ($points_balance) {
			$points_balance = $points_balance[0];
			$balance = $points_balance->balance + $package->codes_value;
			if ($points_balance->update(['balance'=>$balance])) {
				$description = 'Wykorzystanie kodu '.$params['code'].' w akcji '.$promotion_action->name;
				$this->addHistoryRecord($client->id, $balance, $package->codes_value, $description);
			}

		} else {
			$points_balance = new PointsBalance(['client_id'=>$client->id, 'promotor_id'=>$promotor->id, 'balance'=>$package->codes_value]);
			if ($points_balance->save()) {
				$description = 'Wykorzystanie kodu '.$params['code'].' w akcji '.$promotion_action->name;
				$this->addHistoryRecord($client->id, $package->codes_value, $package->codes_value, $description);
			}
		} 

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
	public function addHistoryRecord($client_id, $balance_after, $code_value, $description)
	{
		$balance_before = $balance_after - $code_value;
		#die(print_r($balance_before));
		$history = new History(['client_id'=>$client_id, 'points'=>$code_value, 'balance_before'=>$balance_before, 'balance_after'=>$balance_after, 'description'=>$description]);
		if (!$history->save()) {
			echo "Error";
		}
	}
}