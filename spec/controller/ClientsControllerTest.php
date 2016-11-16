<?php
use Sunra\PhpSimple\HtmlDomParser;
/**
* 
*/
class ClientsControllerTest extends Tests
{
	function seed(){
		MyDB::clearDatabaseExceptSchema();

		$promotor = new Promotor(['email'=>'test1@test.com', 'password_degest'=>Password::encryptPassword('password1'), 'name'=>'promotor1']);
		$promotor->save();

		$promotor = new Promotor(['email'=>'test2@test.com', 'password_degest'=>Password::encryptPassword('password2'), 'name'=>'promotor2']);
		$promotor->save();

		$promotion_action = new PromotionAction(['name'=>'action1', 'promotors_id'=>1, 'status'=>'active', 'indefinitely'=>1]);
		$promotion_action->save();

		$promotion_action = new PromotionAction(['name'=>'action2', 'promotors_id'=>1, 'status'=>'active', 'indefinitely'=>1]);
		$promotion_action->save();

		$promotion_action = new PromotionAction(['name'=>'action3', 'promotors_id'=>2, 'status'=>'active', 'indefinitely'=>1]);
		$promotion_action->save();

		$package = new PromotionCodesPackage(['name'=>'package1', 'action_id'=>'1', 'reusable'=>0, 'quantity'=>4, 'codes_value'=>143, 'status'=>'active']);
		$package->save();

		$package = new PromotionCodesPackage(['name'=>'package2', 'action_id'=>'1', 'reusable'=>0, 'quantity'=>4, 'codes_value'=>1324, 'status'=>'active']);
		$package->save();

		$client = new Client(['email'=>'test1@test.com', 'name'=>'client1', 'phone_number'=>'123456789', 'hash'=>HashGenerator::generate()]);
		$client->save();

		$_SESSION['user'] = $client;

		$client = new Client(['email'=>'test2@test.com', 'name'=>'client2', 'phone_number'=>'123456789', 'hash'=>HashGenerator::generate()]);
		$client->save();

		$points_balance = new PointsBalance(['client_id'=>1, 'promotor_id'=>1, 'balance'=>100]);
		$points_balance->save();

		$points_balance = new PointsBalance(['client_id'=>1, 'promotor_id'=>2, 'balance'=>43]);
		$points_balance->save();

		$points_balance = new PointsBalance(['client_id'=>2, 'promotor_id'=>1, 'balance'=>232]);
		$points_balance->save();

		$reward = new Reward(['name' => 'Reward1', 'status' => 'active', 'prize' => 10, 'description' => 'Desc r1', 'promotors_id' => 1]);
		$reward->save();

		$reward = new Reward(['name' => 'Reward2', 'status' => 'active', 'prize' => 15, 'description' => 'Desc r2', 'promotors_id' => 2]);
		$reward->save();

		$order = new Order(['promotor_id'=>1, 'client_id'=>1, 'reward_id'=>1, 'order_date'=>date(Config::get('mysqltime'))]);
		$order->save();

		$order = new Order(['promotor_id'=>1, 'client_id'=>2, 'reward_id'=>1, 'order_date'=>date(Config::get('mysqltime'))]);
		$order->save();

		$order = new Order(['promotor_id'=>2, 'client_id'=>1, 'reward_id'=>1, 'order_date'=>date(Config::get('mysqltime'))]);
		$order->save();

		$description = 'Wykorzystanie kodu zaqwsx w akcji action1';
		History::addHistoryRecord(1, 100, 243, $description, 'add');
	}

	public function testShowAction()
	{
		$this->seed();

		$params['client_id'] = 1;
		$params['controller'] = 'ClientsController';
		$params['action'] = 'show';

		$action = $params['action'];

		$curl = new TesterTestRequest((new PromotionCodesPackagesController($params))->generate(), 'http://'.Config::get('host').'/package/generate', null, []);

		$code = PromotionCode::all([]);

		$code1 = $code[0];
		$code1->update(['used'=>date(Config::get('mysqltime')), 'client_id'=>1]);

		$code2 = $code[1];
		$code2->update(['used'=>date(Config::get('mysqltime')), 'client_id'=>1]);

		$controller = new $params['controller']($params);
		$view = $controller->$action();

		$html = HtmlDomParser::str_get_html($view);

		$elements = $html->find('tr.result');	

		Assert::expect(count($elements)) -> toEqual(1);

		unset($_SESSION['user']);
	}

	public function testIndexRewardsAction()
	{
		$this->seed();

		$params['client_id'] = 1;
		$params['promotors_id'] = 1;
		$params['controller'] = 'ClientsController';
		$params['action'] = 'indexRewards';

		$action = $params['action'];

		$controller = new $params['controller']($params);
		$view = $controller->$action();

		$html = HtmlDomParser::str_get_html($view);

		$elements = $html->find('div#reward_box');	

		Assert::expect(count($elements)) -> toEqual(1);

		unset($_SESSION['user']);
	}

	public function testIndexHistoryAction()
	{
		$this->seed();

		$params['client_id'] = 1;
    	$params['controller'] = 'ClientsController';
    	$params['action'] = 'indexHistory';

    	$action = $params['action'];

		$controller = new $params['controller']($params);
		$view = $controller->$action();

		$html = HtmlDomParser::str_get_html($view);

		$elements = $html->find('tr.result');	
		Assert::expect(count($elements)) -> toEqual(1);

		unset($_SESSION['user']);
	}

	public function testNewOrderAction()
	{
		$this->seed();

		$params['client_id'] = 1;
    	$params['reward_id'] = 1;
    	$params['controller'] = 'ClientsController';
    	$params['action'] = 'newOrder';

		$action = $params['action'];

		$controller = new $params['controller']($params);
		$view = $controller->$action();

		$html = HtmlDomParser::str_get_html($view);

		$elements = $html->find('tr.result');	
		Assert::expect(count($elements)) -> toEqual(2);

		$elements = $html->find('textarea');	
		Assert::expect(count($elements)) -> toEqual(1);

		$elements = $html->find('input');	
		Assert::expect(count($elements)) -> toEqual(1);

		unset($_SESSION['user']);
	}

	public function testGetRewardAction()
	{
		$this->seed();

		error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);

		$params['client_id'] = 1;
		$params['reward_id'] = 1;
		$params['controller'] = 'ClientsController';
		$params['action'] = 'getReward';
		$params['order'] = ['comment'=>''];

		$action = $params['action'];

		$controller = new $params['controller']($params);
		$view = $controller->$action();

		$order = Order::where('client_id=? AND promotor_id=? AND reward_id=?', ['client_id'=>1, 'promotor_id'=>1, 'reward_id'=>1]);
		$order = $order[0];

		Assert::expect($order->client_id) -> toEqual($params['client_id']);
		Assert::expect($order->promotor_id) -> toEqual(1);
		Assert::expect($order->reward_id) -> toEqual($params['reward_id']);

		unset($_SESSION['user']);
	}

	public function testindexOrdersAction()
	{
		$this->seed();

		$params['client_id'] = 1;
    	$params['controller'] = 'ClientsController';
    	$params['action'] = 'indexOrders';

		$action = $params['action'];

		$controller = new $params['controller']($params);
		$view = $controller->$action();

		$html = HtmlDomParser::str_get_html($view);

		$elements = $html->find('tr.result');	

		Assert::expect(count($elements)) -> toEqual(2);

		unset($_SESSION['user']);
	}
}