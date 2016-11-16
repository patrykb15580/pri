<?php
/**
* 
*/
class Order extends Model
{
	public $id, $promotor_id, $client_id, $reward_id, $order_date, $comment, $status, $created_at, $updated_at;	
	const STATUSES = 	['active' => 'Niezrealizowane',
						 'completed'=>'Zrealizowane'];

	function __construct($attributes = [])
	{
		parent::__construct($attributes);
	}
	public static function fields()
	{
		return [
			'id'					=>['type' => 'integer',
									   'default' => null],
			'promotor_id'			=>['type' => 'integer',
									   'default' => null,
									   'validations' => ['required']],
			'client_id'				=>['type' => 'integer',
									   'default' => null,
									   'validations' => ['required']],
			'reward_id'				=>['type' => 'integer',
									   'default' => null,
									   'validations' => ['required']],
			'order_date'			=>['type' => 'datetime',
									   'default' => null],
			'comment'				=>['type' => 'string',
									   'default' => null],
			'status'				=>['type' => 'string',
									   'default' => 'active'],
			'created_at'			=>['type' => 'datetime',
									   'default' => null],
			'updated_at'			=>['type' => 'datetime',
									   'default' => null],
			
		];
	}
	public static function pluralizeClassName()
	{
		return 'Orders';
	}
	public function promotor()
	{
		return Promotor::find($this->promotor_id);
	}
	public function client()
	{
		return Client::find($this->client_id);
	}
	public function reward()
	{
		return Reward::find($this->reward_id);
	}
}