<?php
/**
* 
*/
class AdminController extends Controller
{
	public function show()
	{
		$promotors = Promotor::all([]);
		
		(new View($this->params, ['promotors'=>$promotors]))->render();
	}

	public function showPromotor()
	{
		$promotor = Promotor::find($this->params['promotor_id']);

		(new View($this->params, ['promotor'=>$promotor]))->render();
	}

	public function showPromotorAction()
	{
		$promotion_action = PromotionAction::find($this->params['action_id']);

		(new View($this->params, ['promotion_action'=>$promotion_action]))->render();
	}

	public function showPromotorPackage()
	{
		$promotor = Promotor::find($this->params['promotor_id']);
		$package = PromotionCodesPackage::find($this->params['package_id']);

		(new View($this->params, ['promotor'=>$promotor, 'package'=>$package]))->render();
	}

	public function showPromotorReward()
	{
		$promotor = Promotor::find($this->params['promotor_id']);
		$reward = Reward::find($this->params['reward_id']);

		(new View($this->params, ['promotor'=>$promotor, 'reward'=>$reward]))->render();
	}

	public function showPromotorOrder()
	{
		$promotor = Promotor::find($this->params['promotor_id']);
		$order = Order::find($this->params['order_id']);

		(new View($this->params, ['promotor'=>$promotor, 'order'=>$order]))->render();
	}

	public function newPromotor()
	{
		$promotor = new Promotor;

		(new View($this->params, ['promotor'=>$promotor]))->render();
	}

	public function createPromotor()
	{	
		$password = $this->params['promotor']['password_degest'];
		$confirm_password = $this->params['confirm_password'];
		$equal = Password::equalPasswords($password, $confirm_password);
		$promotor = new Promotor($this->params['promotor']);
		
		if ($equal == true) {
			if ($promotor->save()) {
			$promotor->update(['password_degest'=>Password::encryptPassword($password)]);
			header("Location: http://".$_SERVER['HTTP_HOST']."/admin?promotor=confirm");
			} else {
				$promotor = new Promotor($this->params['promotor']);
				(new View($this->params, ['promotor'=>$promotor]))->render();
			}
		} else {
			$promotor = new Promotor($this->params['promotor']);
			(new View($this->params, ['promotor'=>$promotor]))->render();
		}
	}

	public function editPromotor()
	{
		$promotor = new Promotor;
		$promotor = Promotor::find($this->params['promotors_id']);
		(new View($this->params, ['promotor'=>$promotor]))->render();
	}

	public function updatePromotor()
	{
		$promotor = Promotor::find($this->params['promotors_id']);
		
		$old_password = Password::encryptPassword($this->params['old_password']);
		$new_password = Password::encryptPassword($this->params['promotor']['password_degest']);
		$this->params['promotor']['password_degest'] = Password::encryptPassword($this->params['promotor']['password_degest']);

		if (Password::equalPasswords($old_password, $new_password) == true) {
			if (Promotor::updatePromotor($this->params)) {
				header("Location: http://".$_SERVER['HTTP_HOST']."/admin");
			} else header("Location: http://".$_SERVER['HTTP_HOST']."/admin/edit-promotor//".$this->params['promotors_id']);
		} else header("Location: http://".$_SERVER['HTTP_HOST']."/admin/edit-promotor/".$this->params['promotors_id']);
	}

	public function indexOrders()
	{
		$promotors = Promotor::all([]);
		(new View($this->params, ['promotors'=>$promotors]))->render();
	}

	public function showOrder()
	{
		$order = AdminOrder::find($this->params['order_id']);
		(new View($this->params, ['order'=>$order]))->render();
	}
}