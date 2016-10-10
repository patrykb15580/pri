<?php
/**
* 
*/
class PromotionActionsController extends Controller
{
	public function show()
	{
		$this->auth(__FUNCTION__, $this->promotionAction());
		$promotion_action = PromotionAction::findBy('id', $this->params['id']);

		#echo "<pre>";
		#die(print_r($active_packages));

		(new View($this->params, ['promotion_action'=>$promotion_action]))->render();
		
	}
	public function new()
	{
		$this->auth(__FUNCTION__, Promotor::find($this->params['promotors_id']));
		$promotion_action = new PromotionAction;
		(new View($this->params, ['promotion_action'=>$promotion_action]))->render();
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
			(new View($this->params, ['promotion_action'=>$promotion_action]))->render();
		}
	}
	public function edit()
	{
		$this->auth(__FUNCTION__, $this->promotionAction());
		$promotion_action = PromotionAction::find($this->params['id']);
		(new View($this->params, ['promotion_action'=>$promotion_action]))->render();
	}
	public function update()
	{
		$this->auth(__FUNCTION__, $this->promotionAction());
		if ($this->params['promotion_action']['indefinitely'] == '1') {
			
			unset($this->params['promotion_action']['from_at']);
			unset($this->params['promotion_action']['to_at']);
		}

		$promotion_action = PromotionAction::findBy('id', $this->params['id']);
		if ($promotion_action->update($this->params['promotion_action'])) {
			header("Location: http://".$_SERVER['HTTP_HOST']."/promotors/".$this->params['promotors_id']."/promotion-actions/".$this->params['id']); 
		} else {
			$this->params['action'] = 'edit';
			(new View($this->params, ['promotion_action'=>$promotion_action]))->render();
		}		
	}

	public function promotionAction()
	{
		return PromotionAction::find($this->params['id']);
	}
}