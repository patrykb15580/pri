<?php
use Sunra\PhpSimple\HtmlDomParser;
/**
* 
*/
class StaticPagesControllerTest extends Tests
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

		$action = new Action(['name'=>'Contest 1', 'description'=>'Description for contest 1', 'promotor_id'=>1, 'status'=>'active', 'type'=>'Contests']);
		$action->save();

		$contest = new Contest(['question'=>'Question?', 'from_at'=>date("Y-m-d", strtotime("-3 days")), 'to_at'=>date("Y-m-d", strtotime("+4 days")), 'action_id'=>'4']);
		$contest->save();

		$package = new CodesPackage(['action_id'=>4, 'quantity'=>4, 'codes_value'=>0, 'status'=>'active']);
		$package->save();

		$description = 'Wykorzystanie kodu zaqwsx w akcji action1';
		History::addHistoryRecord(1, 1, 100, 243, $description, 'add');

		$params['controller'] = 'PromotionCodesPackagesController';
		$params['action'] = 'generate';
		$curl = new TesterTestRequest((new PromotionCodesPackagesController($params))->generate(), 'http://'.Config::get('host').'/package/generate', null, []);
	}

	/*public function testStartPageAction()
	{
		$params['controller'] = 'StaticPagesController';
		$params['action'] = 'startPage';

		$action = $params['action'];

		$controller = new $params['controller']($params);
		$view = $controller->$action();

		$html = HtmlDomParser::str_get_html($view);

		$elements = $html->find('input');	

		Assert::expect(count($elements)) -> toEqual(2);

		unset($_SESSION['user']);
	}*/

	public function testLoginAction()
	{
		$params['controller'] = 'StaticPagesController';
		$params['action'] = 'login';

		$action = $params['action'];

		$controller = new $params['controller']($params);
		$view = $controller->$action();

		$html = HtmlDomParser::str_get_html($view);

		$elements = $html->find('#login_box');	
		Assert::expect(count($elements)) -> toEqual(1);

		$elements = $html->find('.login_left_block');	
		Assert::expect(count($elements)) -> toEqual(1);

		$elements = $html->find('.login_right_block');	
		Assert::expect(count($elements)) -> toEqual(1);

		$elements = $html->find('input');	
		Assert::expect(count($elements)) -> toEqual(5);

		unset($_SESSION['user']);
	}

	public function testPromotorLoginAction()
	{
		$params['controller'] = 'StaticPagesController';
		$params['action'] = 'promotorLogin';

		$action = $params['action'];

		$controller = new $params['controller']($params);
		$view = $controller->$action();

		$html = HtmlDomParser::str_get_html($view);

		$elements = $html->find('input');	
		Assert::expect(count($elements)) -> toEqual(3);

		unset($_SESSION['user']);
	}

 	/* insert code */

	public function testUseCodeAction()
	{
		$this->seed();
		
		$code = Code::where('package_id=?', ['package_id'=>1]);
		$code = $code[0];

		$params['controller'] = 'StaticPagesController';
		$params['action'] = 'useCode';
		$params['code'] = $code->code;

		$action = $params['action'];
		
		$controller = new $params['controller']($params);
		$view = $controller->$action();

		$html = HtmlDomParser::str_get_html($view);

		$elements = $html->find('#use_code_container');	
		Assert::expect(count($elements)) -> toEqual(1);

		$elements = $html->find('.use_code_top');	
		Assert::expect(count($elements)) -> toEqual(1);

		$elements = $html->find('.use-code-avatar');	
		Assert::expect(count($elements)) -> toEqual(1);

		$elements = $html->find('.promotor-name');	
		Assert::expect(count($elements)) -> toEqual(1);

		$elements = $html->find('.action-name');	
		Assert::expect(count($elements)) -> toEqual(1);

		$elements = $html->find('form#use_code');	
		Assert::expect(count($elements)) -> toEqual(1);

		$elements = $html->find('table');	
		Assert::expect(count($elements)) -> toEqual(1);

		$elements = $html->find('label');	
		Assert::expect(count($elements)) -> toEqual(3);

		$elements = $html->find('input');	
		Assert::expect(count($elements)) -> toEqual(4);

		unset($_SESSION['user']);
	}

	public function testAddPointsAction()
	{
		$this->seed();

		error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);

		$code = Code::where('package_id=?', ['package_id'=>1]);
		$code = $code[0];

		$params['code'] = $code->code;
		$params['controller'] = 'StaticPagesController';
		$params['action'] = 'addPoints';
		$params['client'] = ['email' => 'test@test.com',
            				 'name' => 'Client',
            				 'phone_number' => '123456789'];

		$action = $params['action'];

		$controller = new $params['controller']($params);
		$view = $controller->$action();

		$client = Client::findBy('email', $params['client']['email']);
		$promotor = $code->promotor();
		
		$points_balance = PointsBalance::where('promotor_id=? AND client_id=?', ['promotor_id'=>$promotor->id, 'client_id'=>$client->id]);

		Assert::expect(empty($points_balance)) -> toEqual(false);

		unset($_SESSION['user']);
		error_reporting(E_ALL);
	}

	public function testContestAction()
	{
		$this->seed();

		$codes = Code::where('package_id=?', ['package_id'=>3]);
		$code = $codes[0];

		$params['controller'] = 'StaticPagesController';
		$params['action'] = 'contest';
		$params['id'] = 4;
		$params['code'] = $code->code;

		$action = $params['action'];
		
		$controller = new $params['controller']($params);
		$view = $controller->$action();

		$html = HtmlDomParser::str_get_html($view);

		$elements = $html->find('.answer-box');	
		Assert::expect(count($elements)) -> toEqual(1);

		$elements = $html->find('.answer-form-top');	
		Assert::expect(count($elements)) -> toEqual(1);

		$elements = $html->find('.answer-form-avatar');	
		Assert::expect(count($elements)) -> toEqual(1);

		$elements = $html->find('.answer-form-title');	
		Assert::expect(count($elements)) -> toEqual(1);

		$elements = $html->find('.answer-form');	
		Assert::expect(count($elements)) -> toEqual(1);

		$elements = $html->find('textarea');	
		Assert::expect(count($elements)) -> toEqual(1);

		$elements = $html->find('input');	
		Assert::expect(count($elements)) -> toEqual(4);

		unset($_SESSION['user']);
	}

	/*public function testContestAnswerAction()
	{
		$this->seed();

		error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);

		$codes = Code::where('package_id=?', ['package_id'=>3]);
		$code = $codes[1];

      	$params['id'] = 4;
    	$params['controller'] = 'StaticPagesController';
    	$params['action'] = 'contestAnswer';
    	$params['answer'] = ['answer' => 'answer'];
    	$params['code'] = $code->code;

    	$params['client'] = ['email'=>'test1@test.com',
          					 'name' => 'Client',
            				 'phone_number' => '123456789'];

		$action = $params['action'];

		$controller = new $params['controller']($params);
		$view = $controller->$action();

		$contest = Action::find($params['id']);
		$client = Client::findBy('email', $params['client']['email']);
		
		$answer = ContestAnswer::where('action_id=? AND client_id=?', ['action_id'=>$contest->id, 'client_id'=>$client->id]);

		Assert::expect(empty($answer)) -> toEqual(false);

		unset($_SESSION['user']);
		error_reporting(E_ALL);
	}*/
}