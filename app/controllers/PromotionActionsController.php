<?php
/**
* 
*/
class PromotionActionsController extends Controller
{
	public function show()
	{
		$promotion_action = $this->promotionAction();
		$this->auth(__FUNCTION__, $promotion_action);

		$view = (new View($this->params, ['promotion_action'=>$promotion_action]))->render();
		return $view;
		
	}
	public function new()
	{
		$this->auth(__FUNCTION__, Promotor::find($this->params['promotors_id']));
		$promotion_action = new PromotionAction;
		
		$view = (new View($this->params, ['promotion_action'=>$promotion_action]))->render();
		return $view;
	}
	public function create()
	{
		$this->auth(__FUNCTION__, Promotor::find($this->params['promotors_id']));
		$this->params['promotion_action']['promotors_id'] = $this->params['promotors_id'];
		$promotion_action = new PromotionAction($this->params['promotion_action']);
		$promotion_action->from_at = NULL;
		$promotion_action->to_at = NULL;
		
		#echo "<pre>";
		#die(print_r($promotion_action));

		if ($promotion_action->save()) {
			header("Location: http://".$_SERVER['HTTP_HOST']."/promotors/".$this->params['promotors_id']);
		} else {
			$view = (new View($this->params, ['promotion_action'=>$promotion_action]))->render();
			return $view;
		}
	}
	public function edit()
	{
		$promotion_action = $this->promotionAction();
		$this->auth(__FUNCTION__, $promotion_action);
		
		$view = (new View($this->params, ['promotion_action'=>$promotion_action]))->render();
		return $view;
	}
	public function update()
	{
		$promotion_action = $this->promotionAction();
		$this->auth(__FUNCTION__, $promotion_action);
		
		if ($this->params['promotion_action']['indefinitely'] == '1') {
			
			unset($this->params['promotion_action']['from_at']);
			unset($this->params['promotion_action']['to_at']);
		}

		if ($promotion_action->update($this->params['promotion_action'])) {
			header("Location: http://".$_SERVER['HTTP_HOST']."/promotors/".$this->params['promotors_id']."/promotion-actions/".$this->params['id']); 
		} else {
			$this->params['action'] = 'edit';
			
			$view = (new View($this->params, ['promotion_action'=>$promotion_action]))->render();
			return $view;
		}		
	}

	public function promotionAction()
	{
		return PromotionAction::find($this->params['id']);
	}
}