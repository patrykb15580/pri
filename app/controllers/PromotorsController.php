<?php
/**
* 
*/
class PromotorsController
{
	public function show($params)
	{
		$promotor = Promotor::find($params['promotors_id']);

		$active_actions = [];
		$inactive_actions = [];
		foreach ($promotor->promotion_actions() as $action) {
			if($action->status == 'active'){
				array_push($active_actions, $action);
			}else array_push($inactive_actions, $action);
		}

		$path = './app/views/'.StringUntils::camelCaseToUnderscore(str_replace('Controller', '', __CLASS__)).'/'.__FUNCTION__.'.php';
		#die(print_r($path));
		include './app/views/layouts/app.php';
	}

	public function edit($params)
	{
		$promotor = new Promotor;
		$promotor = Promotor::find($params['promotors_id']);
		$path = 'app/views/'.StringUntils::camelCaseToUnderscore(str_replace('Controller', '', __CLASS__)).'/'.__FUNCTION__.'.php';
		include './app/views/layouts/app.php';
	}

	public function update($params)
	{
		$promotor = Promotor::find($params['promotors_id']);
		
		$old_password = Password::encryptPassword($params['old_password']);
		$new_password = Password::encryptPassword($params['promotor']['password_degest']);
		$params['promotor']['password_degest'] = Password::encryptPassword($params['promotor']['password_degest']);

		if (Password::equal_passwords($old_password, $new_password) == true) {
			Promotor::update_promotor($params);
		} else header("Location: http://".$_SERVER['HTTP_HOST']."/promotors/".$params['promotors_id'].'/account?password=error');

	}

	public function index_clients($params)
	{
		$promotor = Promotor::find($params['promotors_id']);
		
		$clients = $promotor->clients();
		#echo "<pre>";
		#die(print_r($clients));

		$path = './app/views/'.StringUntils::camelCaseToUnderscore(str_replace('Controller', '', __CLASS__)).'/'.__FUNCTION__.'.php';
		#die(print_r($path));
		include './app/views/layouts/app.php';
	}
	public function index_orders($params)
	{
		$orders = Order::where('promotor_id=?', ['promotor_id'=>$params['promotors_id']]);
		#echo "<pre>";
		#die(print_r($orders));
		$active_orders = [];
		$completed_orders = [];
		$canceled_orders = [];
		foreach ($orders as $order) {
			if($order->status == 'active'){
				array_push($active_orders, $order);
			} else if ($order->status == 'completed') {
				array_push($completed_orders, $order);
			} else if ($order->status == 'canceled') {
				array_push($canceled_orders, $order);
			}
		}
		$path = './app/views/'.StringUntils::camelCaseToUnderscore(str_replace('Controller', '', __CLASS__)).'/'.__FUNCTION__.'.php';

		include './app/views/layouts/app.php';
	}

	public function show_orders($params)
	{
		$order = Order::find($params['order_id']);
		$client = $order->client();
		$reward = $order->reward();
		#echo "<pre>";
		#die(print_r($client));

		$image = RewardImage::findBy('reward_id', $reward->id);
		$path = './app/views/'.StringUntils::camelCaseToUnderscore(str_replace('Controller', '', __CLASS__)).'/'.__FUNCTION__.'.php';
		#die(print_r($path));
		include './app/views/layouts/app.php';
	}
}