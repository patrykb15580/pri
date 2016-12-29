<?php
/**
* 
*/
class ContestsController extends Controller
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
	public function new()
	{
		$this->auth(__FUNCTION__, $this->promotor());
		$action = new Action;
		
		$view = (new View($this->params, ['action'=>$action]))->render();
		return $view;
	}
	public function create()
	{
		$this->auth(__FUNCTION__, $this->promotor());
		$this->params['actions']['promotor_id'] = $this->params['promotors_id'];
		$this->params['actions']['type'] = 'Contests';

		$router = Config::get('router');

		if (substr($this->params['contest']['question'], -1) !== '?') {
			$this->params['contest']['question'] = $this->params['contest']['question'].'?';
		}

		if (substr($this->params['contest']['opinion'], -1) !== '?') {
			$this->params['opinion']['question'] = $this->params['opinion']['question'].'?';
		}

		$action = new Action($this->params['actions']);
		$contest = new Contest($this->params['contest']);
		$opinion = new Opinion($this->params['opinion']);

		if ($action->save()) {
			$contest->action_id = $action->id;
			$contest->save();

			$opinion->action_id = $action->id;
			$opinion->save();

			$path = $router->generate('show_contests', ['promotors_id'=>$this->params['promotors_id'], 'id'=>$action->id]);
			$this->alert('info', 'Utworzono konkurs '.$action->name);
			header("Location: ".$path);
		} else {
			$this->alert('error', 'Nie udało się utworzyć konkursu, spróbuj ponownie');

			$this->params['action'] = 'new';
			$view = (new View($this->params, ['contest'=>$contest]))->render();
			return $view;
		}
	}
	public function edit()
	{
		$action = $this->action();
		$this->auth(__FUNCTION__, $this->promotor());
		
		$view = (new View($this->params, ['action'=>$action]))->render();
		return $view;
	}
	public function update()
	{
		$action = $this->action();
		$this->auth(__FUNCTION__, $this->promotor());

		$contest = Contest::findBy('action_id', $action->id);

		if ($action->update($this->params['actions'])) {
			$contest->update($this->params['contest']);

			$this->alert('info', 'Dane konkursu zostały zaktualizowane');
			header("Location: http://".$_SERVER['HTTP_HOST']."/promotors/".$this->params['promotors_id']."/contests/".$this->params['contest_id']); 
		} else {
			$this->params['action'] = 'edit';

			$this->alert('error', 'Nie udało się zaktualizować konkursu');
			$view = (new View($this->params, ['contest'=>$contest]))->render();
			return $view;
		}		
	}

	public function newContestStickersPackage()
	{
		$action = $this->action();
		$this->auth(__FUNCTION__, $this->promotor());
		
		$view = (new View($this->params, ['action'=>$action]))->render();
		return $view;
	}

	public function createContestStickersPackage()
	{
		$action = $this->action();
		$this->auth(__FUNCTION__, $this->promotor());

		$this->params['package']['action_id'] = $this->params['contest_id'];
		$this->params['package']['codes_value'] = 0;
		$package = new CodesPackage($this->params['package']);

		if ($package->save()) {
			$this->alert('info', 'Dziękujemy za złożenie zamówienia');


			$admin_order = new AdminOrder(['promotor_id'=>$this->params['promotors_id'],
										   'package_type' => 'contest',
										   'package_id'=>$package->id,
										   'quantity'=>$package->quantity,
										   'order_date'=>$package->created_at]);

			$admin_order->save();

			(new AdminMailer)->newAdminOrder(Config::get('mailing_address'), $admin_order);

			header("Location: http://".$_SERVER['HTTP_HOST']."/promotors/".$this->params['promotors_id']."/contests/".$this->params['contest_id']);
		} else {
			$this->alert('error', 'Nie udało się zamówić pakietu naklejek, spróbuj ponownie');

			$this->params['action'] = 'newContestStickersPackage';
			$view = (new View($this->params, ['contest'=>$contest]))->render();
		return $view;
		}
	}

	public function getRandomAnswer()
	{
		$answers = ContestAnswer::where('action_id=?', ['action_id'=>$this->params['action_id']], ['order'=>'created_at DESC']);

		$answer = array_rand($answers, 1);
		$answer = $answers[$answer];

		ob_start();
		include 'app/views/'.StringUntils::camelCaseToUnderscore(str_replace('Controller', '', $this->params['controller'])).'/random_answer.php';
		$view = ob_get_contents();
		ob_end_clean();

		return $view;
	}

	public function action()
	{
		return Action::find($this->params['contest_id']);
	}

	public function promotor()
	{
		return Promotor::find($this->params['promotors_id']);
	}

	#public function checkIfContestActive()
	#{
	#	Contest::checkIfContestActive();
	#}
}