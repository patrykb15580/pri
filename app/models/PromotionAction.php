<?php
/**
* 
*/
class PromotionAction extends Model
{
	public $id, $created_at, $updated_at, $name, $promotors_id, $status, $indefinitely, $from_at, $to_at;

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
			'status'				=>['type' => 'string',
									   'default' => 'active'],
			'indefinitely'			=>['type' => 'boolean',
										'default' => false],
			'from_at'				=>['type' => 'datetime',
										'default' => null],
			'to_at'					=>['type' => 'datetime',
										'default' => null]
		];
	}
	public static function pluralizeClassName()
	{
		return 'PromotionActions';
	}
	public function promotor()
	{
		return Promotor::find($this->promotors_id);
	}
	public function promotion_codes_packages()
	{
		return PromotionCodesPackage::where('action_id=?', ['action_id'=>$this->id]);
	}
}