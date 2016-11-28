<?php
/**
* 
*/
class ContestStickersPackage extends Model
{
	public $id, $created_at, $updated_at, $contest_id, $quantity;

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
			'contest_id'			=>['type' => 'integer',
									   'default' => null,
									   'validations' => ['required']],
			'quantity'				=>['type' => 'integer',
									   'default' => null,
									   'validations' => ['required', 'max_length:11']],
		];
	}

	public static function pluralizeClassName()
	{
		return 'ContestStickersPackages';
	}

	public function contest()
	{
		return Contest::find($this->contest_id);
	}
}