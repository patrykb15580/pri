<?php
/**
* 
*/
class ClientsModelTest extends Tests
{
	public function testClientsIsValid()
	{
		$clients = new Client(['email'=>'test@test.com', 'name'=>'new client', 'phone_number'=>'123456789', 'password_digest'=>Password::encryptPassword(''), 'hash'=>HashGenerator::generate()]);
		Assert::expect($clients -> isValid()) -> toEqual(true);
	}
	public function testEmailAddressShouldBeRequire()
	{
		$clients = new Client(['name'=>'new client', 'phone_number'=>'123456789', 'password_digest'=>Password::encryptPassword(''), 'hash'=>HashGenerator::generate()]);
		Assert::expect($clients -> isValid()) -> toEqual(false);
	}
	public function testEmailAddressShouldHaveLessThan191Chars()
	{
		$random_string = StringUntils::getRandomString(190);
		$clients = new Client(['email'=>$random_string, 'name'=>'new client', 'phone_number'=>'123456789', 'password_digest'=>Password::encryptPassword(''), 'hash'=>HashGenerator::generate()]);
		Assert::expect($clients -> isValid()) -> toEqual(true);

		$random_string = StringUntils::getRandomString(191);
		$clients = new Client(['email'=>$random_string, 'name'=>'new client', 'phone_number'=>'123456789', 'password_digest'=>Password::encryptPassword(''), 'hash'=>HashGenerator::generate()]);
		Assert::expect($clients -> isValid()) -> toEqual(false);
	}
	public function testClientEmailIsUnique()
	{
		$clients = new Client(['email'=>'test@test.com', 'name'=>'new client1', 'phone_number'=>'123456789', 'password_digest'=>Password::encryptPassword(''), 'hash'=>HashGenerator::generate()]);
		$clients->save();
		$clients = new Client(['email'=>'test@test.com', 'name'=>'new client2', 'phone_number'=>'987654321', 'password_digest'=>Password::encryptPassword(''), 'hash'=>HashGenerator::generate()]);
		$clients->save();
		Assert::expect($clients -> isValid()) -> toEqual(false);
	}
	public function testPhoneNumberShouldHaveLessThan191Chars()
	{
		$random_string = StringUntils::getRandomString(190);
		$clients = new Client(['email'=>'test@test.com', 'name'=>'new client', 'phone_number'=>$random_string, 'password_digest'=>Password::encryptPassword(''), 'hash'=>HashGenerator::generate()]);
		Assert::expect($clients -> isValid()) -> toEqual(true);

		$random_string = StringUntils::getRandomString(191);
		$clients = new Client(['email'=>'test@test.com', 'name'=>'new client', 'phone_number'=>$random_string, 'password_digest'=>Password::encryptPassword(''), 'hash'=>HashGenerator::generate()]);
		Assert::expect($clients -> isValid()) -> toEqual(false);
	}
	public function testNameShouldHaveLessThan191Chars()
	{
		$random_string = StringUntils::getRandomString(190);
		$clients = new Client(['email'=>'test@test.com', 'name'=>$random_string, 'phone_number'=>'123456789', 'password_digest'=>Password::encryptPassword(''), 'hash'=>HashGenerator::generate()]);
		Assert::expect($clients -> isValid()) -> toEqual(true);

		$random_string = StringUntils::getRandomString(191);
		$clients = new Client(['email'=>'test@test.com', 'name'=>$random_string, 'phone_number'=>'123456789', 'password_digest'=>Password::encryptPassword(''), 'hash'=>HashGenerator::generate()]);
		Assert::expect($clients -> isValid()) -> toEqual(false);
	}
	public function testHashShouldBeRequire()
	{
		$clients = new Client(['email'=>'test@test.com', 'name'=>'new client', 'phone_number'=>'123456789', 'password_digest'=>Password::encryptPassword('')]);
		Assert::expect($clients -> isValid()) -> toEqual(false);
	}
}
