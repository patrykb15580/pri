<?php
/**
* 
*/
class StaticPagesController extends Controller
{
	public $non_authorized = ['startPage', 'contestOpinion', 'giveContestOpinion', 'contest', 'contestAnswer', 'login', 'promotorLogin', 'insertCode', 'getCode', 'useCode', 'addPoints', 'confirmation', 'contestConfirmation', 'getOrCreateClient', 'loginHashSend', 'newPassword', 'forgotPassword', 'forgotPasswordSendMail', 'changePassword'];

	public function startPage()
	{
		$view = (new View($this->params, [], 'start'))->render();
		return $view;
	}

	public function contestOpinion()
	{	
		$router = Config::get('router');
		$code = Code::findBy('code', $this->params['code']);
		
		if (!empty($code)) {
			$action = $code->action();

			if (!empty($action)) {

				if ($action->isActive()) {
					$view = (new View($this->params, ['action'=>$action], 'start'))->render();
					return $view;
				} else {
					$path = $router->generate('start_page', []);
					
					$this->alert('error', 'Ten konkurs został zakończony lub jest nie aktywny');
					header('Location: '.$path);
				}
			} else {
				$path = $router->generate('start_page', []);
				
				$this->alert('error', 'Podany konkurs nie istnieje');
				header('Location: '.$path);
			}
		} else {
			$path = $router->generate('start_page', []);
				
			$this->alert('error', 'Podany konkurs nie istnieje');
			header('Location: '.$path);
		}
	}

	public function giveContestOpinion()
	{	
		$code = Code::findBy('code', $this->params['code']);
		$action = $code->action();

		$router = Config::get('router');

		$client = $this->getOrCreateClient($this->params);

		if ($this->params['rating'] !== '0') {
			$rate = new Rate(['client_id'=>$client->id, 'action_id'=>$action->id, 'rate'=>$this->params['rating']]);
		}

		if (isset($rate)) {
			if ($rate->save()) {
				$code->update(['used'=>date(Config::get('mysqltime')), 'client_id'=>$client->id]);

				$path = $router->generate('contest_answer', ['code'=>$code->code, 'client_id'=>$client->id]);
				
				header('Location: '.$path);
			} else {
				$path = $router->generate('contest_opinion', ['code'=>$code->code]);
				
				$this->alert('error', 'Nie udało się dodać twojej opinii, spróbuj jeszcze raz');
				header('Location: '.$path);
			}
		} else {
			$path = $router->generate('contest_answer', ['code'=>$code->code]);

			header('Location: '.$path);
		}
	}

