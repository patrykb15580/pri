<?php
/**
* 
*/
class HistoriesModelTest extends Tests
{
	
	public function test_history_is_valid()
	{
		$history = new History(['client_id'=>1, 'points'=>'+ 100', 'balance_before'=>0, 'balance_after'=>10, 'description'=>'desc']);
		Assert::expect($history -> isValid()) -> to_equal(true);
	}

	public function test_client_id_should_be_require()
	{
		$history = new History(['points'=>'+ 100', 'balance_before'=>0, 'balance_after'=>10, 'description'=>'desc']);
		Assert::expect($history -> isValid()) -> to_equal(false);
	}

	public function test_client_id_have_less_than_12_chars()
	{
		$random_number = StringUntils::get_random_number(11);
		$history = new History(['client_id'=>$random_number, 'points'=>'+ 100', 'balance_before'=>0, 'balance_after'=>10, 'description'=>'desc']);
		Assert::expect($history -> isValid()) -> to_equal(true);

		$random_number = StringUntils::get_random_number(12);
		$history = new History(['client_id'=>$random_number, 'points'=>'+ 100', 'balance_before'=>0, 'balance_after'=>10, 'description'=>'desc']);
		Assert::expect($history -> isValid()) -> to_equal(false);
	}

	public function test_points_should_be_require()
	{
		$history = new History(['client_id'=>1, 'balance_before'=>0, 'balance_after'=>10, 'description'=>'desc']);
		Assert::expect($history -> isValid()) -> to_equal(false);
	}

	public function test_points_have_less_than_191_chars()
	{
		$random_string = StringUntils::get_random_string(190);
		$history = new History(['client_id'=>1, 'points'=>$random_string, 'balance_before'=>0, 'balance_after'=>10, 'description'=>'desc']);
		Assert::expect($history -> isValid()) -> to_equal(true);

		$random_string = StringUntils::get_random_string(191);
		$history = new History(['client_id'=>1, 'points'=>$random_string, 'balance_before'=>0, 'balance_after'=>10, 'description'=>'desc']);
		Assert::expect($history -> isValid()) -> to_equal(false);
	}

	public function test_balance_before_should_be_require()
	{
		$history = new History(['client_id'=>1, 'points'=>'+ 100', 'balance_after'=>10, 'description'=>'desc']);
		Assert::expect($history -> isValid()) -> to_equal(false);
	}

	public function test_balance_before_have_less_than_12_chars()
	{
		$random_number = StringUntils::get_random_number(11);
		$history = new History(['client_id'=>1, 'points'=>'+ 100', 'balance_before'=>$random_number, 'balance_after'=>10, 'description'=>'desc']);
		Assert::expect($history -> isValid()) -> to_equal(true);

		$random_number = StringUntils::get_random_number(12);
		$history = new History(['client_id'=>1, 'points'=>'+ 100', 'balance_before'=>$random_number, 'balance_after'=>10, 'description'=>'desc']);
		Assert::expect($history -> isValid()) -> to_equal(false);
	}

	public function test_balance_after_should_be_require()
	{
		$history = new History(['client_id'=>1, 'points'=>'+ 100', 'balance_before'=>0, 'description'=>'desc']);
		Assert::expect($history -> isValid()) -> to_equal(false);
	}

	public function test_balance_after_have_less_than_12_chars()
	{
		$random_number = StringUntils::get_random_number(11);
		$history = new History(['client_id'=>1, 'points'=>'+ 100', 'balance_before'=>0, 'balance_after'=>$random_number, 'description'=>'desc']);
		Assert::expect($history -> isValid()) -> to_equal(true);

		$random_number = StringUntils::get_random_number(12);
		$history = new History(['client_id'=>1, 'points'=>'+ 100', 'balance_before'=>0, 'balance_after'=>$random_number, 'description'=>'desc']);
		Assert::expect($history -> isValid()) -> to_equal(false);
	}

	public function test_description_should_be_require()
	{
		$history = new History(['client_id'=>1, 'points'=>'+ 100', 'balance_before'=>0, 'balance_after'=>10]);
		Assert::expect($history -> isValid()) -> to_equal(false);
	}
}
