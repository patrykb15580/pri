<?php
use Sunra\PhpSimple\HtmlDomParser;
/**
* 
*/
class PromotorsControllerTest extends Tests
{
	function seed(){
		MyDB::clearDatabaseExceptSchema();

		$promotor = new Promotor(['email'=>'test1@test.com', 'password_degest'=>Password::encryptPassword('password1'), 'name'=>'promotor1']);
		$promotor->save();

		$_SESSION['user'] = $promotor;

		$promotor2 = new Promotor(['email'=>'test2@test.com', 'password_degest'=>Password::encryptPassword('password2'), 'name'=>'promotor2']);
		$promotor2->save();

		$promotion_action1 = new PromotionAction(['name'=>'action1', 'promotors_id'=>1, 'status'=>'active', 'indefinitely'=>1]);
		$promotion_action1->save();

		$promotion_action2 = new PromotionAction(['name'=>'action2', 'promotors_id'=>1, 'status'=>'active', 'indefinitely'=>1]);
		$promotion_action2->save();

		$promotion_action3 = new PromotionAction(['name'=>'action3', 'promotors_id'=>2, 'status'=>'active', 'indefinitely'=>1]);
		$promotion_action3->save();

		$client = new Client(['email'=>'test1@test.com', 'name'=>'client1', 'phone_number'=>'123456789', 'hash'=>HashGenerator::generate()]);
		$client->save();

		$points_balance = new PointsBalance(['client_id'=>$client->id, 'promotor_id'=>$promotor->id, 'balance'=>100]);
		$points_balance->save();

		$reward = new Reward(['name' => 'Reward1', 'status' => 'active', 'prize' => 10, 'description' => 'Desc', 'promotors_id' => $promotor->id]);
		$reward->save();

		$order = new Order(['promotor_id'=>$promotor->id, 'client_id'=>1, 'reward_id'=>1, 'order_date'=>date(Config::get('mysqltime'))]);
		$order->save();

		$order = new Order(['promotor_id'=>$promotor->id, 'client_id'=>2, 'reward_id'=>1, 'order_date'=>date(Config::get('mysqltime'))]);
		$order->save();

		$order = new Order(['promotor_id'=>2, 'client_id'=>1, 'reward_id'=>1, 'order_date'=>date(Config::get('mysqltime'))]);
		$order->save();
	}

	public function testShowAction()
	{
		$this->seed();

		$params['promotors_id'] = 1;
		$params['controller'] = 'PromotorsController';
		$params['action'] = 'show';

		$action = $params['action'];

		$controller = new $params['controller']($params);
		$view = $controller->$action($params);

		$html = HtmlDomParser::str_get_html($view);

		$elements = $html->find('tr');	

		Assert::expect(count($elements)) -> toEqual(4);

		unset($_SESSION['user']);
	}

	public function testEditAction()
	{
		$this->seed();

		$params['promotors_id'] = 1;
		$params['controller'] = 'PromotorsController';
		$params['action'] = 'edit';

		$action = $params['action'];

		$controller = new $params['controller']($params);
		$view = $controller->$action($params);

		die(print_r($view));

		$html = HtmlDomParser::str_get_html($view);

		$elements = $html->find('input');	

		Assert::expect(count($elements)) -> toEqual(5);

		unset($_SESSION['user']);
	}

	public function testIndexClientsAction()
	{
		$this->seed();

		$params['promotors_id'] = 1;
		$params['controller'] = 'PromotorsController';
		$params['action'] = 'indexClients';

		$action = $params['action'];

		$controller = new $params['controller']($params);
		$view = $controller->$action($params);

		$html = HtmlDomParser::str_get_html($view);

		$elements = $html->find('tr');	

		Assert::expect(count($elements)) -> toEqual(2);

		unset($_SESSION['user']);
	}

	public function testIndexOrdersAction()
	{
		$this->seed();

		$params['promotors_id'] = $promotor->id;
	    $params['controller'] = 'PromotorsController';
	    $params['action'] = 'indexOrders';

		$action = $params['action'];

		$controller = new $params['controller']($params);
		$view = $controller->$action($params);

		$html = HtmlDomParser::str_get_html($view);

		$elements = $html->find('tr');	

		Assert::expect(count($elements)) -> toEqual(5);

		unset($_SESSION['user']);
	}
}