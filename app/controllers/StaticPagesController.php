<?php
/**
* 
*/
class StaticPagesController
{
	public function start_page($params)
	{
		$view = (new View($params, [], 'start'))->render();
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
		$view = (new View($params, ['code'=>$code, 'package'=>$package, 'promotion_action'=>$promotion_action, 'promotor'=>$promotor], 'start'))->render();
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
				History::addHistoryRecord($client->id, $balance, $package->codes_value, $description, 'add');
			}

		} else {
			$points_balance = new PointsBalance(['client_id'=>$client->id, 'promotor_id'=>$promotor->id, 'balance'=>$package->codes_value]);
			if ($points_balance->save()) {
				$description = 'Wykorzystanie kodu '.$params['code'].' w akcji '.$promotion_action->name;
				History::addHistoryRecord($client->id, $package->codes_value, $package->codes_value, $description, 'add');
			}
		} 

		$router = Config::get('router');
		$path = $router->generate('confirmation', ['code'=>$params['code']]);
		header('Location: '.$path);
	}

	public function confirmation($params)
	{
		$view = (new View($params, [], 'start'))->render();
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