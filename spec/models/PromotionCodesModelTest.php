<?php
/**
* 
*/
class PromotionCodesModelTest extends Tests
{
	
	public function testPromotionCodesIsValid()
	{
		$promotion_code = new PromotionCode(['code'=>'code', 'package_id'=>'1', 'used'=>'2016-05-11 12:42:12']);
		Assert::expect($promotion_code -> isValid()) -> toEqual(true);
	}

	public function testPromotionCodesIsNotValid()
	{
		$promotion_code = new PromotionCode(['package_id'=>'1', 'used'=>'2016-05-11 12:42:12']);
		Assert::expect($promotion_code -> isValid()) -> toEqual(false);
	}

	public function testPromotionCodesIsUnique()
	{
		$promotion_code = new PromotionCode(['code'=>'code', 'package_id'=>'1', 'used'=>'2016-05-11 12:42:12']);
		$promotion_code->save();
		$promotion_code = new PromotionCode(['code'=>'code', 'package_id'=>'2', 'used'=>'2016-05-11 12:42:12']);
		$promotion_code->save();
		Assert::expect($promotion_code -> isValid()) -> toEqual(false);
	}
}