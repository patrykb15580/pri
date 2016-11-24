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

	public function client()
	{
		return Client::find($this->params['client_id']);
	}
}