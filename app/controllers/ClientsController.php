<?php
/**
* 
*/
class ClientsController
{
	public function show($params)
	{
		$client = Client::find($params['client_id']);
		$codes = $client->promotion_codes();
		
		$packages = [];
		$packages_values = [];
		foreach ($codes as $code) {
			$package = $code->package();
			$packages[$code->package_id] = $package;
			$packages_values[$code->package_id] = $this->packageValue($client, $package);
		}

		$promotion_actions = [];
		$promotion_actions_values = [];
		foreach ($packages as $package) {
			$promotion_action = $package->promotion_action();
			$promotion_actions[$package->action_id] = $promotion_action;
			$promotion_actions_values[$promotion_action->id] = $this->promotionActionValue($promotion_action, $packages, $packages_values);
		}

		$promotors = [];
		foreach ($promotion_actions as $promotion_action) {
			$promotor = $promotion_action->promotor();
			$promotors[$promotion_action->promotors_id] = $promotor;
		}

		$path = './app/views/'.StringUntils::camelCaseToUnderscore(str_replace('Controller', '', __CLASS__)).'/'.__FUNCTION__.'.php';
		#die(print_r($path));
		include './app/views/layouts/client.php';
	}

	public function index_rewards($params)
	{
		$promotor = Promotor::find($params['promotors_id']);

		$active_rewards = [];
		$inactive_rewards = [];

		foreach ($promotor->rewards() as $reward) {
			if($reward->status == 'active'){
				array_push($active_rewards, $reward);
			}else array_push($inactive_rewards, $reward);
		}

		$path = './app/views/'.StringUntils::camelCaseToUnderscore(str_replace('Controller', '', __CLASS__)).'/'.__FUNCTION__.'.php';
		#die(print_r($path));
		include './app/views/layouts/client.php';
	}

	public function show_rewards($params)
	{	
		$reward = Reward::find($params['reward_id']);

		$path = './app/views/'.StringUntils::camelCaseToUnderscore(str_replace('Controller', '', __CLASS__)).'/'.__FUNCTION__.'.php';
		#die(print_r($path));
		$images = RewardImage::where('reward_id=?', ['reward_id'=>$params['reward_id']]);
		#echo "<pre>";
		#die(print_r($images));
		include './app/views/layouts/client.php';
		
	}

	public function packageValue($client, $package)
	{
		$codes_number = count(PromotionCode::where('package_id=? AND client_id=?', ['package_id'=>$package->id, 'client_id'=>$client->id]));
		$package_value = $codes_number*$package->codes_value;
		return $package_value;
	}

	public function promotionActionValue($promotion_action, $packages, $package_value)
	{
		$promotion_action_value = 0;

		foreach ($packages as $package) {
			if ($promotion_action->id == $package->action_id) {
				$promotion_action_value = $promotion_action_value + $package_value[$package->id];
			}
		}
		return $promotion_action_value;
	}
}