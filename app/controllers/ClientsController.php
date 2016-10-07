<?php
/**
* 
*/
class ClientsController extends Controller
{
	public function show()
	{
		$client = Client::find($this->params['client_id']);
		$codes = $client->promotionCodes();
		
		$packages = $client->packages();
		$packages_values = $client->packagesValues();
		$promotion_actions = $client->promotionActions();
		$promotion_actions_values = $client->promotionActionsValues();
		$promotors = $client->promotors();

		(new View($this->params, ['packages'=>$packages,'packages_values'=>$packages_values, 'promotion_actions'=>$promotion_actions, 'promotion_actions_values'=>$promotion_actions_values, 'promotors'=>$promotors]))->render();
	}

	public function indexRewards()
	{
		$promotor = Promotor::find($this->params['promotors_id']);

		(new View($this->params, ['promotor'=>$promotor]))->render();
	}

	public function showRewards()
	{	
		$reward = Reward::find($this->params['reward_id']);
		
		$images = RewardImage::where('reward_id=?', ['reward_id'=>$this->params['reward_id']]);
		
		(new View($this->params, ['reward'=>$reward, 'images'=>$images]))->render();	
	}

	public function indexHistory()
	{
		$histories = History::where('client_id=?', ['client_id'=>$this->params['client_id']], ['order'=>'created_at DESC']);
		
		(new View($this->params, ['histories'=>$histories]))->render();
	}

	public function newOrder()
	{	
		$client = Client::find($this->params['client_id']);
		$reward = Reward::find($this->params['reward_id']);
		$promotor = $reward->promotor();
		
		$points_balance = $client->balance($promotor);

		(new View($this->params, ['reward'=>$reward, 'promotor'=>$promotor, 'points_balance'=>$points_balance]))->render();
		
	}

	public function getReward()
	{
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

				header('Location: '.$path.'?order=confirm');
			}
		} else {
			header('Location: '.$path.'?order=error');
		}
	}

	public function indexOrders()
	{
		$client = Client::find($this->params['client_id']);
		#echo "<pre>";
		#die(print_r($client));
		$active_orders = $client->activeOrders();
		$completed_orders = $client->completedOrders();
		$canceled_orders = $client->canceledOrders();
		
		(new View($this->params, ['active_orders'=>$active_orders, 'completed_orders'=>$completed_orders, 'canceled_orders'=>$canceled_orders]))->render();
	}
}