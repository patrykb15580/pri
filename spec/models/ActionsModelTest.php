<?php
/**
* 
*/
class ActionsModelTest extends Tests
{
	
	public function testActionsIsValid()
	{
		$promotion_actions = new Action(['name'=>'new promotor', 'promotor_id'=>1, 'type'=>'PromotionActions']);
		Assert::expect($promotion_actions -> isValid()) -> toEqual(true);
	}
	public function testShouldBeRequireName()
	{
		$promotion_actions = new Action(['promotor_id'=>1, 'type'=>'PromotionActions']);
		Assert::expect($promotion_actions -> isValid()) -> toEqual(false);
	}
	public function testShouldNameHaveLessThan191Chars()
	{
		$random_string = StringUntils::getRandomString(191);
		$promotion_actions = new Action(['name'=>$random_string, 'promotor_id'=>1, 'type'=>'PromotionActions']);
		Assert::expect($promotion_actions -> isValid()) -> toEqual(true);

		$random_string = StringUntils::getRandomString(192);
		$promotion_actions = new Action(['name'=>$random_string, 'promotor_id'=>1, 'type'=>'PromotionActions']);
		Assert::expect($promotion_actions -> isValid()) -> toEqual(false);
	}
	public function testShouldBeRequirePromotorId()
	{
		$promotion_actions = new Action(['name'=>'new promotor', 'type'=>'PromotionActions']);
		Assert::expect($promotion_actions -> isValid()) -> toEqual(false);
	}
	public function testShouldBeRequireType()
	{
		$promotion_actions = new Action(['name'=>'new promotor', 'promotor_id'=>1]);
		Assert::expect($promotion_actions -> isValid()) -> toEqual(false);
	}
}
