<?php
/**
* 
*/
class HashGenerator
{
	
	public static function generate()
	{
		$hash = date('YmdHis').StringUntils::getRandomNumber(4);
		$hash = md5($hash);
		return $hash;
	}
}