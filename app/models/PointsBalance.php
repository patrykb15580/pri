<?php
/**
* 
*/
class PointsBalance extends Model
{
	public $id, $client_id, $promotor_id, $created_at, $updated_at, $balance;	

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
									   'validations' => ['required']],
			'promotor_id'			=>['type' => 'integer',
									   'default' => null,
									   'validations' => ['required']],
			'created_at'			=>['type' => 'datetime',
									   'default' => null],
			'updated_at'			=>['type' => 'datetime',
									   'default' => null],
			'balance'				=>['type' => 'integer',
									   'default' => 0],
			
		];
	}
	public static function pluralizeClassName()
	{
		return 'PointsBalances';
	}
	public function client()
	{
		return Client::where('id=?', ['id'=>$this->client_id]);
	}
	public function promotor()
	{
		return Promotor::where('id=?', ['id'=>$this->promotor_id]);
	}
}