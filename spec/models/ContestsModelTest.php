<?php
/**
* 
*/
class ContestsModelTest extends Tests
{
	
	public function testContestsIsValid()
	{
		$contest = new Contest(['action_id'=>1, 'question'=>StringUntils::getRandomString(20), 'from_at'=>date('Y-m-d'), 'to_at'=>date('Y-m-d', strtotime('+1 week'))]);
		Assert::expect($contest -> isValid()) -> toEqual(true);
	}
	
	public function testShouldBeRequireActionId()
	{
		$contest = new Contest(['question'=>StringUntils::getRandomString(20), 'from_at'=>date('Y-m-d'), 'to_at'=>date('Y-m-d', strtotime('+1 week'))]);
		Assert::expect($contest -> isValid()) -> toEqual(false);
	}

	public function testShouldBeRequireQuestion()
	{
		$contest = new Contest(['action_id'=>1, 'from_at'=>date('Y-m-d'), 'to_at'=>date('Y-m-d', strtotime('+1 week'))]);
		Assert::expect($contest -> isValid()) -> toEqual(false);
	}

	public function testShouldBeRequireFromAt()
	{
		$contest = new Contest(['action_id'=>1, 'question'=>StringUntils::getRandomString(20), 'to_at'=>date('Y-m-d', strtotime('+1 week'))]);
		Assert::expect($contest -> isValid()) -> toEqual(false);
	}

	public function testShouldBeRequireToAt()
	{
		$contest = new Contest(['action_id'=>1, 'question'=>StringUntils::getRandomString(20), 'from_at'=>date('Y-m-d'), ]);
		Assert::expect($contest -> isValid()) -> toEqual(false);
	}
}
