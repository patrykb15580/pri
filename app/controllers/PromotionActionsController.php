<?php
/**
* 
*/
class PromotionActionsController
{
	public function show($params)
	{
		$promotion_action = PromotionAction::findBy('id', $params['id']);

		$active_packages = [];
		$inactive_packages = [];

		foreach ($promotion_action->promotion_codes_packages() as $package) {
			if($package->status == 'active'){
				array_push($active_packages, $package);
			}else array_push($inactive_packages, $package);
		}

		#echo "<pre>";
		#die(print_r($active_packages));

		$view = (new View($params, ['promotion_action'=>$promotion_action, 'active_packages'=>$active_packages, 'inactive_packages'=>$inactive_packages]))->render();
		
	}
	public function new($params)
	{
		$promotion_action = new PromotionAction;
		$view = (new View($params, ['promotion_action'=>$promotion_action]))->render();
	}
	public function create($params)
	{
		$params['promotion_action']['promotors_id'] = $params['promotors_id'];
		$promotion_action = new PromotionAction($params['promotion_action']);
		$promotion_action->from_at = NULL;
		$promotion_action->to_at = NULL;
		
		#echo "<pre>";
		#die(print_r($promotion_action));

		if ($promotion_action->save() == false) {
			$promotion_action = new PromotionAction($params['promotion_action']);
			$view = (new View($params, ['promotion_action'=>$promotion_action]))->render();
		}else header("Location: http://".$_SERVER['HTTP_HOST']."/promotors/".$params['promotors_id']);
	}
	public function edit($params)
	{
		$promotion_action = new PromotionAction;
		$promotion_action = PromotionAction::find($params['id']);
		$view = (new View($params, ['promotion_action'=>$promotion_action]))->render();
	}
	public function update($params)
	{
		if ($params['promotion_action']['indefinitely'] == '1') {
			
			unset($params['promotion_action']['from_at']);
			unset($params['promotion_action']['to_at']);
		}

		$promotion_action = PromotionAction::findBy('id', $params['id']);
		$promotion_action->update($params['promotion_action']);
		
		header("Location: http://".$_SERVER['HTTP_HOST']."/promotors/".$params['promotors_id']."/promotion-actions/".$params['id']); 
	}
}