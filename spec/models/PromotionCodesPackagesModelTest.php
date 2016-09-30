<?php
/**
* 
*/
class PromotionCodesPackagesModelTest extends Tests
{
	
	public function test_promotion_codes_packages_is_valid()
	{
		$promotion_code_package = new PromotionCodesPackage(['name'=>'name', 'action_id'=>'1', 'reusable'=>0, 'quantity'=>100, 'codes_value'=>50, 'status'=>'active']);
		Assert::expect($promotion_code_package -> isValid()) -> to_equal(true);
	}

	public function test_name_should_be_require()
	{
		$promotion_code_package = new PromotionCodesPackage(['action_id'=>'1', 'reusable'=>0, 'quantity'=>100, 'codes_value'=>50, 'status'=>'active']);
		Assert::expect($promotion_code_package -> isValid()) -> to_equal(false);
	}

	public function test_name_should_have_less_than_191_chars()
	{
		$random_string = StringUntils::get_random_string(190);
		$promotion_code_package = new PromotionCodesPackage(['name'=>$random_string, 'action_id'=>'1', 'reusable'=>0, 'quantity'=>100, 'codes_value'=>50, 'status'=>'active']);
		Assert::expect($promotion_code_package -> isValid()) -> to_equal(true);

		$random_string = StringUntils::get_random_string(191);
		$promotion_code_package = new PromotionCodesPackage(['name'=>$random_string, 'action_id'=>'1', 'reusable'=>0, 'quantity'=>100, 'codes_value'=>50, 'status'=>'active']);
		Assert::expect($promotion_code_package -> isValid()) -> to_equal(false);
	}

	public function test_action_id_should_be_require()
	{
		$promotion_code_package = new PromotionCodesPackage(['name'=>'name', 'reusable'=>0, 'quantity'=>100, 'codes_value'=>50, 'status'=>'active']);
		Assert::expect($promotion_code_package -> isValid()) -> to_equal(false);
	}
	
	public function test_quantity_should_be_require()
	{
		$promotion_code_package = new PromotionCodesPackage(['name'=>'name', 'action_id'=>'1', 'reusable'=>0, 'codes_value'=>50, 'status'=>'active']);
		Assert::expect($promotion_code_package -> isValid()) -> to_equal(false);
	}

	public function test_quantity_should_have_less_than_12_chars()
	{
		$random_number = StringUntils::get_random_number(11);
		$promotion_code_package = new PromotionCodesPackage(['name'=>'name', 'action_id'=>'1', 'reusable'=>0, 'quantity'=>$random_number, 'codes_value'=>50, 'status'=>'active']);
		Assert::expect($promotion_code_package -> isValid()) -> to_equal(true);

		$random_number = StringUntils::get_random_number(12);
		$promotion_code_package = new PromotionCodesPackage(['name'=>'name', 'action_id'=>'1', 'reusable'=>0, 'quantity'=>$random_number, 'codes_value'=>50, 'status'=>'active']);
		Assert::expect($promotion_code_package -> isValid()) -> to_equal(false);
	}

	public function test_codes_value_should_be_require()
	{
		$promotion_code_package = new PromotionCodesPackage(['name'=>'name', 'action_id'=>'1', 'reusable'=>0, 'quantity'=>100, 'status'=>'active']);
		Assert::expect($promotion_code_package -> isValid()) -> to_equal(false);
	}
	
	public function test_codes_value_should_have_less_than_12_chars()
	{
		$random_number = StringUntils::get_random_number(11);
		$promotion_code_package = new PromotionCodesPackage(['name'=>'name', 'action_id'=>'1', 'reusable'=>0, 'quantity'=>100, 'codes_value'=>$random_number, 'status'=>'active']);
		Assert::expect($promotion_code_package -> isValid()) -> to_equal(true);

		$random_number = StringUntils::get_random_number(12);
		$promotion_code_package = new PromotionCodesPackage(['name'=>'name', 'action_id'=>'1', 'reusable'=>0, 'quantity'=>100, 'codes_value'=>$random_number, 'status'=>'active']);
		Assert::expect($promotion_code_package -> isValid()) -> to_equal(false);
	}
}