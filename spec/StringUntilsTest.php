<?php
/**
* 
*/
class StringUntilsTest extends Tests
{
	
	public function testReplacePolishChars()
	{
		$string = StringUntils::replacePolishChars('ĘÓĄŚŁŻŹĆŃęóąśłżźćń');
		Assert::expect($string) -> toEqual('EOASLZZCNeoaslzzcn');
	}
	public function testreplaceSpecialChars()
	{
		$string = StringUntils::replaceSpecialChars('!@#$%^&*():;/\?[]{}<>=+~|OK');
		Assert::expect($string) -> toEqual('OK');
	}
}

