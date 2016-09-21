<?php
/**
* 
*/
class PromotionCodesPackage extends Model
{
	public $id, $name, $created_at, $updated_at, $action_id, $reusable, $quantity, $generated, $codes_value, $status;

	const STATUSES = 	['active' => 'Aktywne',
						'inactive' => 'Nieaktywne'];
	const TYPES = 		[0 => 'Jednorazowe',
						1 => 'Wielorazowe'];

	function __construct($attributes = [])
	{
		parent::__construct($attributes);
	}
	public static function fields()
	{
		return [
			'id'					=>['type' => 'integer',
									   'default' => null],
			'name'					=>['type' => 'string',
									   'default' => null,
									   'validations' => ['required', 'max_length:190']],
			'created_at'			=>['type' => 'datetime',
									   'default' => null],
			'updated_at'			=>['type' => 'datetime',
									   'default' => null],
			'action_id'				=>['type' => 'integer',
									   'default' => null,
									   'validations' => ['required']],
			'reusable'				=>['type' => 'boolean',
									   'default' => 0],
			'quantity'				=>['type' => 'integer',
									   'default' => null,
									   'validations' => ['required', 'max_length:11']],
			'generated'				=>['type' => 'integer',
									   'default' => 0],
			'codes_value'			=>['type' => 'integer',
									   'default' => null,
									   'validations' => ['required', 'max_length:11']],
			'status'				=>['type' => 'string',
									   'default' => 'active']
		];
	}
	public static function pluralizeClassName()
	{
		return 'PromotionCodesPackages';
	}
	public function promotion_action()
	{
		return PromotionAction::find($this->action_id);
	}
	public function promotion_codes()
	{
		return PromotionCode::where('package_id=?', ['package_id'=>$this->id]);
	}
}