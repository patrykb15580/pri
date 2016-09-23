<?php
/**
* 
*/
class History extends Model
{
	public $id, $client_id, $points, $created_at, $updated_at, $balance_before, $balance_after, $description;	

	function __construct($attributes = [])
	{
		parent::__construct($attributes);
	}
	public static function fields()
	{
		return [
			'id'					=>['type' => 'integer',
									   'default' => null],
			'client_id'				=>['type' => 'integer',
									   'default' => null,
									   'validations' => ['required', 'max_length:11']],
			'points'				=>['type' => 'string',
									   'default' => null,
									   'validations' => ['required', 'max_length:190']],
			'created_at'			=>['type' => 'datetime',
									   'default' => null],
			'updated_at'			=>['type' => 'datetime',
									   'default' => null],
			'balance_before'		=>['type' => 'integer',
									   'default' => null,
									   'validations' => ['required', 'max_length:11']],
			'balance_after'			=>['type' => 'integer',
									   'default' => null,
									   'validations' => ['required', 'max_length:11']],
			'description'			=>['type' => 'string',
									   'default' => null,
									   'validations' => ['required']],
			
		];
	}
	public static function pluralizeClassName()
	{
		return 'Histories';
	}
	public function client()
	{
		return Client::find($this->id);
	}
}