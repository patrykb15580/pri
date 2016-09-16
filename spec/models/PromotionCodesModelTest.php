<?php
/**
* 
*/
class PromotionCodesModelTest extends Tests
{
	
	public function test_promotion_codes_is_valid()
	{
		$promotion_code = new PromotionCode(['code'=>'code', 'package_id'=>'1', 'used'=>0]);
		Assert::expect($promotion_code -> isValid()) -> to_equal(true);
	}

	public function test_promotion_codes_is_not_valid()
	{
		$promotion_code = new PromotionCode(['package_id'=>'1', 'used'=>0]);
		Assert::expect($promotion_code -> isValid()) -> to_equal(false);
	}

	public function test_promotion_codes_is_unique()
	{
		$promotion_code = new PromotionCode(['code'=>'code', 'package_id'=>'1', 'used'=>0]);
		$promotion_code->save();
		$promotion_code = new PromotionCode(['code'=>'code', 'package_id'=>'2', 'used'=>0]);
		$promotion_code->save();
		Assert::expect($promotion_code -> isValid()) -> to_equal(false);
	}
}