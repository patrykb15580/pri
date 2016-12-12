<?php
/**
* 
*/
class HistoriesModelTest extends Tests
{
	
	public function testHistoryIsValid()
	{
		$history = new History(['client_id'=>1, 'promotor_id'=>1, 'points'=>'+ 100', 'balance_before'=>0, 'balance_after'=>10, 'description'=>'desc']);
		Assert::expect($history -> isValid()) -> toEqual(true);
	}

	public function testClientIdShouldBeRequire()
	{
		$history = new History(['promotor_id'=>1, 'points'=>'+ 100', 'balance_before'=>0, 'balance_after'=>10, 'description'=>'desc']);
		Assert::expect($history -> isValid()) -> toEqual(false);
	}

	public function testClientIdHaveLessThan12Chars()
	{
		$random_number = StringUntils::getRandomNumber(11);
		$history = new History(['client_id'=>$random_number, 'promotor_id'=>1, 'points'=>'+ 100', 'balance_before'=>0, 'balance_after'=>10, 'description'=>'desc']);
		Assert::expect($history -> isValid()) -> toEqual(true);

		$random_number = StringUntils::getRandomNumber(12);
		$history = new History(['client_id'=>$random_number, 'promotor_id'=>1, 'points'=>'+ 100', 'balance_before'=>0, 'balance_after'=>10, 'description'=>'desc']);
		Assert::expect($history -> isValid()) -> toEqual(false);
	}

	public function testPromotorIdShouldBeRequire()
	{
		$history = new History(['promotor_id'=>1, 'points'=>'+ 100', 'balance_before'=>0, 'balance_after'=>10, 'description'=>'desc']);
		Assert::expect($history -> isValid()) -> toEqual(false);
	}

	public function testPromotorIdHaveLessThan12Chars()
	{
		$random_number = StringUntils::getRandomNumber(11);
		$history = new History(['client_id'=>1, 'promotor_id'=>$random_number, 'points'=>'+ 100', 'balance_before'=>0, 'balance_after'=>10, 'description'=>'desc']);
		Assert::expect($history -> isValid()) -> toEqual(true);

		$random_number = StringUntils::getRandomNumber(12);
		$history = new History(['client_id'=>1, 'promotor_id'=>$random_number, 'points'=>'+ 100', 'balance_before'=>0, 'balance_after'=>10, 'description'=>'desc']);
		Assert::expect($history -> isValid()) -> toEqual(false);
	}

	public function testPointsShouldBeRequire()
	{
		$history = new History(['client_id'=>1, 'promotor_id'=>1, 'balance_before'=>0, 'balance_after'=>10, 'description'=>'desc']);
		Assert::expect($history -> isValid()) -> toEqual(false);
	}

	public function testPointsHaveLessThan191Chars()
	{
		$random_string = StringUntils::getRandomString(190);
		$history = new History(['client_id'=>1, 'promotor_id'=>1, 'points'=>$random_string, 'balance_before'=>0, 'balance_after'=>10, 'description'=>'desc']);
		Assert::expect($history -> isValid()) -> toEqual(true);

		$random_string = StringUntils::getRandomString(191);
		$history = new History(['client_id'=>1, 'promotor_id'=>1, 'points'=>$random_string, 'balance_before'=>0, 'balance_after'=>10, 'description'=>'desc']);
		Assert::expect($history -> isValid()) -> toEqual(false);
	}

	public function testBalanceBeforeShouldBeRequire()
	{
		$history = new History(['client_id'=>1, 'promotor_id'=>1, 'points'=>'+ 100', 'balance_after'=>10, 'description'=>'desc']);
		Assert::expect($history -> isValid()) -> toEqual(false);
	}

	public function testBalanceBeforeHaveLessThan12Chars()
	{
		$random_number = StringUntils::getRandomNumber(11);
		$history = new History(['client_id'=>1, 'promotor_id'=>1, 'points'=>'+ 100', 'balance_before'=>$random_number, 'balance_after'=>10, 'description'=>'desc']);
		Assert::expect($history -> isValid()) -> toEqual(true);

		$random_number = StringUntils::getRandomNumber(12);
		$history = new History(['client_id'=>1, 'promotor_id'=>1, 'points'=>'+ 100', 'balance_before'=>$random_number, 'balance_after'=>10, 'description'=>'desc']);
		Assert::expect($history -> isValid()) -> toEqual(false);
	}

	public function testBalanceAfterShouldBeRequire()
	{
		$history = new History(['client_id'=>1, 'promotor_id'=>1, 'points'=>'+ 100', 'balance_before'=>0, 'description'=>'desc']);
		Assert::expect($history -> isValid()) -> toEqual(false);
	}

	public function testBalanceAfterHaveLessThan12Chars()
	{
		$random_number = StringUntils::getRandomNumber(11);
		$history = new History(['client_id'=>1, 'promotor_id'=>1, 'points'=>'+ 100', 'balance_before'=>0, 'balance_after'=>$random_number, 'description'=>'desc']);
		Assert::expect($history -> isValid()) -> toEqual(true);

		$random_number = StringUntils::getRandomNumber(12);
		$history = new History(['client_id'=>1, 'points'=>'+ 100', 'balance_before'=>0, 'balance_after'=>$random_number, 'description'=>'desc']);
		Assert::expect($history -> isValid()) -> toEqual(false);
	}

	public function testDescriptionShouldBeRequire()
	{
		$history = new History(['client_id'=>1, 'promotor_id'=>1, 'points'=>'+ 100', 'balance_before'=>0, 'balance_after'=>10]);
		Assert::expect($history -> isValid()) -> toEqual(false);
	}
}
