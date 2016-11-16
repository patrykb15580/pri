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

		$client = new Client(['email'=>'test1@test.com', 'name'=>'client1', 'phone_number'=>'123456789', 'hash'=>HashGenerator::generate()]);
		$client->save();

		$points_balance = new PointsBalance(['client_id'=>1, 'promotor_id'=>1, 'balance'=>100]);
		$points_balance->save();

		$reward = new Reward(['name' => 'Reward1', 'status' => 'active', 'prize' => 10, 'description' => 'Desc', 'promotors_id' => $promotor->id]);
		$reward->save();

		$order = new Order(['promotor_id'=>1, 'client_id'=>1, 'reward_id'=>1, 'order_date'=>date(Config::get('mysqltime'))]);
		$order->save();

		$order = new Order(['promotor_id'=>1, 'client_id'=>2, 'reward_id'=>1, 'order_date'=>date(Config::get('mysqltime'))]);
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
		$view = $controller->$action();

		$html = HtmlDomParser::str_get_html($view);

		$elements = $html->find('div#title-box');	
		Assert::expect(count($elements)) -> toEqual(1);

		$elements = $html->find('div#title-box-tabs');	
		Assert::expect(count($elements)) -> toEqual(1);

		$elements = $html->find('div#active');	
		Assert::expect(count($elements)) -> toEqual(1);

		$elements = $html->find('div#inactive');	
		Assert::expect(count($elements)) -> toEqual(1);

		$elements = $html->find('tr.result');	
		Assert::expect(count($elements)) -> toEqual(2);

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
		$view = $controller->$action();

		$html = HtmlDomParser::str_get_html($view);

		$elements = $html->find('.form-page-container');	
		Assert::expect(count($elements)) -> toEqual(1);

		$elements = $html->find('.form-page-icon');	
		Assert::expect(count($elements)) -> toEqual(1);

		$elements = $html->find('.form-page-title');	
		Assert::expect(count($elements)) -> toEqual(1);

		$elements = $html->find('input');	
		Assert::expect(count($elements)) -> toEqual(6);

		$elements = $html->find('.avatar-big');	
		Assert::expect(count($elements)) -> toEqual(1);

		unset($_SESSION['user']);
	}

	public function testUpdateAction()
	{
		$this->seed();

		error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);

		$params['promotors_id'] = 1;
		$params['controller'] = 'PromotorsController';
		$params['action'] = 'update';
		$params['promotor'] = ['name'=>'promotor',
							   'email'=>'test@test.com',
							   'password'=>'pass1'];
		$params['old_password'] = 'password1';

		$action = $params['action'];

		$controller = new $params['controller']($params);
		$view = $controller->$action();
		
		$promotor = Promotor::find($params['promotors_id']);
		
		Assert::expect($promotor->name) -> toEqual($params['promotor']['name']);
		Assert::expect($promotor->email) -> toEqual($params['promotor']['email']);
		Assert::expect($promotor->password_degest) -> toEqual(Password::encryptPassword($params['promotor']['password']));

		unset($_SESSION['user']);
		error_reporting(E_ALL);
	}

	public function testIndexClientsAction()
	{
		$this->seed();

		$params['promotors_id'] = 1;
		$params['controller'] = 'PromotorsController';
		$params['action'] = 'indexClients';

		$action = $params['action'];

		$controller = new $params['controller']($params);
		$view = $controller->$action();

		$html = HtmlDomParser::str_get_html($view);

		$elements = $html->find('div#title-box');	
		Assert::expect(count($elements)) -> toEqual(1);

		$elements = $html->find('tr.result');	
		Assert::expect(count($elements)) -> toEqual(1);

		unset($_SESSION['user']);
	}

	public function testIndexOrdersAction()
	{
		$this->seed();

		$params['promotors_id'] = 1;
	    $params['controller'] = 'PromotorsController';
	    $params['action'] = 'indexOrders';

		$action = $params['action'];

		$controller = new $params['controller']($params);
		$view = $controller->$action();

		$html = HtmlDomParser::str_get_html($view);

		$elements = $html->find('div#title-box');	
		Assert::expect(count($elements)) -> toEqual(1);

		$elements = $html->find('tr.result');	
		Assert::expect(count($elements)) -> toEqual(2);

		unset($_SESSION['user']);
	}

	public function testShowOrdersAction()
	{
		$this->seed();

		error_reporting(E_ALL & ~E_NOTICE);

		$params['promotors_id'] = 1;
    	$params['order_id'] = 1;
    	$params['controller'] = 'PromotorsController';
    	$params['action'] = 'showOrders';

		$action = $params['action'];

		$controller = new $params['controller']($params);
		$view = $controller->$action();

		$html = HtmlDomParser::str_get_html($view);

		$elements = $html->find('tr.result');	
		Assert::expect(count($elements)) -> toEqual(2);

		$elements = $html->find('td.result');	
		Assert::expect(count($elements)) -> toEqual(6);

		unset($_SESSION['user']);
		error_reporting(E_ALL);
	}

	public function testStatsAction()
	{
		$this->seed();

		error_reporting(E_ALL & ~E_NOTICE);

		$params['promotors_id'] = 1;
    	$params['controller'] = 'PromotorsController';
    	$params['action'] = 'stats';

    	$curl = new TesterTestRequest((new PromotionCodesPackagesController($params))->generate(), 'http://'.Config::get('host').'/package/generate', null, []);

    	$codes = PromotionCode::where('package_id=?', ['package_id'=>1]);
		$code = $codes[0];
		$code->update(['used'=>date(Config::get("mysqltime"))]);
		$code->update(['client_id'=>1]);

		$action = $params['action'];

		$controller = new $params['controller']($params);
		$view = $controller->$action();

		$html = HtmlDomParser::str_get_html($view);

		$elements = $html->find('.clients-charts');	
		Assert::expect(count($elements)) -> toEqual(1);

		$elements = $html->find('.codes-charts');	
		Assert::expect(count($elements)) -> toEqual(1);

		$elements = $html->find('#stats_box');	
		Assert::expect(count($elements)) -> toEqual(2);


		$elements = $html->find('tr.result');	
		Assert::expect(count($elements)) -> toEqual(2);


		$elements = $html->find('div#clients_in_month_chart');	
		Assert::expect(count($elements)) -> toEqual(1);

		$elements = $html->find('div#clients_in_year_chart');	
		Assert::expect(count($elements)) -> toEqual(1);

		$elements = $html->find('div#clients_in_range_chart');	
		Assert::expect(count($elements)) -> toEqual(1);


		$elements = $html->find('li#clients_first_tab');	
		Assert::expect(count($elements)) -> toEqual(1);

		$elements = $html->find('li#clients_second_tab');	
		Assert::expect(count($elements)) -> toEqual(1);

		$elements = $html->find('li#clients_third_tab');	
		Assert::expect(count($elements)) -> toEqual(1);


		$elements = $html->find('li#codes_first_tab');	
		Assert::expect(count($elements)) -> toEqual(1);

		$elements = $html->find('li#codes_second_tab');	
		Assert::expect(count($elements)) -> toEqual(1);

		$elements = $html->find('li#codes_third_tab');	
		Assert::expect(count($elements)) -> toEqual(1);



		$elements = $html->find('div#codes_in_month_chart');	
		Assert::expect(count($elements)) -> toEqual(1);

		$elements = $html->find('div#codes_in_year_chart');	
		Assert::expect(count($elements)) -> toEqual(1);

		$elements = $html->find('div#codes_in_range_chart');	
		Assert::expect(count($elements)) -> toEqual(1);


		$elements = $html->find('.date');	
		Assert::expect(count($elements)) -> toEqual(4);


		unset($_SESSION['user']);
		error_reporting(E_ALL);
	}
}