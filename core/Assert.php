<?php
/**
* 
*/
class Assert{

	private static $subject;
	private static $_instance = null;


	public static function expect($subject)
	{
		self::$subject = $subject;
		if (self::$_instance ===null) {
			self::$_instance = new self;
		}
		return self::$_instance;
	}
	public static function to_equal($val)
	{
		if (self::$subject !== $val) {
			throw new Exception("Subjects are not equal. Expect: \n\n".
			print_r($val, true)."\n\n got \n\n".print_r(self::$subject, true)."\n\n");	
		}
	}
}