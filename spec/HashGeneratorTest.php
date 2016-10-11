<?php
/**
* 
*/
class HashGeneratorTest extends Tests
{
	
	public function testHashShouldHave32Chars()
	{
		$hash = HashGenerator::generate();
		Assert::expect(strlen($hash)) -> toEqual(32);
	}
	/*public function testHashIsNotEmpty()
	{
		$string = HashGenerator::generate();
		Assert::expect($string) -> toEqual('OK');
	}*/
}
