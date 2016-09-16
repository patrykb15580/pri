<?php
/**
* 
*/
class RewardsController
{
	public function index($params)
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
		include './app/views/layouts/app.php';
		
	}
	public function show($params)
	{
		$reward = Reward::findBy('id', $params['id']);

		$path = './app/views/'.StringUntils::camelCaseToUnderscore(str_replace('Controller', '', __CLASS__)).'/'.__FUNCTION__.'.php';
		#die(print_r($path));
		include './app/views/layouts/app.php';
		
	}
	public function new($params)
	{
		$reward = new Reward;
		$path = 'app/views/'.StringUntils::camelCaseToUnderscore(str_replace('Controller', '', __CLASS__)).'/'.__FUNCTION__.'.php';

		include 'app/views/layouts/app.php';
	}
	public function create($params)
	{
		$params['reward']['promotors_id'] = $params['promotors_id'];
		$reward = new Reward($params['reward']);
		#echo "<pre>";
		#die(print_r($params['reward']));
		Attachment::upload_image($params);
		$reward->save();
		if ($reward->save() == false) {
			$reward = new Reward($params['reward']);
			$path = 'app/views/'.StringUntils::camelCaseToUnderscore(str_replace('Controller', '', __CLASS__)).'/'.'new.php';
			include 'app/views/layouts/app.php';
		}else header("Location: http://".$_SERVER['HTTP_HOST']."/promotors/".$params['promotors_id']."/rewards");
	}
	public function edit($params)
	{
		$reward = new Reward;
		$reward = Reward::find($params['id']);
		$path = 'app/views/'.StringUntils::camelCaseToUnderscore(str_replace('Controller', '', __CLASS__)).'/'.__FUNCTION__.'.php';
		include 'app/views/layouts/app.php';
	}
	public function update($params)
	{
		$reward = Reward::findBy('id', $params['id']);
		$reward->update($params['reward']);
		#echo "<pre>";
		#die(print_r("Location: http://".$_SERVER['HTTP_HOST']."/promotors/".$params['promotors_id']."/rewards"));
		header("Location: http://".$_SERVER['HTTP_HOST']."/promotors/".$params['promotors_id']."/rewards/".$params['id']); 
	}
	public function delete($params)
	{
		$params['reward']['id'] = $params['id'];
		$reward = new Reward($params['reward']);
		#echo "<pre>";
		#die(print_r($params));
		$reward->destroy();

		header("Location: http://".$_SERVER['HTTP_HOST']."/promotors/".$params['promotors_id']."/rewards");
	}
}