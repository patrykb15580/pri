<?php
/**
* 
*/
class RandomPasswordGenerator
{
	public static function generate($length = 6) {
	    $characters = 'abcdefghjkmnpqrstuvwxyzABCDEFGHIJKMNPQRSTUVWXYZ1234567890';
	    $charactersLength = strlen($characters);
	    $password = '';

	    for ($i = 0; $i < $length; $i++) {
	        $password = $password.$characters[rand(0, $charactersLength - 1)];
	    }

	    return $password;
	}
}