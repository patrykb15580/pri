<?php
/**
* 
*/
class PromotionCode extends Model
{
	public $id, $code, $created_at, $updated_at, $package_id, $used;

	const STATUSES = 	['active' => 'Aktywne',
						'inactive' => 'Nieaktywne'];

	function __construct($attributes = [])
	{
		parent::__construct($attributes);
	}
	public static function fields()
	{
		return [
			'id'					=>['type' => 'integer',
									   'default' => null],
			'code'					=>['type' => 'string',
									   'default' => null,
									   'validations' => ['required', 'unique']],
			'created_at'			=>['type' => 'datetime',
									   'default' => null],
			'updated_at'			=>['type' => 'datetime',
									   'default' => null],
			'package_id'			=>['type' => 'integer',
									   'default' => null,
									   'validations' => ['required']],
			'used'					=>['type' => 'boolean',
									   'default' => false]
		];
	}
	public static function pluralizeClassName()
	{
		return 'PromotionCodes';
	}
}