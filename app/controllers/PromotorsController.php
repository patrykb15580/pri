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
}