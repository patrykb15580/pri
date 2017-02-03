<?php
/**
* 
*/
class OpinionsController extends Controller
{
	public function index()
	{	
		$promotor = $this->promotor();
		$this->auth(__FUNCTION__, $promotor);

		$view = (new View($this->params, ['promotor'=>$promotor]))->render();
		return $view;
		
	}
	public function show()
	{	
		$action = $this->action();
		$this->auth(__FUNCTION__, $this->promotor());

		$view = (new View($this->params, ['action'=>$action]))->render();
		return $view;
		
	}

	public function action()
	{
		return Action::find($this->params['opinion_id']);
	}

	public function promotor()
	{
		return Promotor::find($this->params['promotors_id']);
	}
}