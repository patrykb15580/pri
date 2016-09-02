<?php
/**
* 
*/
class Promotors extends Model
{
	public $id, $email, $password_degest, $created_at, $updated_at, $name;	

	function __construct($attributes = [])
	{
		parent::__construct($attributes);
	}
	public static function Fields()
	{
		return [
			'id'					=>['type' => 'integer',
									   'default' => null],
			'email'					=>['type' => 'intiger',
									   'default' => null,
									   'validation' => ['required', 'max_lenght:190']],
			'password_degest'		=>['type' => 'string',
									   'default' => null,
									   'validation' => ['required', 'password']],
			'created_at'			=>['type' => 'datetime',
									   'default' => null],
			'updated_at'			=>['type' => 'datetime',
									   'default' => null],
			'name'					=>['type' => 'string',
									   'default' => null,
									   'validation' => ['required', 'max_lenght:190']],
		];
	}
}