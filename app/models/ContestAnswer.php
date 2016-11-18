<?php
/**
* 
*/
class ContestAnswer extends Model
{
	public $id, $contest_id, $client_id, $answer, $created_at, $updated_at;	


	function __construct($attributes = [])
	{
		parent::__construct($attributes);
	}
	public static function fields()
	{
		return [
			'id'					=>['type' => 'integer',
									   'default' => null],
			'contest_id'			=>['type' => 'string',
									   'default' => null,
									   'validations' => ['required', 'max_length:190']],
			'client_id'				=>['type' => 'string',
									   'default' => null,
									   'validations' => ['required']],
			'answer'				=>['type' => 'datetime',
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