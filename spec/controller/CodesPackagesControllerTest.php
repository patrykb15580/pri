<?php
use Sunra\PhpSimple\HtmlDomParser;
/**
* 
*/
class CodesPackagesControllerTest extends Tests
{
	function seed(){
		MyDB::clearDatabaseExceptSchema();

		$promotor = new Promotor(['email'=>'test1@test.com', 'password_degest'=>Password::encryptPassword('password1'), 'name'=>'promotor1']);
		$promotor->save();

		$_SESSION['user'] = $promotor;

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

		$package = new CodesPackage(['action_id'=>1, 'quantity'=>4, 'codes_value'=>143, 'status'=>'active']);
		$package->save();

		$package = new CodesPackage(['action_id'=>1, 'quantity'=>4, 'codes_value'=>1324, 'status'=>'active']);
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

	public function testShowAction()
	{
		$this->seed();

		$params['promotors_id'] = 1;
		$params['action_id'] = 1;
		$params['id'] = 1;
		$params['controller'] = 'PromotionCodesPackagesController';
		$params['action'] = 'show';

		$curl = new TesterTestRequest((new PromotionCodesPackagesController($params))->generate(), 'http://'.Config::get('host').'/package/generate', null, []);

		$action = $params['action'];

		$controller = new $params['controller']($params);
		$view = $controller->$action();

		$html = HtmlDomParser::str_get_html($view);

		$elements = $html->find('div#title-box');	
		Assert::expect(count($elements)) -> toEqual(1);

		$elements = $html->find('div#title-box-options-bar');	
		Assert::expect(count($elements)) -> toEqual(1);

		$elements = $html->find('div#tab-1-content');	
		Assert::expect(count($elements)) -> toEqual(1);

		$elements = $html->find('div#tab-2-content');	
		Assert::expect(count($elements)) -> toEqual(1);

		$elements = $html->find('div#tab-3-content');	
		Assert::expect(count($elements)) -> toEqual(1);

		$elements = $html->find('tr.result');	
		Assert::expect(count($elements)) -> toEqual(8);

		unset($_SESSION['user']);
	}

	public function testNewAction()
	{
		$this->seed();

		$params['promotors_id'] = 1;
		$params['action_id'] = 1;
		$params['controller'] = 'PromotionCodesPackagesController';
		$params['action'] = 'new';

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
		Assert::expect(count($elements)) -> toEqual(3);

		$elements = $html->find('select');	
		Assert::expect(count($elements)) -> toEqual(1);

		unset($_SESSION['user']);
	}

	public function testCreateAction()
	{
		$this->seed();

		error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);

		$params['promotors_id'] = 1;
		$params['action_id'] = 6;
		$params['controller'] = 'PromotionCodesPackagesController';
		$params['action'] = 'create';
		$params['promotion_codes_package'] = ['quantity' => 10,
            								  'codes_value' => 1241,
            								  'status' => 'active',
            								  'action_id' => 6];

		$action = $params['action'];

		$controller = new $params['controller']($params);
		$view = $controller->$action();
		
		$package = CodesPackage::findBy('action_id', $params['action_id']);

		Assert::expect($package->action_id) -> toEqual($params['action_id']);
		Assert::expect($package->status) -> toEqual($params['promotion_codes_package']['status']);

		unset($_SESSION['user']);
		error_reporting(E_ALL);
	}

	public function testEditAction()
	{
		$this->seed();

		$params['promotors_id'] = 1;
		$params['action_id'] = 1;
		$params['id'] = 1;
		$params['controller'] = 'PromotionCodesPackagesController';
		$params['action'] = 'new';

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
		Assert::expect(count($elements)) -> toEqual(3);

		$elements = $html->find('select');	
		Assert::expect(count($elements)) -> toEqual(1);

		unset($_SESSION['user']);
	}

	public function testUpdateAction()
	{
		$this->seed();

		error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);

		$params['promotors_id'] = 1;
		$params['action_id'] = 1;
		$params['id'] = 1;
		$params['controller'] = 'PromotionCodesPackagesController';
		$params['action'] = 'update';
		$params['promotion_codes_package'] = ['status' => 'inactive'];

		$action = $params['action'];

		$controller = new $params['controller']($params);
		$view = $controller->$action();
		
		$package = CodesPackage::find($params['id']);

		Assert::expect($package->status) -> toEqual($params['promotion_codes_package']['status']);

		unset($_SESSION['user']);
		error_reporting(E_ALL);
	}

	public function testGenerate10PromotionCodes()
	{
		$params['action'] = 'generate';
		$package = new CodesPackage(['action_id'=>'1', 'quantity'=>10, 'codes_value'=>50, 'status'=>'active']);
		$package->save();
		$curl = new TesterTestRequest((new PromotionCodesPackagesController($params))->generate(), 'http://'.Config::get('host').'/package/generate', null, []);
		$codes = Code::where('package_id=?', ['package_id'=>$package->id]);

		Assert::expect(count($codes)) -> toEqual(10);
	}

	public function testGenerate5MorePromotionCodes()
	{
		$params['action'] = 'generate';
		$package = new CodesPackage(['action_id'=>'1', 'quantity'=>10, 'generated'=>5, 'codes_value'=>50, 'status'=>'active']);
		$package->save();
		$curl = new TesterTestRequest((new PromotionCodesPackagesController($params))->generate(), 'http://'.Config::get('host').'/package/generate', null, []);
		$codes = Code::where('package_id=?', ['package_id'=>$package->id]);

		Assert::expect(count($codes)) -> toEqual(5);
	}

	public function testPromotionCodeHave6Chars()
	{
		$params['action'] = 'generate';
		$package = new CodesPackage(['action_id'=>'1', 'quantity'=>10, 'generated'=>5, 'codes_value'=>50, 'status'=>'active']);
		$package->save();
		$curl = new TesterTestRequest((new PromotionCodesPackagesController($params))->generate(), 'http://'.Config::get('host').'/package/generate', null, []);
		$codes = Code::where('package_id=?', ['package_id'=>$package->id]);

		$code = $codes[0];
		Assert::expect(strlen($code->code)) -> toEqual(6);
	}

	/*public function testPromotionCodeHave5Chars()
	{
		$params['action'] = 'generate';
		$package = new PromotionCodesPackage(['name'=>'name', 'action_id'=>'1', 'reusable'=>0, 'quantity'=>10, 'generated'=>5, 'codes_value'=>50, 'status'=>'active']);
		$package->save();
		$curl = new TesterTestRequest((new PromotionCodesPackagesController($params))->generate(5), 'http://'.Config::get('host').'/package/generate', null, []);
		$codes = PromotionCode::where('package_id=?', ['package_id'=>$package->id]);

		$code = $codes[0];
		Assert::expect(strlen($code->code)) -> toEqual(5);
	}*/
}