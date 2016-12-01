<?php
/**
* 
*/
class ClientsController extends Controller
{
	public function show()
	{
		$client = $this->client();
		$this->auth(__FUNCTION__, $client);

		$view = (new View($this->params, ['client'=>$client]))->render();
		return $view;
	}

	public function indexContests()
	{
		$client = $this->client();
		$this->auth(__FUNCTION__, $client);

		$view = (new View($this->params, ['client'=>$client]))->render();
		return $view;
	}

	public function indexRewards()
	{
		$this->auth(__FUNCTION__, $this->client());
		$promotor = Promotor::find($this->params['promotors_id']);

		$view = (new View($this->params, ['promotor'=>$promotor]))->render();
		return $view;
	}

	public function showRewards()
	{	
		#$this->auth(__FUNCTION__, $this->client());
		$reward = Reward::find($this->params['reward_id']);
		
		$images = RewardImage::where('reward_id=?', ['reward_id'=>$this->params['reward_id']]);
		
		ob_start();

		include $path = './app/views/'.StringUntils::camelCaseToUnderscore(str_replace('Controller', '', $this->params['controller'])).'/'.$this->params['action'].'.php';
		$view = ob_get_contents();

		ob_end_clean();

		return $view;	
	}

	public function indexHistory()
	{
		$this->auth(__FUNCTION__, $this->client());
		$histories = History::where('client_id=?', ['client_id'=>$this->params['client_id']], ['order'=>'created_at DESC']);
		
		$view = (new View($this->params, ['histories'=>$histories]))->render();
		return $view;
	}

	public function newOrder()
	{	
		$client = $this->client();
		$this->auth(__FUNCTION__, $client);
		
		$reward = Reward::find($this->params['reward_id']);
		$promotor = $reward->promotor();
		
		$points_balance = $client->balance($promotor);

		$view = (new View($this->params, ['reward'=>$reward, 'client'=>$client, 'points_balance'=>$points_balance]))->render();
		return $view;
		
	}

	public function getReward()
	{
		$this->auth(__FUNCTION__, $this->client());
		$reward = Reward::find($this->params['reward_id']);

		$this->params['order']['promotor_id'] = $reward->promotors_id;
		$this->params['order']['client_id'] = $this->params['client_id'];
		$this->params['order']['reward_id'] = $this->params['reward_id'];
		$this->params['order']['order_date'] = date(Config::get('mysqltime'));

		$order = new Order($this->params['order']);

		$router = Config::get('router');
		
		$path = $router->generate('index_client_orders', ['client_id' => $this->params['client_id']]);

		if ($order->save()) {
			$points_balance = PointsBalance::where('client_id=? AND promotor_id=?', ['client_id'=>$this->params['client_id'], 'promotor_id'=>$reward->promotors_id]);
			$points_balance = $points_balance[0];
			$balance = $points_balance->balance - $reward->prize;

			if ($points_balance->update(['balance'=>$balance])) {
				$description = 'Zakup nagrody '.$reward->name;
				History::addHistoryRecord($order->client_id, $balance, $reward->prize, $description, 'buy');

				(new ClientMailer)->getReward($this->client(), $order);

				$this->alert('info', 'Dziękujemy za złożenie zamówienia');
				header('Location: '.$path);
			}
		} else {
			$this->alert('error', 'Nie udało się utworzyć zamówienia');
			header('Location: '.$path);
		}
	}

	public function indexOrders()
	{
		$client = $this->client();
		$this->auth(__FUNCTION__, $client);
		
		$view = (new View($this->params, ['client'=>$client]))->render();
		return $view;
	}

	public function code()
	{
		$client = $this->client();
		$this->auth(__FUNCTION__, $client);
		
		$view = (new View($this->params, ['client'=>$client]))->render();
		return $view;
	}

