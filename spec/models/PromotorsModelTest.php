<?php
/**
* 
*/
class PromotorsModelTest extends Tests
{
	
	public function test_promotors_is_valid()
	{
		$promotors = new Promotor(['email'=>'test@test.com', 'password_degest'=>'password', 'name'=>'new promotor']);
		Assert::expect($promotors -> isValid()) -> to_equal(true);
	}
	public function test_email_address_should_be_require()
	{
		$promotors = new Promotor(['password_degest'=>'password', 'name'=>'new promotor']);
		Assert::expect($promotors -> isValid()) -> to_equal(false);
	}
	public function test_email_address_should_have_less_than_191_chars()
	{
		$random_string = StringUntils::get_random_string(190);
		$promotors = new Promotor(['email'=>$random_string, 'password_degest'=>'password', 'name'=>'new promotor']);
		Assert::expect($promotors -> isValid()) -> to_equal(true);

		$random_string = StringUntils::get_random_string(191);
		$promotors = new Promotor(['email'=>$random_string, 'password_degest'=>'password', 'name'=>'new promotor']);
		Assert::expect($promotors -> isValid()) -> to_equal(false);
	}
	public function test_password_should_be_require()
	{
		$promotors = new Promotor(['email'=>'test@test.com', 'name'=>'new promotor']);
		Assert::expect($promotors -> isValid()) -> to_equal(false);
	}
	public function test_name_should_be_require()
	{
		$promotors = new Promotor(['email'=>'test@test.com', 'password_degest'=>'password']);
		Assert::expect($promotors -> isValid()) -> to_equal(false);
	}
	public function test_name_should_have_less_than_191_chars()
	{
		$random_string = StringUntils::get_random_string(190);
		$promotors = new Promotor(['email'=>'test@test.com', 'password_degest'=>'password', 'name'=>$random_string]);
		Assert::expect($promotors -> isValid()) -> to_equal(true);

		$random_string = StringUntils::get_random_string(191);
		$promotors = new Promotor(['email'=>'test@test.com', 'password_degest'=>'password', 'name'=>$random_string]);
		Assert::expect($promotors -> isValid()) -> to_equal(false);
	}

	/*public function test_basicORM_save()
	{
		$promotor = new Promotor(['email'=>'test@test.com', 'password_degest'=>'password', 'name'=>'new promotor']);
		
		Assert::expect($promotor->save()) -> to_equal(true);

	}
	public function test_basicORM_read()
	{
		$new_promotor = new Promotor(['email'=>'test@test.com', 'password_degest'=>'password', 'name'=>'new promotor']);

		$new_promotor->save();
		
		$promotors = Promotor::where('name=?', ["name"=>"new promotor"]);
		
		$promotor_arr = get_object_vars($promotors[0]);

		Assert::expect($promotor_arr['name']) -> to_equal('new promotor');
	}*/
}
