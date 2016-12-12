<?php
/**
* 
*/
class PromotionActionsController extends Controller
{
	public function show()
	{	
		$action = $this->action();
		$this->auth(__FUNCTION__, $action);

		if (!isset($_COOKIE['pri_promotor_show_promotion_action_view_notice'])) {
			setcookie('pri_promotor_show_promotion_action_view_notice', 'no', time() + (86400 * 30));
			$this->params['notice'] = 'yes';
		}

		$view = (new View($this->params, ['action'=>$action]))->render();
		return $view;
		
	}
	public function new()
	{
		$this->auth(__FUNCTION__, Promotor::find($this->params['promotors_id']));
		$action = new Action;
		
		$view = (new View($this->params, ['action'=>$action]))->render();
		return $view;
	}
	public function create()
	{
		$this->auth(__FUNCTION__, Promotor::find($this->params['promotors_id']));
		$this->params['actions']['promotor_id'] = $this->params['promotors_id'];
		$this->params['actions']['type'] = 'PromotionActions';

		$router = Config::get('router');

		$action = new Action($this->params['actions']);
		$promotion_action = new PromotionAction($this->params['promotion_action']);
		
		if ($promotion_action->indefinitely == 1) {
			$promotion_action->from_at = NULL;
			$promotion_action->to_at = NULL;
		}

		if ($action->save()) {
			$promotion_action->action_id = $action->id;

			if ($promotion_action->save()) {
				$this->alert('info', 'Utworzono akcje '.$action->name);

				$path = $router->generate('show_promotion_actions', ['promotors_id'=>$this->params['promotors_id'], 'id'=>$action->id]);
				header("Location: ".$path);
			} else {
				$this->alert('error', 'Nie udało się dodać akcji<br />Spróbuj pomownie');

				$this->params['action'] = 'new';
				$view = (new View($this->params, ['promotion_action'=>$promotion_action]))->render();
				return $view;
			}			
		} else {
			$this->alert('error', 'Nie udało się dodać akcji<br />Spróbuj pomownie');

			$this->params['action'] = 'new';
			$view = (new View($this->params, ['promotion_action'=>$promotion_action]))->render();
			return $view;
		}
	}
	public function edit()
	{
		$action = $this->action();
		$this->auth(__FUNCTION__, $action);
		
		$view = (new View($this->params, ['action'=>$action]))->render();
		return $view;
	}
	public function update()
	{
		$action = $this->action();
		$this->auth(__FUNCTION__, $action);
		
		$router = Config::get('router');

		$promotion_action = $action->promotionAction();
		
		if ($this->params['promotion_action']['indefinitely'] == '1') {
			
			unset($this->params['promotion_action']['from_at']);
			unset($this->params['promotion_action']['to_at']);
		}

		if ($action->update($this->params['actions'])) {
			
			$promotion_action->update($this->params['promotion_action']);

			$path = $router->generate('show_promotion_actions', ['promotors_id'=>$this->params['promotors_id'], 'id'=>$action->id]);
			header("Location: ".$path);
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

	public function action()
	{
		return Action::find($this->params['id']);
	}
}