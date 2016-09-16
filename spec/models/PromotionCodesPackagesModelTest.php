<?php
/**
* 
*/
class PromotionCodesPackagesModelTest extends Tests
{
	
	public function test_promotion_codes_packages_is_valid()
	{
		$promotion_code_package = new PromotionCodesPackage(['name'=>'name', 'action_id'=>'1', 'reusable'=>0, 'quantity'=>100, 'status'=>'active']);
		Assert::expect($promotion_code_package -> isValid()) -> to_equal(true);
	}

	public function test_promotion_codes_packages_name_is_not_valid()
	{
		$promotion_code_package = new PromotionCodesPackage(['action_id'=>'1', 'reusable'=>0, 'quantity'=>100, 'status'=>'active']);
		Assert::expect($promotion_code_package -> isValid()) -> to_equal(false);
	}
	
	public function test_promotion_codes_packages_action_id_is_not_valid()
	{
		$promotion_code_package = new PromotionCodesPackage(['name'=>'name', 'reusable'=>0, 'quantity'=>100, 'status'=>'active']);
		Assert::expect($promotion_code_package -> isValid()) -> to_equal(false);
	}
}