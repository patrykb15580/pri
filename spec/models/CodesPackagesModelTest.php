<?php
/**
* 
*/
class CodesPackagesModelTest extends Tests
{
	
	public function testPromotionCodesPackagesIsValid()
	{
		$promotion_code_package = new CodesPackage(['action_id'=>'1', 'quantity'=>100, 'codes_value'=>50, 'status'=>'active']);
		Assert::expect($promotion_code_package -> isValid()) -> toEqual(true);
	}

	public function testActionIdShouldBeRequire()
	{
		$promotion_code_package = new CodesPackage(['quantity'=>100, 'codes_value'=>50, 'status'=>'active']);
		Assert::expect($promotion_code_package -> isValid()) -> toEqual(false);
	}
	
	public function testQuantityShouldBeRequire()
	{
		$promotion_code_package = new CodesPackage(['action_id'=>'1', 'codes_value'=>50, 'status'=>'active']);
		Assert::expect($promotion_code_package -> isValid()) -> toEqual(false);
	}

	public function testQuantityShouldHaveLessThan12Chars()
	{
		$random_number = StringUntils::getRandomNumber(11);
		$promotion_code_package = new CodesPackage(['action_id'=>'1', 'quantity'=>$random_number, 'codes_value'=>50, 'status'=>'active']);
		Assert::expect($promotion_code_package -> isValid()) -> toEqual(true);

		$random_number = StringUntils::getRandomNumber(12);
		$promotion_code_package = new CodesPackage(['action_id'=>'1', 'quantity'=>$random_number, 'codes_value'=>50, 'status'=>'active']);
		Assert::expect($promotion_code_package -> isValid()) -> toEqual(false);
	}

	public function testCodesValueShouldBeRequire()
	{
		$promotion_code_package = new CodesPackage(['action_id'=>'1', 'quantity'=>100, 'status'=>'active']);
		Assert::expect($promotion_code_package -> isValid()) -> toEqual(false);
	}
	
	public function testCodesValueShouldHaveLessThan12Chars()
	{
		$random_number = StringUntils::getRandomNumber(11);
		$promotion_code_package = new CodesPackage(['action_id'=>'1', 'quantity'=>100, 'codes_value'=>$random_number, 'status'=>'active']);
		Assert::expect($promotion_code_package -> isValid()) -> toEqual(true);

		$random_number = StringUntils::getRandomNumber(12);
		$promotion_code_package = new CodesPackage(['action_id'=>'1', 'quantity'=>100, 'codes_value'=>$random_number, 'status'=>'active']);
		Assert::expect($promotion_code_package -> isValid()) -> toEqual(false);
	}
}