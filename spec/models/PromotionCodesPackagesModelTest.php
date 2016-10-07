<?php
/**
* 
*/
class PromotionCodesPackagesModelTest extends Tests
{
	
	public function testPromotionCodesPackagesIsValid()
	{
		$promotion_code_package = new PromotionCodesPackage(['name'=>'name', 'action_id'=>'1', 'reusable'=>0, 'quantity'=>100, 'codes_value'=>50, 'status'=>'active']);
		Assert::expect($promotion_code_package -> isValid()) -> toEqual(true);
	}

	public function testNameShouldBeRequire()
	{
		$promotion_code_package = new PromotionCodesPackage(['action_id'=>'1', 'reusable'=>0, 'quantity'=>100, 'codes_value'=>50, 'status'=>'active']);
		Assert::expect($promotion_code_package -> isValid()) -> toEqual(false);
	}

	public function testNameShouldHaveLessThan191Chars()
	{
		$random_string = StringUntils::getRandomString(190);
		$promotion_code_package = new PromotionCodesPackage(['name'=>$random_string, 'action_id'=>'1', 'reusable'=>0, 'quantity'=>100, 'codes_value'=>50, 'status'=>'active']);
		Assert::expect($promotion_code_package -> isValid()) -> toEqual(true);

		$random_string = StringUntils::getRandomString(191);
		$promotion_code_package = new PromotionCodesPackage(['name'=>$random_string, 'action_id'=>'1', 'reusable'=>0, 'quantity'=>100, 'codes_value'=>50, 'status'=>'active']);
		Assert::expect($promotion_code_package -> isValid()) -> toEqual(false);
	}

	public function testActionIdShouldBeRequire()
	{
		$promotion_code_package = new PromotionCodesPackage(['name'=>'name', 'reusable'=>0, 'quantity'=>100, 'codes_value'=>50, 'status'=>'active']);
		Assert::expect($promotion_code_package -> isValid()) -> toEqual(false);
	}
	
	public function testQuantityShouldBeRequire()
	{
		$promotion_code_package = new PromotionCodesPackage(['name'=>'name', 'action_id'=>'1', 'reusable'=>0, 'codes_value'=>50, 'status'=>'active']);
		Assert::expect($promotion_code_package -> isValid()) -> toEqual(false);
	}

	public function testQuantityShouldHaveLessThan12Chars()
	{
		$random_number = StringUntils::getRandomNumber(11);
		$promotion_code_package = new PromotionCodesPackage(['name'=>'name', 'action_id'=>'1', 'reusable'=>0, 'quantity'=>$random_number, 'codes_value'=>50, 'status'=>'active']);
		Assert::expect($promotion_code_package -> isValid()) -> toEqual(true);

		$random_number = StringUntils::getRandomNumber(12);
		$promotion_code_package = new PromotionCodesPackage(['name'=>'name', 'action_id'=>'1', 'reusable'=>0, 'quantity'=>$random_number, 'codes_value'=>50, 'status'=>'active']);
		Assert::expect($promotion_code_package -> isValid()) -> toEqual(false);
	}

	public function testCodesValueShouldBeRequire()
	{
		$promotion_code_package = new PromotionCodesPackage(['name'=>'name', 'action_id'=>'1', 'reusable'=>0, 'quantity'=>100, 'status'=>'active']);
		Assert::expect($promotion_code_package -> isValid()) -> toEqual(false);
	}
	
	public function testCodesValueShouldHaveLessThan12Chars()
	{
		$random_number = StringUntils::getRandomNumber(11);
		$promotion_code_package = new PromotionCodesPackage(['name'=>'name', 'action_id'=>'1', 'reusable'=>0, 'quantity'=>100, 'codes_value'=>$random_number, 'status'=>'active']);
		Assert::expect($promotion_code_package -> isValid()) -> toEqual(true);

		$random_number = StringUntils::getRandomNumber(12);
		$promotion_code_package = new PromotionCodesPackage(['name'=>'name', 'action_id'=>'1', 'reusable'=>0, 'quantity'=>100, 'codes_value'=>$random_number, 'status'=>'active']);
		Assert::expect($promotion_code_package -> isValid()) -> toEqual(false);
	}
}