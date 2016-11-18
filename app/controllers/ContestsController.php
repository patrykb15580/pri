<?php
/**
* 
*/
class ContestsController extends Controller
{
	public function index()
	{	
		$promotor = Promotor::find($this->params['promotors_id']);
		$this->auth(__FUNCTION__, $promotor);

		$view = (new View($this->params, ['promotor'=>$promotor]))->render();
		return $view;
		
	}
	public function show()
	{	
		$contest = $this->contest();
		$this->auth(__FUNCTION__, $contest);

		$view = (new View($this->params, ['contest'=>$contest]))->render();
		return $view;
		
	}
	public function new()
	{
		$this->auth(__FUNCTION__, Promotor::find($this->params['promotors_id']));
		$contest = new Contest;
		
		$view = (new View($this->params, ['contest'=>$contest]))->render();
		return $view;
	}
	public function create()
	{
		$this->auth(__FUNCTION__, Promotor::find($this->params['promotors_id']));
		$this->params['contest']['promotor_id'] = $this->params['promotors_id'];
		$contest = new Contest($this->params['contest']);

		if ($contest->save()) {
			$this->alert('info', 'Utworzono konkurs '.$contest->name);
			header("Location: http://".$_SERVER['HTTP_HOST']."/promotors/".$this->params['promotors_id']."/contests");
		} else {
			$this->alert('error', 'Nie udało się utworzyć konkursu, spróbuj ponownie');

			$this->params['action'] = 'new';
			$view = (new View($this->params, ['contest'=>$contest]))->render();
			return $view;
		}
	}
	public function edit()
	{
		$contest = $this->contest();
		$this->auth(__FUNCTION__, $contest);
		
		$view = (new View($this->params, ['contest'=>$contest]))->render();
		return $view;
	}
	public function update()
	{
		$contest = $this->contest();
		$this->auth(__FUNCTION__, $contest);

		if ($contest->update($this->params['contest'])) {
			header("Location: http://".$_SERVER['HTTP_HOST']."/promotors/".$this->params['promotors_id']."/contests/".$this->params['contest_id']); 
		} else {
			$this->params['action'] = 'edit';

			$this->alert('error', 'Nie udało się zaktualizować konkursu');
			$view = (new View($this->params, ['contest'=>$contest]))->render();
			return $view;
		}		
	}

	public function getRandomAnswer()
	{
		$answers = ContestAnswer::where('contest_id=?', ['contest_id'=>$this->params['contest_id']], ['order'=>'created_at DESC']);

		$answer = array_rand($answers, 1);
		$answer = $answers[$answer];

		ob_start();
		include 'app/views/'.StringUntils::camelCaseToUnderscore(str_replace('Controller', '', $this->params['controller'])).'/random_answer.php';
		$view = ob_get_contents();
		ob_end_clean();

		return $view;
	}

	public function contest()
	{
		return Contest::find($this->params['contest_id']);
	}

	#public function checkIfContestActive()
	#{
	#	Contest::checkIfContestActive();
	#}
}