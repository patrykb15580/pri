<?php
/**
* 
*/
class Promotor extends Model
{
	use UserRole;

	public $id, $email, $password_degest, $created_at, $updated_at, $name, $status;	

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
									   'validations' => ['required', 'max_length:190', 'unique']],
			'password_degest'		=>['type' => 'string',
									   'default' => null,
									   'validations' => ['required']],
			'created_at'			=>['type' => 'datetime',
									   'default' => null],
			'updated_at'			=>['type' => 'datetime',
									   'default' => null],
			'name'					=>['type' => 'string',
									   'default' => null,
									   'validations' => ['required', 'max_length:190']],
			'status'				=>['type' => 'string',
									   'default' => 'active'],
		];
	}

	public static function pluralizeClassName()
	{
		return 'Promotors';
	}

	public function promotionActions()
	{
		return PromotionAction::where('promotors_id=?', ['promotors_id'=>$this->id]);
	}

	public function rewards()
	{
		return Reward::where('promotors_id=?', ['promotors_id'=>$this->id]);
	}

	public function promotionCodes()
	{
		return PromotionCode::where('promotors_id=?', ['promotors_id'=>$this->id]);
	}

	public function clients()
	{
		$balances = PointsBalance::where('promotor_id=?', ['promotor_id'=>$this->id], ['order'=>'created_at DESC']);
		
		$clients = [];
		foreach ($balances as $balance) {
			$client = Client::find($balance->client_id);
			$clients[$client->id] = $client;
		}

		return $clients;
	}

	public function orders()
	{
		return Order::where('promotor_id=?', ['promotor_id'=>$this->id]);
	}

	public static function updatePromotor($params)
	{
		$new_password = $params['promotor']['password'];
		$promotor = Promotor::find($params['promotors_id']);
		if (empty($new_password)) {
			unset($params['promotor']['password_degest']);
		} else {
			$params['promotor']['password'] = Password::encryptPassword($new_password);
		}

		unset($params['promotor']['password']);
		
		if (!$promotor->update($params['promotor'])) {
			return false;
		} else return true;
	}

	public function activeActions()
	{
		$promotor = Promotor::find($this->id);
		$active_actions = [];
		foreach ($promotor->promotionActions() as $action) {
			if($action->status == 'active'){
				array_push($active_actions, $action);
			}
		}

		return $active_actions;
	}

	public function inactiveActions()
	{
		$promotor = Promotor::find($this->id);
		$inactive_actions = [];
		foreach ($promotor->promotionActions() as $action) {
			if($action->status == 'inactive'){
				array_push($inactive_actions, $action);
			}
		}

		return $inactive_actions;
	}

	public function activeRewards()
	{
		$active_rewards = [];
		foreach ($this->rewards() as $reward) {
			if($reward->status == 'active'){
				array_push($active_rewards, $reward);
			}
		}

		return $active_rewards;
	}

	public function inactiveRewards()
	{
		$inactive_rewards = [];
		foreach ($this->rewards() as $reward) {
			if($reward->status == 'inactive'){
				array_push($inactive_rewards, $reward);
			}
		}

		return $inactive_rewards;
	}

	public function promotorOrders()
	{
		return AdminOrder::where('promotor_id=?', ['promotor_id'=>$this->id], ['order'=>'id DESC']);
	}
}