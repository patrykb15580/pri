<?php
/**
* 
*/
class Admin extends Model
{
	use UserRole;

	function __construct($attributes = [])
	{
		parent::__construct($attributes);
	}
	public static function fields()
	{
		return [];
	}

	public static function pluralizeClassName()
	{
		return 'Admin';
	}
}