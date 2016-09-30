<?php
/**
* 
*/
class StringUntilsTest extends Tests
{
	
	public function test_replace_polish_chars()
	{
		$string = StringUntils::replace_polish_chars('ĘÓĄŚŁŻŹĆŃęóąśłżźćń');
		Assert::expect($string) -> to_equal('EOASLZZCNeoaslzzcn');
	}
	public function test_replace_special_chars()
	{
		$string = StringUntils::replace_special_chars('!@#$%^&*():;/\?[]{}<>=+~|OK');
		Assert::expect($string) -> to_equal('OK');
	}
}

