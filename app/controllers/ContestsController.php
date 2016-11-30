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
		$action = $this->action();
		$this->auth(__FUNCTION__, $action);

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
		$this->params['action']['promotor_id'] = $this->params['promotors_id'];
		$this->params['action']['type'] = 'Contests';

		$action = new Action($this->params['action']);
		$contest = new Contest($this->params['contest']);

		if ($action->save()) {
			$contest->action_id = $action->id;
			$contest->save();

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
		$action = $this->action();
		$this->auth(__FUNCTION__, $action);
		
		$view = (new View($this->params, ['action'=>$action]))->render();
		return $view;
	}
	public function update()
	{
		$action = $this->action();
		$this->auth(__FUNCTION__, $action);

		$contest = Contest::findBy('action_id', $action->id);

		if ($action->update($this->params['action'])) {
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
		$this->auth(__FUNCTION__, $action);
		
		$view = (new View($this->params, ['action'=>$action]))->render();
		return $view;
	}

	public function createContestStickersPackage()
	{
		$action = $this->action();
		$this->auth(__FUNCTION__, $action);

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
		$answers = ContestAnswer::where('action_id=?', ['action_id'=>$this->params['contest_id']], ['order'=>'created_at DESC']);

		$answer = array_rand($answers, 1);
		$answer = $answers[$answer];

		ob_start();
		include 'app/views/'.StringUntils::camelCaseToUnderscore(str_replace('Controller', '', $this->params['controller'])).'/random_answer.php';
		$view = ob_get_contents();
		ob_end_clean();

		return $view;
	}

	/* Funkcja uruchamiana z adresu URL */
	public function generate()
	{	
		$packages = ContestStickersPackage::where('`generated` < `quantity`', []);

		foreach ($packages as $package) {
			$i = 0;
			$number_codes_to_generate = $package->quantity - $package->generated;

			while ($i < $number_codes_to_generate) { 
				$code_generator = new PromotionCodesGenerator;
				$code = $code_generator->promotionCodeGenerator(6);
				$promotion_code = new PromotionCode(['code'=>$code, 'package_id'=>$package->id, 'type'=>'contest']);

				if ($promotion_code->save()) {
					$i++;
					$package->generated++;
					$package->save();
				}
			}
		}		
	}

	public function action()
	{
		return Action::find($this->params['contest_id']);
	}

	#public function checkIfContestActive()
	#{
	#	Contest::checkIfContestActive();
	#}
}