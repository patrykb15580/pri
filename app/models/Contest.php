<?php
/**
* 
*/
class Contest extends Model
{
	public $id, $name, $question, $from_at, $to_at, $promotor_id, $created_at, $updated_at, $status, $type;	

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
			'promotor_id'			=>['type' => 'integer',
									   'default' => null,
									   'validations' => ['required']],
			'created_at'			=>['type' => 'datetime',
									   'default' => null],
			'updated_at'			=>['type' => 'datetime',
									   'default' => null],
			'status'				=>['type' => 'string',
									   'default' => 'active',
									   'validations' => ['required']],
			'type'					=>['type' => 'boolean',
									   'default' => 0],
			
		];
	}

	public static function pluralizeClassName()
	{
		return 'Contests';
	}

	public function promotor()
	{
		return Promotor::find($this->promotor_id);
	}

	public function answers()
	{
		return ContestAnswer::where('contest_id=?', ['contest_id'=>$this->id]);
	}
}