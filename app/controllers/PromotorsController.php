<?php
/**
* 
*/
class PromotorsController extends Controller
{
	public function show()
	{
		$promotor = $this->promotor();
		$this->auth(__FUNCTION__, $promotor);

		$active_actions = $promotor->activeActions();
		$inactive_actions = $promotor->inactiveActions();

		$view = (new View($this->params, ['promotor'=>$promotor, 'active_actions'=>$active_actions, 'inactive_actions'=>$inactive_actions]))->render();
		return $view;
	}

	public function edit()
	{
		$promotor = $this->promotor();
		$this->auth(__FUNCTION__, $promotor);
		
		$view = (new View($this->params, ['promotor'=>$promotor]))->render();
		return $view;
	}

	public function update()
	{
		$promotor = $this->promotor();
		$this->auth(__FUNCTION__, $promotor);

		if (empty($this->params['promotor']['password']) && empty($this->params['old_password'])) {
			$old_password = $promotor->password_degest;
		} else {
			$old_password = Password::encryptPassword($this->params['old_password']);
		}
		
		$new_password = Password::encryptPassword($this->params['promotor']['password']);
		$this->params['promotor']['password_degest'] = $new_password;

		if (Password::equalPasswords($old_password, $promotor->password_degest) == true) {
			if (Promotor::updatePromotor($this->params)) {
				header("Location: http://".$_SERVER['HTTP_HOST']."/promotors/".$this->params['promotors_id']);
			} else header("Location: http://".$_SERVER['HTTP_HOST']."/promotors/".$this->params['promotors_id']."/account?update=error");
		} else header("Location: http://".$_SERVER['HTTP_HOST']."/promotors/".$this->params['promotors_id'].'/account?password=error');
	}

	public function indexClients()
	{
		$promotor = $this->promotor();
		$this->auth(__FUNCTION__, $promotor);
		
		$clients = $promotor->clients();
		#echo "<pre>";
		#die(print_r($clients));

		$view = (new View($this->params, ['promotor'=>$promotor, 'clients'=>$clients]))->render();
		return $view;
	}

	public function indexOrders()
	{
		$this->auth(__FUNCTION__, $this->promotor());
		$orders = Order::where('promotor_id=?', ['promotor_id'=>$this->params['promotors_id']]);
		#echo "<pre>";
		#die(print_r($orders));
		$active_orders = [];
		$completed_orders = [];
		$canceled_orders = [];
		foreach ($orders as $order) {
			if($order->status == 'active'){
				array_push($active_orders, $order);
			} else if ($order->status == 'completed') {
				array_push($completed_orders, $order);
			} else if ($order->status == 'canceled') {
				array_push($canceled_orders, $order);
			}
		}
		
		$view = (new View($this->params, ['active_orders'=>$active_orders, 'completed_orders'=>$completed_orders, 'canceled_orders'=>$canceled_orders]))->render();
		return $view;
	}

	public function showOrders()
	{
		$this->auth(__FUNCTION__, $this->promotor());
		$order = Order::find($this->params['order_id']);
		$client = $order->client();
		$reward = $order->reward();
		#echo "<pre>";
		#die(print_r($client));

		$image = RewardImage::findBy('reward_id', $reward->id);
		
		$view = (new View($this->params, ['order'=>$order, 'client'=>$client, 'reward'=>$reward, 'image'=>$image]))->render();
		return $view;
	}

	public function promotor()
	{
		return Promotor::find($this->params['promotors_id']);
	}
}