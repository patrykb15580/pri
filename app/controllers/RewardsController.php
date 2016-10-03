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

		$view = (new View($params, ['promotor'=>$promotor, 'active_rewards'=>$active_rewards, 'inactive_rewards'=>$inactive_rewards]))->render();
		
	}

	public function show($params)
	{
		$reward = Reward::findBy('id', $params['id']);

		$images = RewardImage::where('reward_id=?', ['reward_id'=>$params['id']]);
		
		$view = (new View($params, ['reward'=>$reward, 'images'=>$images]))->render();
		
	}

	public function new($params)
	{
		$reward = new Reward;
		$view = (new View($params, ['reward'=>$reward]))->render();
	}

	public function create($params)
	{
		$params['reward']['promotors_id'] = $params['promotors_id'];
		$reward = new Reward($params['reward']);
		#echo "<pre>";
		#die(print_r($params['reward']));
		if ($reward->save()) {
			header("Location: http://".$_SERVER['HTTP_HOST']."/promotors/".$params['promotors_id']."/rewards");
		}
		else {
			$reward = new Reward($params['reward']);
			$path = 'app/views/'.StringUntils::camelCaseToUnderscore(str_replace('Controller', '', __CLASS__)).'/'.'new.php';
			include 'app/views/layouts/app.php';
		}
	}

	public function edit($params)
	{
		$reward = new Reward;
		$reward = Reward::find($params['id']);
		$view = (new View($params, ['reward'=>$reward]))->render();
	}

	public function update($params)
	{
		
		$reward = Reward::findBy('id', $params['id']);
		if ($reward->update($params['reward'])) {

			$upload = new RewardImage;
			$upload->upload_images($_FILES, $params);

			header("Location: http://".$_SERVER['HTTP_HOST']."/promotors/".$params['promotors_id']."/rewards/".$params['id']); 
		}
		else {
			$reward = new Reward($params['reward']);
			$path = 'app/views/'.StringUntils::camelCaseToUnderscore(str_replace('Controller', '', __CLASS__)).'/'.'edit.php';
			include 'app/views/layouts/app.php';
		}		
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