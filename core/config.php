<?php
/**
* 
*/
abstract class Config
{
	
	public static $items = array();

	public static function get($key = null){
		return static::$item[$key];
	}
	public static function set($key, $val){
		static::$item[$key] = $val;
	}
}