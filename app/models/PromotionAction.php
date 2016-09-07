<?php
/**
* 
*/
class PromotionAction extends Model
{
	public $id, $created_at, $updated_at, $name, $promotors_id;	

	function __construct($attributes = [])
	{
		parent::__construct($attributes);
	}
	public static function fields()
	{
		return [
			'id'					=>['type' => 'integer',
									   'default' => null],
			'created_at'			=>['type' => 'datetime',
									   'default' => null],
			'updated_at'			=>['type' => 'datetime',
									   'default' => null],
			'name'					=>['type' => 'string',
									   'default' => null,
									   'validations' => ['required', 'max_length:190']],
			'promotors_id'			=>['type' => 'integer',
									   'default' => null,
									   'validations' => ['required']],
		];
	}
	public static function pluralizeClassName()
	{
		return 'PromotionActions';
	}
}