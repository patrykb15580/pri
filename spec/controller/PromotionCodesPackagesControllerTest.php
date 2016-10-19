<?php
/**
* 
*/
class PromotionCodesPackagesControllerTest extends Tests
{
	
	public function testGenerate10PromotionCodes()
	{
		$_SESSION['user'] = new Admin;
		$params['action'] = 'generate';
		$package = new PromotionCodesPackage(['name'=>'name', 'action_id'=>'1', 'reusable'=>0, 'quantity'=>10, 'codes_value'=>50, 'status'=>'active']);
		$package->save();
		$curl = new TesterTestRequest((new PromotionCodesPackagesController($params))->generate(), 'http://'.Config::get('host').'/package/generate', null, []);
		$codes = PromotionCode::where('package_id=?', ['package_id'=>$package->id]);

		Assert::expect(count($codes)) -> toEqual(10);
	}

	public function testGenerate5MorePromotionCodes()
	{
		$_SESSION['user'] = new Admin;
		$params['action'] = 'generate';
		$package = new PromotionCodesPackage(['name'=>'name', 'action_id'=>'1', 'reusable'=>0, 'quantity'=>10, 'generated'=>5, 'codes_value'=>50, 'status'=>'active']);
		$package->save();
		$curl = new TesterTestRequest((new PromotionCodesPackagesController($params))->generate(), 'http://'.Config::get('host').'/package/generate', null, []);
		$codes = PromotionCode::where('package_id=?', ['package_id'=>$package->id]);

		Assert::expect(count($codes)) -> toEqual(5);
	}

	public function testPromotionCodeHave6Chars()
	{
		$_SESSION['user'] = new Admin;
		$params['action'] = 'generate';
		$package = new PromotionCodesPackage(['name'=>'name', 'action_id'=>'1', 'reusable'=>0, 'quantity'=>10, 'generated'=>5, 'codes_value'=>50, 'status'=>'active']);
		$package->save();
		$curl = new TesterTestRequest((new PromotionCodesPackagesController($params))->generate(), 'http://'.Config::get('host').'/package/generate', null, []);
		$codes = PromotionCode::where('package_id=?', ['package_id'=>$package->id]);

		$code = $codes[0];
		Assert::expect(strlen($code->code)) -> toEqual(6);
	}
}