<?php
/**
* 
*/
class Password
{
	
	public static function encryptPassword($password)
	{
		return sha1('nfeifpwqjfewq'.$password);
	}
	
	public static function equal_passwords($old_password, $new_password)
	{
		if ($old_password == $new_password) {
			return true;
		} else return false;
	}
}