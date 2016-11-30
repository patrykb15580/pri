<?php
/**
* 
*/
class PromotionActionsModelTest extends Tests
{
	
	public function testPromotionActionsIsValid()
	{
		$promotion_actions = new PromotionAction(['action_id'=>1]);
		Assert::expect($promotion_actions -> isValid()) -> toEqual(true);
	}
	
	public function testShouldBeRequireActionId()
	{
		$promotion_actions = new PromotionAction([]);
		Assert::expect($promotion_actions -> isValid()) -> toEqual(false);
	}
}
