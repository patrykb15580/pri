<?php
/**
* 
*/
class Password
{
	
	public static function encryptPassword($password)
	{
		return sha1(Config::get('salt').$password);
	}
	
	public static function equalPasswords($password1, $password2)
	{
		if ($password1 == $password2) {
			return true;
		} 

		return false;
	}
}