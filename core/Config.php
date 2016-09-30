<?php
/**
* 
*/
abstract class Config
{
	
	public static $items = array();

	public static function get($key = null){
		return static::$items[$key];
	}
	public static function set($key, $val){
		static::$items[$key] = $val;
	}
}