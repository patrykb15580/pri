<?php
/**
* 
*/
class PromotorsModelTest extends Tests
{
	
	public function testPromotorsIsValid()
	{
		$promotors = new Promotor(['email'=>'test@test.com', 'password_degest'=>'password', 'name'=>'new promotor']);
		Assert::expect($promotors -> isValid()) -> toEqual(true);
	}
	public function testEmailAddressShouldBeRequire()
	{
		$promotors = new Promotor(['password_degest'=>'password', 'name'=>'new promotor']);
		Assert::expect($promotors -> isValid()) -> toEqual(false);
	}
	public function testEmailAddressShouldHaveLessThan191Chars()
	{
		$random_string = StringUntils::getRandomString(190);
		$promotors = new Promotor(['email'=>$random_string, 'password_degest'=>'password', 'name'=>'new promotor']);
		Assert::expect($promotors -> isValid()) -> toEqual(true);

		$random_string = StringUntils::getRandomString(191);
		$promotors = new Promotor(['email'=>$random_string, 'password_degest'=>'password', 'name'=>'new promotor']);
		Assert::expect($promotors -> isValid()) -> toEqual(false);
	}
	public function testPasswordShouldBeRequire()
	{
		$promotors = new Promotor(['email'=>'test@test.com', 'name'=>'new promotor']);
		Assert::expect($promotors -> isValid()) -> toEqual(false);
	}
	public function testNameShouldBeRequire()
	{
		$promotors = new Promotor(['email'=>'test@test.com', 'password_degest'=>'password']);
		Assert::expect($promotors -> isValid()) -> toEqual(false);
	}
	public function testNameShouldHaveLessThan191Chars()
	{
		$random_string = StringUntils::getRandomString(190);
		$promotors = new Promotor(['email'=>'test@test.com', 'password_degest'=>'password', 'name'=>$random_string]);
		Assert::expect($promotors -> isValid()) -> toEqual(true);

		$random_string = StringUntils::getRandomString(191);
		$promotors = new Promotor(['email'=>'test@test.com', 'password_degest'=>'password', 'name'=>$random_string]);
		Assert::expect($promotors -> isValid()) -> toEqual(false);
	}
}
