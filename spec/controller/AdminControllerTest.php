<?php
use Sunra\PhpSimple\HtmlDomParser;
/**
* 
*/
class AdminControllerTest extends Tests
{
	function seed(){
		MyDB::clearDatabaseExceptSchema();

		$promotor = new Promotor(['email'=>'test1@test.com', 'password_degest'=>Password::encryptPassword('password1'), 'name'=>'promotor1']);
		$promotor->save();

		$_SESSION['user'] = new Admin;

		$promotor = new Promotor(['email'=>'test2@test.com', 'password_degest'=>Password::encryptPassword('password2'), 'name'=>'promotor2']);
		$promotor->save();

		$action = new Action(['name'=>'Action 1', 'description'=>'Description for action 1', 'promotor_id'=>1, 'status'=>'active', 'type'=>'PromotionActions']);
		$action->save();

		$promotion_action = new PromotionAction(['action_id'=>'1', 'indefinitely'=>1]);
		$promotion_action->save();


		$action = new Action(['name'=>'Action 2', 'description'=>'Description for action 2', 'promotor_id'=>2, 'status'=>'active', 'type'=>'PromotionActions']);
		$action->save();

		$promotion_action = new PromotionAction(['action_id'=>'2', 'indefinitely'=>0, 'from_at'=>date("Y-m-d", strtotime("-1 week")), 'to_at'=>date("Y-m-d", strtotime("+1 week"))]);
		$promotion_action->save();


		$action = new Action(['name'=>'Action 3', 'description'=>'Description for action 3', 'promotor_id'=>1, 'status'=>'inactive', 'type'=>'PromotionActions']);
		$action->save();

		$promotion_action = new PromotionAction(['action_id'=>'3', 'indefinitely'=>0, 'from_at'=>date("Y-m-d", strtotime("+1 day")), 'to_at'=>date("Y-m-d", strtotime("+1 week"))]);
		$promotion_action->save();


		$package = new CodesPackage(['action_id'=>'1', 'quantity'=>4, 'codes_value'=>143, 'status'=>'active']);
		$package->save();

		$admin_order = new AdminOrder(['promotor_id'=>1, 'package_id'=>1, 'quantity'=>4, 'package_type'=>'contest', 'order_date'=>$package->created_at]);
		$admin_order->save();

		$package = new CodesPackage(['action_id'=>'1', 'quantity'=>4, 'codes_value'=>1324, 'status'=>'active']);
		$package->save();

		$admin_order = new AdminOrder(['promotor_id'=>1, 'package_id'=>2, 'quantity'=>4, 'package_type'=>'action', 'order_date'=>$package->created_at]);
		$admin_order->save();

		$client = new Client(['email'=>'test1@test.com', 'name'=>'client1', 'phone_number'=>'123456789', 'password_digest'=>Password::encryptPassword(''), 'hash'=>HashGenerator::generate()]);
		$client->save();

		$points_balance = new PointsBalance(['client_id'=>1, 'promotor_id'=>1, 'balance'=>100]);
		$points_balance->save();

		$reward = new Reward(['name' => 'Reward1', 'status' => 'active', 'prize' => 10, 'description' => 'Desc', 'promotors_id' => 1]);
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

		$params['controller'] = 'AdminController';
		$params['action'] = 'show';

		$action = $params['action'];

		$controller = new $params['controller']($params);
		$view = $controller->$action();

		$html = HtmlDomParser::str_get_html($view);

		$elements = $html->find('div#title-box');	
		Assert::expect(count($elements)) -> toEqual(1);

		$elements = $html->find('div#title-box-options-bar');	
		Assert::expect(count($elements)) -> toEqual(1);

		$elements = $html->find('tr.result');	
		Assert::expect(count($elements)) -> toEqual(2);

		unset($_SESSION['user']);
	}

	public function testShowPromotorAction()
	{
		$this->seed();

		$params['promotor_id'] = 1;
		$params['controller'] = 'AdminController';
		$params['action'] = 'showPromotor';

		$action = $params['action'];

		$controller = new $params['controller']($params);
		$view = $controller->$action();

		$html = HtmlDomParser::str_get_html($view);

		$elements = $html->find('div#title-box');	
		Assert::expect(count($elements)) -> toEqual(1);

		$elements = $html->find('div#title-box-options-bar');	
		Assert::expect(count($elements)) -> toEqual(1);

		$elements = $html->find('#select-tab');	
		Assert::expect(count($elements)) -> toEqual(1);

		$elements = $html->find('.tab-content');	
		Assert::expect(count($elements)) -> toEqual(6);

		unset($_SESSION['user']);
	}

	public function testShowPromotorActionAction()
	{
		$this->seed();

		$params['promotor_id'] = 1;
		$params['action_id'] = 1;
		$params['controller'] = 'AdminController';
		$params['action'] = 'showPromotor';

		$action = $params['action'];

		$controller = new $params['controller']($params);
		$view = $controller->$action();

		$html = HtmlDomParser::str_get_html($view);

		$elements = $html->find('div#title-box');	
		Assert::expect(count($elements)) -> toEqual(1);

		$elements = $html->find('div#title-box-options-bar');	
		Assert::expect(count($elements)) -> toEqual(1);

		$elements = $html->find('#select-tab');	
		Assert::expect(count($elements)) -> toEqual(1);

		$elements = $html->find('#tab-1-content');	
		Assert::expect(count($elements)) -> toEqual(1);

		$elements = $html->find('#tab-2-content');	
		Assert::expect(count($elements)) -> toEqual(1);

		$elements = $html->find('#tab-3-content');	
		Assert::expect(count($elements)) -> toEqual(1);

		$elements = $html->find('tr.result');	
		Assert::expect(count($elements)) -> toEqual(6);

		unset($_SESSION['user']);
	}

