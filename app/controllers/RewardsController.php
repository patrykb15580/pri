<?php
/**
* 
*/
class RewardsController extends Controller
{
	public function index()
	{
		$promotor = Promotor::find($this->params['promotors_id']);
		$this->auth(__FUNCTION__, $promotor);

		$active_rewards = [];
		$inactive_rewards = [];

		foreach ($promotor->rewards() as $reward) {
			if($reward->status == 'active'){
				array_push($active_rewards, $reward);
			}else array_push($inactive_rewards, $reward);
		}

		$view = (new View($this->params, ['promotor'=>$promotor, 'active_rewards'=>$active_rewards, 'inactive_rewards'=>$inactive_rewards]))->render();
		return $view;
		
	}

	public function show()
	{
		$reward = $this->reward();
		$this->auth(__FUNCTION__, $reward);

		$images = RewardImage::where('reward_id=?', ['reward_id'=>$this->params['id']]);
		
		$view = (new View($this->params, ['reward'=>$reward, 'images'=>$images]))->render();
		return $view;
		
	}

	public function new()
	{
		$this->auth(__FUNCTION__, Promotor::find($this->params['promotors_id']));
		$reward = new Reward;
		$view = (new View($this->params, ['reward'=>$reward]))->render();
		return $view;
	}

	public function create()
	{
		$this->auth(__FUNCTION__, Promotor::find($this->params['promotors_id']));
		$this->params['reward']['promotors_id'] = $this->params['promotors_id'];
		$reward = new Reward($this->params['reward']);
		#echo "<pre>";
		#die(print_r($this->params['reward']));
		if ($reward->save()) {
			header("Location: http://".$_SERVER['HTTP_HOST']."/promotors/".$this->params['promotors_id']."/rewards");
		}
		else {
			$reward = new Reward($this->params['reward']);
			$path = 'app/views/'.StringUntils::camelCaseToUnderscore(str_replace('Controller', '', __CLASS__)).'/'.'new.php';
			include 'app/views/layouts/app.php';
		}
	}

	public function edit()
	{
		$reward = $this->reward();
		$this->auth(__FUNCTION__, $reward);
		
		$view = (new View($this->params, ['reward'=>$reward]))->render();
		return $view;
	}

	public function update()
	{
		$reward = $this->reward();
		$this->auth(__FUNCTION__, $reward);
		
		if ($reward->update($this->params['reward'])) {

			$upload = new RewardImage;
			$upload->uploadImages($_FILES, $this->params);

			header("Location: http://".$_SERVER['HTTP_HOST']."/promotors/".$this->params['promotors_id']."/rewards/".$this->params['id']); 
		}
		else {
			$reward = new Reward($this->params['reward']);
			
			$view = (new View($this->params, ['reward'=>$reward]))->render();
			return $view;
		}		
	}
	
	public function delete()
	{
		$this->auth(__FUNCTION__, $this->reward());
		$this->params['reward']['id'] = $this->params['id'];
		$reward = new Reward($this->params['reward']);
		#echo "<pre>";
		#die(print_r($this->params));
		$reward->destroy();

		header("Location: http://".$_SERVER['HTTP_HOST']."/promotors/".$this->params['promotors_id']."/rewards");
	}

	public function reward()
	{
		return Reward::find($this->params['id']);
	}
}