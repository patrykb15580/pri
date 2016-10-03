<?php
/**
* 
*/
class AdminOrder extends Model
{
	public $id, $promotor_id, $package_id, $quantity, $reusable, $order_date, $created_at, $updated_at, $status;	
	const STATUSES = 	['waiting' => 'Oczekujące',
						'active' => 'W trakcie reazlizacji',
						'sent' => 'Wysłane',
						'completed'=>'Zrealizowane',
						'canceled'=>'Anulowane'];

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
			'package_id'			=>['type' => 'integer',
									   'default' => null,
									   'validations' => ['required']],
			'quantity'				=>['type' => 'integer',
									   'default' => null,
									   'validations' => ['required']],
			'reusable'				=>['type' => 'boolean',
									   'default' => null,
									   'validations' => ['required']],
			'order_date'			=>['type' => 'datetime',
									   'default' => null,
									   'validations' => ['required']],
			'created_at'			=>['type' => 'datetime',
									   'default' => null],
			'updated_at'			=>['type' => 'datetime',
									   'default' => null],
			'status'				=>['type' => 'string',
									   'default' => 'waiting'],
			
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
	public function reward()
	{
		return Reward::find($this->reward_id);
	}
}