<?php
/**
* 
*/
class PromotionActionsModelTest extends Tests
{
	
	public function testPromotionActionsIsValid()
	{
		$promotion_actions = new PromotionAction(['name'=>'new promotor', 'promotors_id'=>1]);
		Assert::expect($promotion_actions -> isValid()) -> toEqual(true);
	}
	public function testShouldBeRequireName()
	{
		$promotion_actions = new PromotionAction(['promotors_id'=>1]);
		Assert::expect($promotion_actions -> isValid()) -> toEqual(false);
	}
	public function testShouldHaveLessThan191CharsName()
	{
		$random_string = StringUntils::getRandomString(190);
		$promotion_actions = new PromotionAction(['name'=>$random_string, 'promotors_id'=>1]);
		Assert::expect($promotion_actions -> isValid()) -> toEqual(true);

		$random_string = StringUntils::getRandomString(191);
		$promotion_actions = new PromotionAction(['name'=>$random_string, 'promotors_id'=>1]);
		Assert::expect($promotion_actions -> isValid()) -> toEqual(false);
	}
	public function testShouldBeRequirePromotorId()
	{
		$promotion_actions = new PromotionAction(['name'=>'new promotor']);
		Assert::expect($promotion_actions -> isValid()) -> toEqual(false);
	}
}
