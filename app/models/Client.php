<?php
/**
* 
*/
class Client extends Model
{
	use UserRole;
	
	public $id, $email, $name, $phone_number, $created_at, $updated_at, $hash;	

	function __construct($attributes = [])
	{
		parent::__construct($attributes);
	}
	public static function fields()
	{
		return [
			'id'					=>['type' => 'integer',
									   'default' => null],
			'email'					=>['type' => 'string',
									   'default' => null,
									   'validations' => ['required', 'unique', 'max_length:190']],
			'name'					=>['type' => 'string',
									   'default' => null,
									   'validations' => ['required', 'max_length:190']],
			'phone_number'			=>['type' => 'string',
									   'default' => null,
									   'validations' => ['required', 'max_length:190']],
			'created_at'			=>['type' => 'datetime',
									   'default' => null],
			'updated_at'			=>['type' => 'datetime',
									   'default' => null],
			'hash'					=>['type' => 'string',
									   'default' => null,
									   'validations' => ['required', 'unique', 'max_length:190']]
			
		];
	}

	public static function pluralizeClassName()
	{
		return 'Clients';
	}

	public function promotionCodes()
	{
		return PromotionCode::where('client_id=?', ['client_id'=>$this->id]);
	}

	public function packages()
	{
		$packages = [];
		foreach ($this->promotionCodes() as $code) {
			$package = $code->package();
			$packages[$code->package_id] = $package;
		}
		return $packages;
	}

	public function packagesValues()
	{
		$packages_values = [];
		
		foreach ($this->packages() as $package) {

			$codes_number = count(PromotionCode::where('package_id=? AND client_id=?', ['package_id'=>$package->id, 'client_id'=>$this->id]));
			$package_value = $codes_number*$package->codes_value;

			$packages_values[$package->id] = $package_value;
		}

		return $packages_values;
	}

	public function promotionActions()
	{
		$promotion_actions = [];

		foreach ($this->packages() as $package) {
			$promotion_action = $package->promotionAction();
			$promotion_actions[$package->action_id] = $promotion_action;
		}

		return $promotion_actions;
	}

	public function promotionActionsValues()
	{
		$promotion_actions_values = [];

		foreach ($this->packages() as $package) {
			if (array_key_exists($package->action_id, $promotion_actions_values)) {
				$action_value = $promotion_actions_values[$package->action_id] + $this->packagesValues()[$package->id];
			}
			if (!array_key_exists($package->action_id, $promotion_actions_values)) {
				$action_value = $this->packagesValues()[$package->id];
			}
			$promotion_actions_values[$package->action_id] = $action_value;
		}

		return $promotion_actions_values;
	}

	public function promotors()
	{
		$promotors = [];
		foreach ($this->promotionActions() as $promotion_action) {
			$promotor = $promotion_action->promotor();
			$promotors[$promotion_action->promotors_id] = $promotor;
		}
		return $promotors;
	}

	public function balance($promotor)
	{
		$balance = PointsBalance::where('client_id=? AND promotor_id=?', ['client_id'=>$this->id, 'promotor_id'=>$promotor->id]);
		return $balance[0];
	}

	public function activeOrders()
	{
		$orders = Order::where('client_id=?', ['client_id'=>$this->id]);
		$active_orders = [];
		foreach ($orders as $order) {
			if($order->status == 'active'){
				array_push($active_orders, $order);
			} 
		}
		return $active_orders;
	}

	public function completedOrders()
	{
		$orders = Order::where('client_id=?', ['client_id'=>$this->id]);
		$completed_orders = [];
		foreach ($orders as $order) {
			if($order->status == 'completed'){
				array_push($completed_orders, $order);
			} 
		}
		return $completed_orders;
	}

	public function canceledOrders()
	{
		$orders = Order::where('client_id=?', ['client_id'=>$this->id]);
		$canceled_orders = [];
		foreach ($orders as $order) {
			if($order->status == 'canceled'){
				array_push($canceled_orders, $order);
			} 
		}
		return $canceled_orders;
	}
}