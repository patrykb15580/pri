<?php
/**
* 
*/
class PromotionCodesPackagesControllerTest extends Tests
{
	
	public function test_generate_10_promotion_codes()
	{
		$package1 = new PromotionCodesPackage(['name'=>'name', 'action_id'=>'1', 'reusable'=>0, 'quantity'=>10, 'codes_value'=>50, 'status'=>'active']);
		$package1->save();
		$curl = new TesterTestRequest((new PromotionCodesPackagesController)->generate(), 'http://'.Config::get('host').'/package/generate', null, []);
		$codes = PromotionCode::where('package_id=?', ['package_id'=>$package1->id]);

	Assert::expect(count($codes)) -> to_equal(10);
	}

	public function test_generate_5_more_promotion_codes()
	{
		$package2 = new PromotionCodesPackage(['name'=>'name', 'action_id'=>'1', 'reusable'=>0, 'quantity'=>10, 'generated'=>5, 'codes_value'=>50, 'status'=>'active']);
		$package2->save();
		$curl = new TesterTestRequest((new PromotionCodesPackagesController)->generate(), 'http://'.Config::get('host').'/package/generate', null, []);
		$codes = PromotionCode::where('package_id=?', ['package_id'=>$package2->id]);

		Assert::expect(count($codes)) -> to_equal(5);
	}
}