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

	public function actions()
	{
		return Action::where('promotor_id=?', ['promotor_id'=>$this->id]);
	}

	public function canSendEmail()
	{
		$last_mail = Mail::where('promotor_id=?', ['promotor_id' => $this->id], ['order' => 'created_at DESC']);

		$today = date(Config::get('mysqltime'));

		if (date('N', strtotime($today)) > 6) {
			$next_email = date(Config::get('mysqltime'), strtotime($today.' next monday midnight'));
		} else if (!empty($last_mail)){
			$mailed = date(Config::get('mysqltime'), strtotime($last_mail[0]->mailed));

			$next_email = date(Config::get('mysqltime'), strtotime($mailed.' next sunday midnight'));
			$next_email = date(Config::get('mysqltime'), strtotime($next_email));
		}
			
		if (empty($last_mail[0])) {
			return true;
		}
		if ($today >= $next_email) {
			return true;
		}
		if ($today < $next_email) {
			return false;
		}
	}

	public function promotionActions($params = [])
	{
		return Action::where('promotor_id=? AND type=?', ['promotor_id'=>$this->id, 'type'=>'PromotionActions'], $params);
	}

	public function contests($params = [])
	{
		return Action::where('promotor_id=? AND type=?', ['promotor_id'=>$this->id, 'type'=>'Contests'], $params);
	}

	public function opinions($params = [])
	{
		$actions = Action::where('promotor_id=?', ['promotor_id'=>$this->id], $params);

		$opinions = [];

		foreach ($actions as $action) {
			$opinion = $action->opinion();
			if (!empty($opinion)) {
				array_push($opinions, $opinion);
			}
		}

		return $opinions;
	}

	public function rewards()
	{
		return Reward::where('promotors_id=?', ['promotors_id'=>$this->id]);
	}

	public function promotionCodes()
	{
		$actions = $this->promotionActions();
		$codes = [];
		foreach ($actions as $action) {
			$action_codes = $action->codes();
			foreach ($action_codes as $code) {
				array_push($codes, $code);
			}
		}
		return $codes;
	}

	public function usedCodes()
	{
		$actions = $this->actions();
		$codes = [];
		foreach ($actions as $action) {
			$used_codes = $action->usedCodes();
			foreach ($used_codes as $code) {
				array_push($codes, $code);
			}
		}
		return $codes;
	}

	public function recentlyUsedCodes()
	{
		$codes = $this->usedCodes();

		usort($codes, function ($a, $b) {
		   return strtotime($b->used) - strtotime($a->used);
		});

		return $codes;
	}

	public function codesUsedInMonth($date)
	{
		$actions = $this->actions();
		$codes = [];
		foreach ($actions as $action) {
			$used_codes = $action->usedCodesInMonth($date);
			foreach ($used_codes as $code) {
				array_push($codes, $code);
			}
		}
		return $codes;
	}

	public function codesUsedFromTo($from, $to)
	{
		$actions = $this->actions();
		$codes = [];
		foreach ($actions as $action) {
			$used_codes = $action->usedCodesInMonth($from, $to);
			foreach ($used_codes as $code) {
				array_push($codes, $code);
			}
		}
		return $codes;
	}

	public function codesUsedInDay($date)
	{
		$actions = $this->actions();
		$codes = [];
		foreach ($actions as $action) {
			$used_codes = $action->usedCodesInDay($date);
			foreach ($used_codes as $code) {
				array_push($codes, $code);
			}
		}
		return $codes;
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

	public function newClientsPerWeek()
	{
		$balances = PointsBalance::where('promotor_id=? AND `created_at` >= "'.date(Config::get('mysqltime'), strtotime('-1 week')).'"', ['promotor_id'=>$this->id], ['order'=>'created_at DESC']);
		
		$clients = [];
		foreach ($balances as $balance) {
			$client = Client::find($balance->client_id);
			$clients[$client->id] = $client;
		}

		return $clients;
	}

	public function newClientsInMonth($date)
	{
		$month = date("m", strtotime($date));
		$balances = PointsBalance::where('promotor_id=? AND MONTH(`created_at`)=?', ['promotor_id'=>$this->id, 'created_at'=>$month], ['order'=>'created_at DESC']);
		
		$clients = [];
		foreach ($balances as $balance) {
			$client = Client::find($balance->client_id);
			$clients[$client->id] = $client;
		}

		return $clients;
	}

	public function newClientsInDay($date)
	{		
		return PointsBalance::where('promotor_id=? AND `created_at` >= "'.$date.' 00:00:00" AND `created_at` <= "'.$date.' 23:59:59"', ['promotor_id'=>$this->id], ['order'=>'created_at DESC']);
	}

	public function newestClients()
	{
		$clients = $this->clients();

		$clients = array_slice($clients, 0, 5);

		return $clients;
	}

	public function orders()
	{
		return Order::where('promotor_id=?', ['promotor_id'=>$this->id]);
	}

	public static function changePassword($password1, $password2)
	{
		if (empty($password1) && empty($password2)) {
			return false;
		}	else {
			return true;
		}
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

	public function avatar()
	{
		return PromotorAvatar::findBy('promotor_id', $this->id);
	}

	public function activeActions()
	{
		$actions = Action::where('promotor_id=? AND status=? AND type=?', ['promotor_id'=>$this->id, 'status'=>'active', 'type'=>'PromotionActions'], ['order'=>'created_at DESC']);

		return $actions;
	}

	public function inactiveActions()
	{
		$actions = Action::where('promotor_id=? AND status=? AND type=?', ['promotor_id'=>$this->id, 'status'=>'inactive', 'type'=>'PromotionActions'], ['order'=>'created_at DESC']);

		return $actions;
	}

	public function activeContests()
	{
		$contest = Action::where('promotor_id=? AND status=? AND type=?', ['promotor_id'=>$this->id, 'status'=>'active', 'type'=>'Contests'], ['order'=>'created_at DESC']);

		return $contest;
	}

	public function inactiveContests()
	{
		$contest = Action::where('promotor_id=? AND status=? AND type=?', ['promotor_id'=>$this->id, 'status'=>'inactive', 'type'=>'Contests'], ['order'=>'created_at DESC']);

		return $contest;
	}

	public function activeRewards()
	{
		$rewards = Reward::where('promotors_id=? AND status=?', ['promotors_id'=>$this->id, 'status'=>'active']);

		return $rewards;
	}

	public function inactiveRewards()
	{
		$rewards = Reward::where('promotors_id=? AND status=?', ['promotors_id'=>$this->id, 'status'=>'inactive']);

		return $rewards;
	}

	public function promotorOrders()
	{
		return AdminOrder::where('promotor_id=?', ['promotor_id'=>$this->id], ['order'=>'id DESC']);
	}

	public function activeOrders()
	{
		$orders = Order::where('promotor_id=? AND status=?', ['promotor_id'=>$this->id, 'status'=>'active']);
		
		return $orders;
	}

	public function completedOrders()
	{
		$orders = Order::where('promotor_id=? AND status=?', ['promotor_id'=>$this->id, 'status'=>'completed']);
		
		return $orders;
	}

	public function canceledOrders()
	{
		$orders = Order::where('promotor_id=? AND status=?', ['promotor_id'=>$this->id, 'status'=>'canceled']);
		
		return $orders;
	}
}