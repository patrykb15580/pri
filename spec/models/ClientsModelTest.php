<?php
/**
* 
*/
class ClientsModelTest extends Tests
{
	
	public function test_clients_is_valid()
	{
		$clients = new Client(['email'=>'test@test.com', 'name'=>'new client', 'phone_number'=>'123456789']);
		Assert::expect($clients -> isValid()) -> to_equal(true);
	}
	public function test_email_address_should_be_require()
	{
		$clients = new Client(['name'=>'new client', 'phone_number'=>'123456789']);
		Assert::expect($clients -> isValid()) -> to_equal(false);
	}
	public function test_email_address_should_have_less_than_191_chars()
	{
		$random_string = StringUntils::get_random_string(190);
		$clients = new Client(['email'=>$random_string, 'name'=>'new client', 'phone_number'=>'123456789']);
		Assert::expect($clients -> isValid()) -> to_equal(true);

		$random_string = StringUntils::get_random_string(191);
		$clients = new Client(['email'=>$random_string, 'name'=>'new client', 'phone_number'=>'123456789']);
		Assert::expect($clients -> isValid()) -> to_equal(false);
	}
	public function test_phone_number_should_be_require()
	{
		$clients = new Client(['email'=>'test@test.com', 'name'=>'new client']);
		Assert::expect($clients -> isValid()) -> to_equal(false);
	}
	public function test_phone_numberclients_should_have_less_than_191_chars()
	{
		$random_string = StringUntils::get_random_string(190);
		$clients = new Client(['email'=>'test@test.com', 'name'=>'new client', 'phone_number'=>$random_string]);
		Assert::expect($clients -> isValid()) -> to_equal(true);

		$random_string = StringUntils::get_random_string(191);
		$clients = new Client(['email'=>'test@test.com', 'name'=>'new client', 'phone_number'=>$random_string]);
		Assert::expect($clients -> isValid()) -> to_equal(false);
	}
	public function test_name_should_be_require()
	{
		$clients = new Client(['email'=>'test@test.com', 'phone_number'=>'123456789']);
		Assert::expect($clients -> isValid()) -> to_equal(false);
	}
	public function test_name_should_have_less_than_191_chars()
	{
		$random_string = StringUntils::get_random_string(190);
		$clients = new Client(['email'=>'test@test.com', 'name'=>$random_string, 'phone_number'=>'123456789']);
		Assert::expect($clients -> isValid()) -> to_equal(true);

		$random_string = StringUntils::get_random_string(191);
		$clients = new Client(['email'=>'test@test.com', 'name'=>$random_string, 'phone_number'=>'123456789']);
		Assert::expect($clients -> isValid()) -> to_equal(false);
	}
}
