<?php
/**
* 
*/
class AdminController extends Controller
{
	public function show()
	{
		$this->auth(__FUNCTION__, new Admin);
		$promotors = Promotor::all([]);
		
		(new View($this->params, ['promotors'=>$promotors]))->render();
	}

	public function showPromotor()
	{
		$this->auth(__FUNCTION__, new Admin);
		$promotor = Promotor::find($this->params['promotor_id']);

		(new View($this->params, ['promotor'=>$promotor]))->render();
	}

	public function showPromotorAction()
	{
		$this->auth(__FUNCTION__, new Admin);
		$promotion_action = PromotionAction::find($this->params['action_id']);

		(new View($this->params, ['promotion_action'=>$promotion_action]))->render();
	}

	public function showPromotorPackage()
	{
		$this->auth(__FUNCTION__, new Admin);
		$promotor = Promotor::find($this->params['promotor_id']);
		$package = PromotionCodesPackage::find($this->params['package_id']);

		(new View($this->params, ['promotor'=>$promotor, 'package'=>$package]))->render();
	}

	public function showPromotorReward()
	{
		$this->auth(__FUNCTION__, new Admin);
		$promotor = Promotor::find($this->params['promotor_id']);
		$reward = Reward::find($this->params['reward_id']);

		(new View($this->params, ['promotor'=>$promotor, 'reward'=>$reward]))->render();
	}

	public function showPromotorOrder()
	{
		$this->auth(__FUNCTION__, new Admin);
		$promotor = Promotor::find($this->params['promotor_id']);
		$order = Order::find($this->params['order_id']);

		(new View($this->params, ['promotor'=>$promotor, 'order'=>$order]))->render();
	}

	public function newPromotor()
	{
		$this->auth(__FUNCTION__, new Admin);
		$promotor = new Promotor;

		(new View($this->params, ['promotor'=>$promotor]))->render();
	}

	public function createPromotor()
	{	
		$this->auth(__FUNCTION__, new Admin);
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
		$this->auth(__FUNCTION__, new Admin);
		$promotor = new Promotor;
		$promotor = Promotor::find($this->params['promotors_id']);
		(new View($this->params, ['promotor'=>$promotor]))->render();
	}

	public function updatePromotor()
	{
		$this->auth(__FUNCTION__, new Admin);
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
		$this->auth(__FUNCTION__, new Admin);
		$promotors = Promotor::all([]);
		(new View($this->params, ['promotors'=>$promotors]))->render();
	}

	public function showOrder()
	{
		$this->auth(__FUNCTION__, new Admin);
		$order = AdminOrder::find($this->params['order_id']);
		(new View($this->params, ['order'=>$order]))->render();
	}
}