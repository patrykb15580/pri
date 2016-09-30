<?php
/**
* 
*/
class Reward extends Model
{
	public $id, $created_at, $updated_at, $name, $status, $description, $prize, $promotors_id;

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
			'name'					=>['type' => 'string',
									   'default' => null,
									   'validations' => ['required', 'max_length:190']],
			'status'				=>['type' => 'string',
									   'default' => 'active'],
			'description'			=>['type' => 'string',
									   'default' => null],
			'prize'					=>['type' => 'integer',
									   'default' => null,
									   'validations' => ['required']],
			'promotors_id'			=>['type' => 'integer',
									   'default' => null,
									   'validations' => ['required']],
			'created_at'			=>['type' => 'datetime',
									   'default' => null],
			'updated_at'			=>['type' => 'datetime',
									   'default' => null],					   
		];
	}
	public static function pluralizeClassName()
	{
		return 'Rewards';
	}
	public function images()
	{
		return Image::where('reward_id=?', ['reward_id'=>$this->id]);
	}
	public function promotor()
	{
		return Promotor::find($this->promotors_id);
	}
}