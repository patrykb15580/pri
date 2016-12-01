<?php
/**
* 
*/
class StaticPagesController extends Controller
{
	public $non_authorized = ['startPage', 'contest', 'contestAnswer', 'login', 'promotorLogin', 'insertCode', 'useCode', 'addPoints', 'confirmation', 'contestConfirmation', 'getOrCreateClient', 'loginHashSend'];

	public function startPage()
	{
		$view = (new View($this->params, [], 'start'))->render();
		return $view;
	}

	public function contest()
	{	
		$code = Code::findBy('code', $this->params['code']);
		$action = $code->action();

		if (!empty($action)) {

			if ($action->isActive()) {
				$view = (new View($this->params, ['action'=>$action], 'start'))->render();
				return $view;
			} else {
				$router = Config::get('router');
				$path = $router->generate('start_page', []);
				
				$this->alert('error', 'Ten konkurs został zakończony lub jest nie aktywny');
				header('Location: '.$path);
			}
		} else {
			$router = Config::get('router');
			$path = $router->generate('start_page', []);
			
			$this->alert('error', 'Podany konkurs nie istnieje');
			header('Location: '.$path);
		}
	}

	public function contestAnswer()
	{
		$router = Config::get('router');
		$action = Action::find($this->params['id']);
		$promotor = $action->promotor();
		$code = Code::findBy('code', $this->params['code']);

		$client = $this->getOrCreateClient($this->params);

		$answer = ContestAnswer::where('action_id=? AND client_id=?', ['action_id'=>$action->id, 'client_id'=>$client->id]);

		$points_balance = PointsBalance::where('client_id=? AND promotor_id=?', ['client_id'=>$client->id, 'promotor_id'=>$promotor->id]);

		if (empty($points_balance)) {
			$points_balance = new PointsBalance(['client_id'=>$client->id, 'promotor_id'=>$promotor->id, 'balance'=>0]);
			$points_balance->save();
		} else {
			$points_balance = $points_balance[0];
		}

		if (empty($answer)) {
			$answer = new ContestAnswer(['action_id'=>$action->id, 'client_id'=>$client->id, 'answer'=>$this->params['answer']['answer']]);

			if ($answer->save()) {
				$description = 'Przystąpienie do konkursu '.$action->name.' u promotora '.$promotor->name;

				$code->update(['used'=>date(Config::get('mysqltime')), 'client_id'=>$client->id]);
				History::addHistoryRecord($client->id, $points_balance->balance, $points_balance->balance, $description, 'add');
				
				$path = $router->generate('contest_confirm', ['code'=>$code->code]);
				
				header('Location: '.$path);
			} else {
				$this->alert('error', 'Twoja odpowiedź nie została zapisana, spróbuj jeszcze raz');
				$this->params['action'] = 'contest';

				$action = Action::find($this->params['id']);

				$view = (new View($this->params, ['action'=>$action], 'start'))->render();
				return $view;
			}
		} else {
			$this->alert('error', 'Bierzesz już udział w tym konkursie');

			$path = $router->generate('start_page', []);

			header('Location: '.$path);
		}
	}

	public function login()
	{	
		$view = (new View($this->params, [], 'start'))->render();
		return $view;
	}

	public function promotorLogin()
	{	
		$view = (new View($this->params, [], 'start'))->render();
		return $view;
	}

	public function insertCode()
	{	
		$router = Config::get('router');

		if (empty($this->params['code'])) {
			$this->alert('error', 'Podaj swój kod');
			$path = $router->generate('start_page', []);
			header('Location: '.$path);
		}

		$code = CodeChecker::checkCodeExist($this->params);
		
		Action::checkIfActionsActive();

		if ($code !== null && $code->isActive()) {
			$action = $code->action();

			if ($action->type == 'PromotionActions') {
				$path = $router->generate('use_code', ['code'=>$this->params['code']]);
				header('Location: '.$path);
			} else {
				$path = $router->generate('contest_answer', ['code'=>$this->params['code']]);
				header('Location: '.$path);
			}
		}
		else {
			$router = Config::get('router');
			$path = $router->generate('start_page', []);
			$this->alert('error', 'Błędny lub nieaktywny kod');
			header('Location: '.$path);
		}
	}