	public function contest()
	{	
		$router = Config::get('router');
		$code = Code::findBy('code', $this->params['code']);

		if (!empty($code)) {

			$action = $code->action();
			$client = Client::find($this->params['client_id']);

			if (!empty($action)) {

				if ($action->isActive()) {
					$view = (new View($this->params, ['action'=>$action], 'start'))->render();
					return $view;
				} else {
					$path = $router->generate('start_page', []);
					
					$this->alert('error', 'Ten konkurs został zakończony lub jest nie aktywny');
					header('Location: '.$path);
				}
			} else {
				$path = $router->generate('start_page', []);
				
				$this->alert('error', 'Podany konkurs nie istnieje');
				header('Location: '.$path);
			}
		} else {
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

		$client = Client::find($this->params['client_id']);

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
				$description = 'Przystąpienie do konkursu '.$action->name;

				$code->update(['used'=>date(Config::get('mysqltime')), 'client_id'=>$client->id]);
				History::addHistoryRecord($client->id, $promotor->id, $points_balance->balance, 0, $description, 'contest');
				(new ClientMailer)->contest($client, $code, $promotor);
				
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

		$code = $this->params['code'];
		$path = $router->generate('get_code', ['code'=>$code]);

		header('Location: '.$path);
	}

	public function getCode()
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
				$path = $router->generate('contest_opinion', ['code'=>$this->params['code']]);
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
		setcookie('use_code_form_email', $this->params['client']['email'], time() + (86400 * 30), '/');
		setcookie('use_code_form_name', $this->params['client']['name'], time() + (86400 * 30), '/');
		setcookie('use_code_form_phone_number', $this->params['client']['phone_number'], time() + (86400 * 30), '/');

		$client = $this->getOrCreateClient($this->params);

		if (empty($client)) {
			$path = $router->generate('use_code', ['code'=>$this->params['code']]);
			header('Location: '.$path);
		}

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
				$description = 'Wykorzystanie kodu '.$this->params['code'].' w akcji '.$action->name;
				History::addHistoryRecord($client->id, $promotor->id, $balance, $package->codes_value, $description, 'add');
				(new ClientMailer)->addPoints($client, $code, $promotor);

				$path = $router->generate('confirmation', ['code'=>$this->params['code']]);
				header('Location: '.$path);
			}

		} else {
			$points_balance = new PointsBalance(['client_id'=>$client->id, 'promotor_id'=>$promotor->id, 'balance'=>$package->codes_value]);
			if ($points_balance->save()) {
				$description = 'Wykorzystanie kodu '.$this->params['code'].' w akcji '.$action->name;
				History::addHistoryRecord($client->id, $promotor->id, $package->codes_value, $package->codes_value, $description, 'add');
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
			$this->params['client']['password_digest'] = Password::encryptPassword('');
			$client = new Client($this->params['client']);
			if (!$client->save()) {
				$this->alert('error', 'Nie udało się utworzyć profilu klienta.');
			} else {
				#$token = new Token(['token'=>HashGenerator::generate(), 'client_id'=>$client->id]);
				#$token->save();
				(new ClientMailer)->createClient($client);
			}

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
			$this->alert('info', 'Twój link do logowania został wysłany na podany adres email');
			header('Location: '.$prev_page);
		} else {
			(new ClientMailer)->clientHash($client);

			$this->alert('info', 'Twój link do logowania został wysłany na podany adres email');
			header('Location: '.$prev_page);
		}
	}

	public function forgotPassword()
	{
		$view = (new View($this->params, [], 'start'))->render();
		return $view;
	}

	public function forgotPasswordSendMail()
	{
		$router = Config::get('router');

		$client = Client::findBy('email', $this->params['email']);

		$token = new Token(['token'=>HashGenerator::generate(), 'client_id'=>$client->id]);

		if ($token->save()) {

			(new ClientMailer)->forgotPassword($client, $token);
			$this->alert('info', 'Link do zmiany hasła został wysłany na podany adres email');

		} else $this->alert('error', 'Nie udało się zresetować hasła, spróbuj jeszcze raz');

		header('Location: '.$router->generate('login', []));
	}

	public function newPassword()
	{
		Token::checkIfTokensExpired();

		$router = Config::get('router');
		$token = Token::findBy('token', $this->params['token']);

		if (empty($token)) {
			$this->alert('error', 'Twój token zmiany hasła wygasł');
			header('Location: '.$router->generate('login', []));
		} else {
			$client = Client::find($token->client_id);

			$view = (new View($this->params, ['token'=>$token, 'client'=>$client], 'start'))->render();
			return $view;
		}
	}

	public function changePassword()
	{
		$router = Config::get('router');

		$token = Token::findBy('token', $this->params['token']);
		$client = Client::find($token->client_id);

		$password = Password::encryptPassword($this->params['new_password']['password']);
		$confirm = Password::encryptPassword($this->params['new_password']['confirm']);

		if ($password !== $confirm) {
			$this->alert('error', 'Podane hasła różnią się.');
			header('Location: '.$router->generate('new_password', ['token'=>$token->token]));
		} 

		if ($client->update(['password_digest'=>$password])) {
			$this->alert('info', 'Twoje hasło zostało zmienione.');
			$token->destroy();

			header('Location: '.$router->generate('login', []));
		}
	}

	public function checkIfActionsActive()
	{
		Action::checkIfActionsActive();
	}
}