	public function insertCode()
	{	
		$router = Config::get('router');

		if (empty($this->params['code'])) {
			$this->alert('error', 'Podaj swój kod');
			$path = $router->generate('client_code', ['client_id'=>$this->params['client_id']]);
			header('Location: '.$path);
		}

		$code = CodeChecker::checkCodeExist($this->params);

		Action::checkIfActionsActive();

		if ($code !== null && $code->isActive()) {

			$action = $code->action();

			if ($action->type == 'PromotionActions') {
				$this->addPoints($this->params);
			} else {
				$path = $router->generate('client_answer', ['client_id'=>$this->params['client_id'], 'code'=>$this->params['code']]);
				header('Location: '.$path);
			}
		}
		else {
			$router = Config::get('router');
			$path = $router->generate('client_code', ['client_id'=>$this->params['client_id']]);
			$this->alert('error', 'Błędny lub nieaktywny kod');
			header('Location: '.$path);
		}
	}

	private function addPoints($params)
	{
		$router = Config::get('router');

		$client = $this->client();
		$code = Code::findBy('code', $params['code']);
		$package = $code->package();
		$action = $package->action();
		$promotor = $action->promotor();		

		$code->update(['used'=>date(Config::get('mysqltime')), 'client_id'=>$client->id]);

		$points_balance = PointsBalance::where('client_id=? AND promotor_id=?', ['client_id'=>$client->id, 'promotor_id'=>$promotor->id]);
		if (!empty($points_balance)) {
			$points_balance = $points_balance[0];
			$balance = $points_balance->balance + $package->codes_value;
			if ($points_balance->update(['balance'=>$balance])) {
				$description = 'Wykorzystanie kodu '.$params['code'].' w akcji '.$promotion_action->name;
				History::addHistoryRecord($client->id, $balance, $package->codes_value, $description, 'add');
				(new ClientMailer)->addPoints($client, $code, $promotor);

				$this->alert('info', 'Dodano punkty w akcji '.$action->name.' promotora '.$promotor->name);

				$path = $router->generate('client_code', ['client_id'=>$client->id]);
				header('Location: '.$path);
			}

		} else {
			$points_balance = new PointsBalance(['client_id'=>$client->id, 'promotor_id'=>$promotor->id, 'balance'=>$package->codes_value]);
			if ($points_balance->save()) {
				$description = 'Wykorzystanie kodu '.$params['code'].' w akcji '.$promotion_action->name;
				History::addHistoryRecord($client->id, $package->codes_value, $package->codes_value, $description, 'add');
				(new ClientMailer)->addPoints($client, $code, $promotor);
				
				$this->alert('info', 'Dodano punkty w akcji '.$action->name.' promotora '.$promotor->name);

				$path = $router->generate('client_code', ['client_id'=>$client->id]);
				header('Location: '.$path);
			}
		}
	}

	public function answer()
	{
		$client = $this->client();
		$this->auth(__FUNCTION__, $client);
		
		$view = (new View($this->params, ['client'=>$client]))->render();
		return $view;
	}

	public function giveAnswer()
	{
		$router = Config::get('router');
		$code = Code::findBy('code', $this->params['code']);
		$action = $code->action();
		$promotor = $action->promotor();

		$client = $this->client();

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
				
				$path = $router->generate('client_code', ['client_id'=>$client->id]);
				$this->alert('info', 'Dziękujemy za wzięcie udziału w naszym konkursie');
				header('Location: '.$path);
			} else {
				$this->alert('error', 'Twoja odpowiedź nie została zapisana, spróbuj jeszcze raz');
				$this->params['action'] = 'answer';

				$view = (new View($this->params, ['code'=>$code]))->render();
				return $view;
			}
		} else {
			$this->alert('error', 'Bierzesz już udział w tym konkursie');

			$path = $router->generate('client_code', ['client_id'=>$client->id]);

			header('Location: '.$path);
		}
	}

	public function client()
	{
		return Client::find($this->params['client_id']);
	}
}