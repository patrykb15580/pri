<?php
/**
* 
*/
class PromotorsModelTest extends Tests
{
	
	public function test_promotors_is_valid()
	{
		$promotors = new Promotors(['email'=>'test@test.com', 'password_degest'=>'password', 'name'=>'new promotor']);
		$promotors = $promotors -> is_valid();
		Assert::expect($promotors) -> to_equal(true);
	}
	public function test_promotors_is_not_valid()
	{
		$promotors = new Promotors(['password_degest'=>'password', 'name'=>'new promotor']);
	#	die(print_r());
		Assert::expect($promotors -> is_valid()) -> to_equal(false);
	}
}