<?php
/**
* 
*/
class Contest extends Model
{
	public $id, $name, $question, $promotor_id, $type, $created_at, $updated_at;	

	const STATUSES = 	['active' => 'Aktywny',
						'inactive' => 'Nieaktywny'];

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
			'question'				=>['type' => 'string',
									   'default' => null,
									   'validations' => ['required']],
			'from_at'				=>['type' => 'datetime',
									   'default' => null,
									   'validations' => ['required']],
			'to_at'					=>['type' => 'datetime',
									   'default' => null,
									   'validations' => ['required']],
			'created_at'			=>['type' => 'datetime',
									   'default' => null],
			'updated_at'			=>['type' => 'datetime',
									   'default' => null],
			'status'				=>['type' => 'string',
									   'default' => null,
									   'validations' => ['required']],
			'type'					=>['type' => 'boolean',
										'default' => false],
			
		];
	}

	public static function pluralizeClassName()
	{
		return 'Contests';
	}
}