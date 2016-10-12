<?php
use Sunra\PhpSimple\HtmlDomParser;
/**
* 
*/
class PromotorsControllerTest extends Tests
{

	public function testShowAction()
	{
		$promotor = new Promotor(['email'=>'test1@test.com', 'password_degest'=>Password::encryptPassword('password1'), 'name'=>'promotor1']);
		$promotor->save();

		$_SESSION['user'] = $promotor;

		$promotor2 = new Promotor(['email'=>'test2@test.com', 'password_degest'=>Password::encryptPassword('password2'), 'name'=>'promotor2']);
		$promotor2->save();

		$params['promotors_id'] = $promotor->id;
		$params['controller'] = 'PromotorsController';
		$params['action'] = 'show';

		#die(print_r($params));

		$controller = new $params['controller']($params);
		$view = $controller->show();
		
		#$view = htmlspecialchars($view);
		#$view = str_replace('<', '&lt', $view);
		#$view = str_replace('>', '&gt', $view);

		$html = HtmlDomParser::str_get_html($view);

		$ret = $html->find('div');

		die(print_r($html));
		


		#Assert::expect(count($codes)) -> toEqual(10);
	}
}