	public function testShowPromotorPackageAction()
	{
		$this->seed();

		$params['promotor_id'] = 1;
    	$params['action_id'] = 1;
    	$params['package_id'] = 1;
    	$params['controller'] = 'AdminController';
    	$params['action'] = 'showPromotorPackage';

    	$curl = new TesterTestRequest((new PromotionCodesPackagesController($params))->generate(), 'http://'.Config::get('host').'/package/generate', null, []);

		$action = $params['action'];

		$controller = new $params['controller']($params);
		$view = $controller->$action();

		$html = HtmlDomParser::str_get_html($view);

		$elements = $html->find('div#title-box');	
		Assert::expect(count($elements)) -> toEqual(1);

		$elements = $html->find('#select-tab');	
		Assert::expect(count($elements)) -> toEqual(1);

		$elements = $html->find('#tab-1-content');	
		Assert::expect(count($elements)) -> toEqual(1);

		$elements = $html->find('#tab-2-content');	
		Assert::expect(count($elements)) -> toEqual(1);

		$elements = $html->find('#tab-3-content');	
		Assert::expect(count($elements)) -> toEqual(1);

		$elements = $html->find('tr.result');	
		Assert::expect(count($elements)) -> toEqual(8);

		unset($_SESSION['user']);
	}

	public function testShowPromotorRewardAction()
	{
		$this->seed();

		$params['promotor_id'] = 1;
    	$params['reward_id'] = 1;
    	$params['controller'] = 'AdminController';
    	$params['action'] = 'showPromotorReward';

		$action = $params['action'];

		$controller = new $params['controller']($params);
		$view = $controller->$action();

		$html = HtmlDomParser::str_get_html($view);

		$elements = $html->find('div#title-box');	
		Assert::expect(count($elements)) -> toEqual(1);

		$elements = $html->find('.modal-bg');	
		Assert::expect(count($elements)) -> toEqual(1);

		$elements = $html->find('div#reward_images_container');	
		Assert::expect(count($elements)) -> toEqual(1);

		unset($_SESSION['user']);
	}

	public function testShowPromotorOrderAction()
	{
		$this->seed();

		$params['promotor_id'] = 1;
    	$params['order_id'] = 1;
    	$params['controller'] = 'AdminController';
    	$params['action'] = 'showPromotorOrder';

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

	public function testNewPromotorAction()
	{
		$this->seed();

    	$params['controller'] = 'AdminController';
    	$params['action'] = 'newPromotor';

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
		Assert::expect(count($elements)) -> toEqual(5);

		unset($_SESSION['user']);
	}

	public function testCreatePromotorAction()
	{
		$this->seed();

		error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);

		$params['controller'] = 'AdminController';
    	$params['action'] = 'createPromotor';
    	$params['promotor'] = ['name' => 'Promotor',
				    	       'email' => 'test@prom.com',
				    	       'password_degest' => 'pass'];

    	$params['confirm_password'] = 'pass';

		$action = $params['action'];

		$controller = new $params['controller']($params);
		$view = $controller->$action();
		
		$promotor = Promotor::findBy('email', $params['promotor']['email']);
		
		Assert::expect($promotor->name) -> toEqual($params['promotor']['name']);
		Assert::expect($promotor->email) -> toEqual($params['promotor']['email']);
		Assert::expect($promotor->password_degest) -> toEqual(Password::encryptPassword($params['promotor']['password_degest']));

		unset($_SESSION['user']);
		error_reporting(E_ALL);
	}

	public function testEditPromotorAction()
	{
		$this->seed();

		$params['promotors_id'] = 1;
    	$params['controller'] = 'AdminController';
    	$params['action'] = 'editPromotor';

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
		Assert::expect(count($elements)) -> toEqual(5);

		unset($_SESSION['user']);
	}

	public function testUpdatePromotorAction()
	{
		$this->seed();

		error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);

		$params['promotors_id'] = 1;
		$params['controller'] = 'AdminController';
    	$params['action'] = 'updatePromotor';
    	$params['promotor'] = ['name' => 'NewPromotor',
				    	        'email' => 'test@prom.com',
				    	        'password' => 'pass'];

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

	public function testIndexOrdersAction()
	{
		$this->seed();

		$params['controller'] = 'AdminController';
		$params['action'] = 'indexOrders';

		$action = $params['action'];

		$controller = new $params['controller']($params);
		$view = $controller->$action();

		$html = HtmlDomParser::str_get_html($view);

		$elements = $html->find('div#title-box');	
		Assert::expect(count($elements)) -> toEqual(1);

		$elements = $html->find('#select-tab');	
		Assert::expect(count($elements)) -> toEqual(1);

		$elements = $html->find('.tab-content');	
		Assert::expect(count($elements)) -> toEqual(6);

		$elements = $html->find('tr.result');	
		Assert::expect(count($elements)) -> toEqual(4);

		unset($_SESSION['user']);
	}

	public function testShowOrderAction()
	{
		$this->seed();

		$params['order_id'] = 1;
	    $params['controller'] = 'AdminController';
	    $params['action'] = 'showOrder';

		$action = $params['action'];

		$controller = new $params['controller']($params);
		$view = $controller->$action();

		$html = HtmlDomParser::str_get_html($view);

		$elements = $html->find('div#title-box');	
		Assert::expect(count($elements)) -> toEqual(1);

		$elements = $html->find('.single-table');	
		Assert::expect(count($elements)) -> toEqual(1);

		$elements = $html->find('tr.result');	
		Assert::expect(count($elements)) -> toEqual(5);

		unset($_SESSION['user']);
	}
}