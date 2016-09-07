<?php
/**
* 
*/
class PromotionActionsTest extends Tests
{
	
	public function test_promotion_actions_is_valid()
	{
		$promotion_actions = new PromotionAction(['name'=>'new promotor', 'promotors_id'=>1]);
		Assert::expect($promotion_actions -> isValid()) -> to_equal(true);
	}
	public function test_should_be_require_name()
	{
		$promotion_actions = new PromotionAction(['promotors_id'=>1]);
		Assert::expect($promotion_actions -> isValid()) -> to_equal(false);
	}
	public function test_should_have_less_than_191_chars_name()
	{
		$random_string = StringUntils::get_random_string(190);
		$promotion_actions = new PromotionAction(['name'=>$random_string, 'promotors_id'=>1]);
		Assert::expect($promotion_actions -> isValid()) -> to_equal(true);

		$random_string = StringUntils::get_random_string(191);
		$promotion_actions = new PromotionAction(['name'=>$random_string, 'promotors_id'=>1]);
		Assert::expect($promotion_actions -> isValid()) -> to_equal(false);
	}
	public function test_should_be_require_promotor_id()
	{
		$promotion_actions = new PromotionAction(['name'=>'new promotor']);
		Assert::expect($promotion_actions -> isValid()) -> to_equal(false);
	}
}
