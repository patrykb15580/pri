<?php
/**
* 
*/
class AdminOrder extends Model
{
	public $id, $promotor_id, $package_type, $package_id, $quantity, $order_date, $created_at, $updated_at, $status;	
	const STATUSES = ['waiting' => 'Oczekujące',
					  'active' => 'W trakcie reazlizacji',
					  'sent' => 'Wysłane',
					  'completed'=>'Zrealizowane',
					  'canceled'=>'Anulowane'];

	const TYPES = ['action' => 'Akcja promocyjna',
				   'contest' => 'Konkurs'];

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
			'package_type'			=>['type' => 'string',
									   'default' => null,
									   'validations' => ['required']],
			'package_id'			=>['type' => 'integer',
									   'default' => null,
									   'validations' => ['required']],
			'quantity'				=>['type' => 'integer',
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
		return 'AdminOrders';
	}

	public function promotor()
	{
		return Promotor::find($this->promotor_id);
	}

	public function reward()
	{
		return Reward::find($this->reward_id);
	}

	public function package()
	{
		return CodesPackage::find($this->package_id);
	}

	public static function waitingOrders($params = [])
	{
		return AdminOrder::where('status=?', ['status'=>'waiting'], $params);
	}

	public static function activeOrders($params = [])
	{
		return AdminOrder::where('status=?', ['status'=>'active'], $params);
	}

	public static function sentOrders($params = [])
	{
		return AdminOrder::where('status=?', ['status'=>'sent'], $params);
	}

	public static function completedOrders($params = [])
	{
		return AdminOrder::where('status=?', ['status'=>'completed'], $params);
	}

	public static function canceledOrders($params = [])
	{
		return AdminOrder::where('status=?', ['status'=>'canceled'], $params);
	}
}