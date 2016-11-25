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

		$contest = new Contest(['name'=>'contest1', 'question'=>'Is this question?', 'from_at'=>date("Y-m-d", strtotime("-3 days")), 'to_at'=>date("Y-m-d", strtotime("+4 days")), 'promotor_id'=>'1', 'status'=>'active', 'type'=>0]);
		$contest->save();

		$description = 'Wykorzystanie kodu zaqwsx w akcji action1';
		History::addHistoryRecord(1, 100, 243, $description, 'add');

		$params['controller'] = 'PromotionCodesPackagesController';
		$params['action'] = 'generate';
		$curl = new TesterTestRequest((new PromotionCodesPackagesController($params))->generate(), 'http://'.Config::get('host').'/package/generate', null, []);
	}

	public function testStartPageAction()
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
	}

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
		Assert::expect(count($elements)) -> toEqual(2);

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
		
		$code = PromotionCode::all([]);
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

		$code = PromotionCode::all([]);
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

		$params['controller'] = 'StaticPagesController';
		$params['action'] = 'contest';
		$params['id'] = 1;

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

      	$params['id'] = 1;
    	$params['controller'] = 'StaticPagesController';
    	$params['action'] = 'contestAnswer';
    	$params['answer'] = ['answer' => 'answer'];

    	$params['client'] = ['email'=>'test1@test.com',
          					  'name' => 'Client',
            				  'phone_number' => '123456789'];

		$action = $params['action'];

		$controller = new $params['controller']($params);
		$view = $controller->$action();

		$contest = Contest::find($params['id']);
		$client = Client::findBy('email', $params['client']['email']);
		
		$answer = ContestAnswer::where('contest_id=? AND client_id=?', ['contest_id'=>$contest->id, 'client_id'=>$client->id]);

		Assert::expect(empty($answer)) -> toEqual(false);

		unset($_SESSION['user']);
		error_reporting(E_ALL);
	}*/
}