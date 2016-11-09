<?php
/**
* 
*/
class Polices
{
	public $user, $obj;

	function __construct($user, $obj)
	{
		$this->user = $user;
		$this->obj = $obj;
	}
}