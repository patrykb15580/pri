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
		
		if ($promotion_action->indefinitely == 1) {
			$promotion_action->from_at = NULL;
			$promotion_action->to_at = NULL;
		}

		if (!$this->checkDuration($promotion_action)) {
			$this->alert('error', 'Wypełnij wymagane pola');

			$this->params['action'] = 'new';
			$view = (new View($this->params, ['promotion_action'=>$promotion_action]))->render();
			return $view;
		}

		if ($promotion_action->save()) {
			$this->alert('info', 'Utworzono akcje '.$promotion_action->name);
			header("Location: http://".$_SERVER['HTTP_HOST']."/promotors/".$this->params['promotors_id']);
		} else {
			$this->alert('error', 'Nie udało się dodać akcji<br />Spróbuj pomownie');

			$this->params['action'] = 'new';
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
		
		if (!$this->checkDuration(new PromotionAction($this->params['promotion_action']))) {
			$this->params['action'] = 'edit';
			
			$this->alert('error', 'Wypełnij wymagane pola');
			$view = (new View($this->params, ['promotion_action'=>$promotion_action]))->render();
			return $view;

		}
		if ($this->params['promotion_action']['indefinitely'] == '1') {
			
			unset($this->params['promotion_action']['from_at']);
			unset($this->params['promotion_action']['to_at']);
		}

		if ($promotion_action->update($this->params['promotion_action'])) {
			header("Location: http://".$_SERVER['HTTP_HOST']."/promotors/".$this->params['promotors_id']."/promotion-actions/".$this->params['id']); 
		} else {
			$this->params['action'] = 'edit';

			$this->alert('error', 'Nie udało się zaktualizować akcji promocyjnej');
			$view = (new View($this->params, ['promotion_action'=>$promotion_action]))->render();
			return $view;
		}		
	}

	public function checkDuration($action)
	{
		if ($action->from_at == null && $action->indefinitely == 0) {
			return false;
		} else if ($action->to_at == null && $action->indefinitely == 0) {
			return false;
		} else {
			return true;
		}
	}

	public function promotionAction()
	{
		return PromotionAction::find($this->params['id']);
	}
}