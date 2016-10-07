<?php
/**
* 
*/
class EmptyFieldCheck
{
	
	public static function isEmpty($field)
	{
		if (empty($field)) {
			return true;
		} else return false;
	}
}