	public function useCode()
	{
		$code = Code::findBy('code', $this->params['code']);
		if (!empty($code)) {
			$package = $code->package();
			$action = $package->action();
			$promotor = $action->promotor();

			$view = (new View($this->params, ['code'=>$code, 'package'=>$package, 'promotion_action'=>$action, 'promotor'=>$promotor], 'start'))->render();
			return $view;
		} else {
			$view = (new View($this->params, [], '404'))->render();
			return $view;
		}
	}

	public function addPoints()
	{
		$client = $this->getOrCreateClient($this->params);
		$code = Code::findBy('code', $this->params['code']);
		$package = $code->package();
		$action = $package->action();
		$promotor = $action->promotor();
		
		$router = Config::get('router');

		$code->update(['used'=>date(Config::get('mysqltime')), 'client_id'=>$client->id]);

		$points_balance = PointsBalance::where('client_id=? AND promotor_id=?', ['client_id'=>$client->id, 'promotor_id'=>$promotor->id]);
		if (!empty($points_balance)) {
			$points_balance = $points_balance[0];
			$balance = $points_balance->balance + $package->codes_value;
			if ($points_balance->update(['balance'=>$balance])) {
				$description = 'Wykorzystanie kodu '.$this->params['code'].' w akcji '.$promotion_action->name;
				History::addHistoryRecord($client->id, $balance, $package->codes_value, $description, 'add');
				(new ClientMailer)->addPoints($client, $code, $promotor);

				$path = $router->generate('confirmation', ['code'=>$this->params['code']]);
				header('Location: '.$path);
			}

		} else {
			$points_balance = new PointsBalance(['client_id'=>$client->id, 'promotor_id'=>$promotor->id, 'balance'=>$package->codes_value]);
			if ($points_balance->save()) {
				$description = 'Wykorzystanie kodu '.$this->params['code'].' w akcji '.$promotion_action->name;
				History::addHistoryRecord($client->id, $package->codes_value, $package->codes_value, $description, 'add');
				(new ClientMailer)->addPoints($client, $code, $promotor);
				
				$path = $router->generate('confirmation', ['code'=>$this->params['code']]);
				header('Location: '.$path);
			}
		} 	
	}

	public function confirmation()
	{	
		$code = Code::findBy('code', $this->params['code']);
		if (!empty($code)) {
			$package = $code->package();
			$action = $package->action();
			$promotor = $action->promotor();

			$view = (new View($this->params, ['code'=>$code, 'package'=>$package, 'promotion_action'=>$action, 'promotor'=>$promotor], 'start'))->render();
		return $view;
		} else {
			$view = (new View($this->params, [], '404'))->render();
			return $view;
		}
	}

	public function contestConfirmation()
	{	
		$code = Code::findBy('code', $this->params['code']);
		if (!empty($code)) {
			$package = $code->package();
			$action = $package->action();
			$promotor = $action->promotor();

			$view = (new View($this->params, ['code'=>$code, 'package'=>$package, 'promotion_action'=>$action, 'promotor'=>$promotor], 'start'))->render();
		return $view;
		} else {
			$view = (new View($this->params, [], '404'))->render();
			return $view;
		}
	}

	public function authorizeError()
	{
		$view = (new View($this->params, [], 'authorize_error'))->render();
		return $view;
	}
	
	private function getOrCreateClient()
	{
		$client = Client::findBy('email', $this->params['client']['email']);

		if (!$client) {
			$this->params['client']['hash'] = HashGenerator::generate();
			$client = new Client($this->params['client']);
			$client->save();

			(new ClientMailer)->createClient($client);

			return $client;
		} else {
			return $client;
		}
	}

	private function emptyFormCheck($params)
	{
		if (empty($params['client']['email'])) {
			return true;
		} else if (empty($params['client']['name'])) {
			return true;
		} else if (empty($params['client']['phone_number'])) {
			return true;
		} else {
			return false;
		}
	}

	public function loginHashSend()
	{
		$router = Config::get('router');
		$prev_page = $router->generate('login', []);

		$email = $this->params['client_email'];
		$client = Client::findBy('email', $email);


		if (empty($client)) {
			$this->alert('error', 'Brak klienta o podanym adresie email');
			header('Location: '.$prev_page);
		} else {
			(new ClientMailer)->clientHash($client);

			$this->alert('info', 'Twój link do logowania został wysłany na podany adres email');
			header('Location: '.$prev_page);
		}
	}

	public function checkIfActionsActive()
	{
		Action::checkIfActionsActive();
	}
}