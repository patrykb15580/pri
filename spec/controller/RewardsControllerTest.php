<?php
use Sunra\PhpSimple\HtmlDomParser;
/**
* 
*/
class RewardsControllerTest extends Tests
{
	function seed(){
		MyDB::clearDatabaseExceptSchema();

		$promotor = new Promotor(['email'=>'test1@test.com', 'password_degest'=>Password::encryptPassword('password1'), 'name'=>'promotor1']);
		$promotor->save();

		$_SESSION['user'] = $promotor;

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

	public function testIndexAction()
	{
		$this->seed();

		$params['promotors_id'] = 1;
		$params['controller'] = 'RewardsController';
		$params['action'] = 'index';

		$action = $params['action'];

		$controller = new $params['controller']($params);
		$view = $controller->$action();

		$html = HtmlDomParser::str_get_html($view);

		$elements = $html->find('tr.result');	

		Assert::expect(count($elements)) -> toEqual(1);

		unset($_SESSION['user']);
	}

	public function testShowAction()
	{
		$this->seed();

		$params['promotors_id'] = 1;
		$params['id'] = 1;
		$params['controller'] = 'RewardsController';
		$params['action'] = 'show';

		$action = $params['action'];

		$controller = new $params['controller']($params);
		$view = $controller->$action();

		$html = HtmlDomParser::str_get_html($view);

		$elements = $html->find('div#reward_description');	
		Assert::expect(count($elements)) -> toEqual(1);

		$elements = $html->find('div#reward_images_container');	
		Assert::expect(count($elements)) -> toEqual(1);

		unset($_SESSION['user']);
	}

	public function testNewAction()
	{
		$this->seed();

		$params['promotors_id'] = 1;
		$params['controller'] = 'RewardsController';
		$params['action'] = 'new';

		$action = $params['action'];

		$controller = new $params['controller']($params);
		$view = $controller->$action();

		$html = HtmlDomParser::str_get_html($view);

		$elements = $html->find('input');	
		Assert::expect(count($elements)) -> toEqual(4);

		$elements = $html->find('select');	
		Assert::expect(count($elements)) -> toEqual(1);

		$elements = $html->find('textarea');	
		Assert::expect(count($elements)) -> toEqual(1);

		$elements = $html->find('div#reward_images_container');	
		Assert::expect(count($elements)) -> toEqual(1);

		unset($_SESSION['user']);
	}

	public function testCreateAction()
	{
		$this->seed();

		error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);

		$params['promotors_id'] = 1;
		$params['controller'] = 'RewardsController';
		$params['action'] = 'create';
		$params['reward'] = ['name' => 'test',
            				 'status' => 'active',
            				 'prize' => 12,
            				 'description' => 'desc'];

		$action = $params['action'];

		$controller = new $params['controller']($params);
		$view = $controller->$action();
		
		$reward = Reward::where('promotors_id=? AND name=?', ['promotors_id'=>$params['promotors_id'], 'name'=>$params['reward']['name']]);
		$reward = $reward[0];

		Assert::expect($reward->name) -> toEqual($params['reward']['name']);
		Assert::expect($reward->promotors_id) -> toEqual($params['promotors_id']);
		Assert::expect($reward->status) -> toEqual($params['reward']['status']);

		unset($_SESSION['user']);
		error_reporting(E_ALL);
	}

	public function testEditAction()
	{
		$this->seed();

		$params['promotors_id'] = 1;
		$params['id'] = 1;
		$params['controller'] = 'RewardsController';
		$params['action'] = 'new';

		$action = $params['action'];

		$controller = new $params['controller']($params);
		$view = $controller->$action();

		$html = HtmlDomParser::str_get_html($view);

		$elements = $html->find('input');	
		Assert::expect(count($elements)) -> toEqual(4);

		$elements = $html->find('select');	
		Assert::expect(count($elements)) -> toEqual(1);

		$elements = $html->find('textarea');	
		Assert::expect(count($elements)) -> toEqual(1);

		$elements = $html->find('div#reward_images_container');	
		Assert::expect(count($elements)) -> toEqual(1);

		unset($_SESSION['user']);
	}

	public function testUpdateAction()
	{
		$this->seed();

		error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);

		$params['promotors_id'] = 1;
		$params['id'] = 1;
		$params['controller'] = 'RewardsController';
		$params['action'] = 'update';
		$params['reward'] = ['name' => 'test2',
            				 'status' => 'inactive',
            				 'prize' => 16,
            				 'description' => 'desc2'];

		$action = $params['action'];

		$controller = new $params['controller']($params);
		$view = $controller->$action();
		
		$reward = Reward::find($params['id']);

		Assert::expect($reward->name) -> toEqual($params['reward']['name']);
		Assert::expect($reward->promotors_id) -> toEqual($params['promotors_id']);
		Assert::expect($reward->status) -> toEqual($params['reward']['status']);

		unset($_SESSION['user']);
		error_reporting(E_ALL);
	}

	public function testDeleteAction()
	{
		$this->seed();

		error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);

		$params['promotors_id'] = 1;
		$params['id'] = 1;
		$params['controller'] = 'RewardsController';
		$params['action'] = 'delete';

		$action = $params['action'];

		$controller = new $params['controller']($params);
		$view = $controller->$action();
		
		$reward = Reward::where('id=?', ['id'=>$params['id']]);

		Assert::expect(empty($reward)) -> toEqual(true);

		unset($_SESSION['user']);
		error_reporting(E_ALL);
	}
}