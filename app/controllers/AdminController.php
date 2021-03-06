<?php
/**
* 
*/
class AdminController extends Controller
{
	public function show()
	{	
		$this->auth(__FUNCTION__, new Admin);
		$promotors = Promotor::all(['order'=>'id DESC']);
		
		$view = (new View($this->params, ['promotors'=>$promotors]))->render();
		return $view;
	}

	public function showPromotor()
	{

		$this->auth(__FUNCTION__, new Admin);
		$promotor = Promotor::find($this->params['promotor_id']);

		$view = (new View($this->params, ['promotor'=>$promotor]))->render();
		return $view;
	}

	public function showPromotorAction()
	{
		$this->auth(__FUNCTION__, new Admin);
		$action = Action::find($this->params['action_id']);

		$view = (new View($this->params, ['action'=>$action]))->render();
		return $view;
	}

	public function showPromotorContest()
	{
		$this->auth(__FUNCTION__, new Admin);
		$action = Action::find($this->params['action_id']);

		$view = (new View($this->params, ['action'=>$action]))->render();
		return $view;
	}

	public function showPromotorStats()
	{
		$this->auth(__FUNCTION__, new Admin);
		$promotor = Promotor::find($this->params['promotor_id']);

		$view = (new View($this->params, ['promotor'=>$promotor]))->render();
		return $view;
	}

	public function showPromotorPackage()
	{
		$this->auth(__FUNCTION__, new Admin);
		$promotor = Promotor::find($this->params['promotor_id']);
		$package = CodesPackage::find($this->params['package_id']);

		$view = (new View($this->params, ['promotor'=>$promotor, 'package'=>$package]))->render();
		return $view;
	}

	public function showPromotorReward()
	{
		$this->auth(__FUNCTION__, new Admin);
		$promotor = Promotor::find($this->params['promotor_id']);
		$reward = Reward::find($this->params['reward_id']);

		$view = (new View($this->params, ['promotor'=>$promotor, 'reward'=>$reward]))->render();
		return $view;
	}

	public function showPromotorOrder()
	{	
		$this->auth(__FUNCTION__, new Admin);
		$promotor = Promotor::find($this->params['promotor_id']);
		$order = Order::find($this->params['order_id']);

		$view = (new View($this->params, ['promotor'=>$promotor, 'order'=>$order]))->render();
		return $view;
	}

	public function newPromotor()
	{
		$this->auth(__FUNCTION__, new Admin);
		$promotor = new Promotor;

		$view = (new View($this->params, ['promotor'=>$promotor]))->render();
		return $view;
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
				$this->alert('info', 'Dodano nowego promotora');
				header("Location: http://".$_SERVER['HTTP_HOST']."/admin");
			} else {
				$this->alert('error', 'Nie udało się dodać promotora');
				$this->params['action'] = 'newPromotor';
				$promotor = new Promotor($this->params['promotor']);
				
				$view = (new View($this->params, ['promotor'=>$promotor]))->render();
				return $view;
			}
		} else {
			$this->alert('error', 'Podane hasła różnią się');
			$this->params['action'] = 'newPromotor';
			$promotor = new Promotor($this->params['promotor']);
			
			$view = (new View($this->params, ['promotor'=>$promotor]))->render();
			return $view;
		}
	}

	public function editPromotor()
	{
		$this->auth(__FUNCTION__, new Admin);
		$promotor = Promotor::find($this->params['promotors_id']);
		
		$view = (new View($this->params, ['promotor'=>$promotor]))->render();
		return $view;
	}

	public function updatePromotor()
	{
		$promotor = Promotor::find($this->params['promotors_id']);
		$this->auth(__FUNCTION__, $promotor);
		
		if (empty($this->params['promotor']['password']) && empty($this->params['old_password'])) {
			$old_password = $promotor->password_degest;
		} else {
			$old_password = Password::encryptPassword($this->params['old_password']);
		}
		
		$new_password = Password::encryptPassword($this->params['promotor']['password']);
		$this->params['promotor']['password_degest'] = $new_password;

		if (Password::equalPasswords($old_password, $promotor->password_degest)) {
			if (Promotor::updatePromotor($this->params)) {
				$this->alert('info', 'Profil został zaktualizowany');

				header("Location: http://".$_SERVER['HTTP_HOST']."/admin/promotor/".$this->params['promotors_id']);
			} else {
				$this->alert('error', 'Nie udało się zaktualizować profilu, spróbuj jeszcze raz');

				header("Location: http://".$_SERVER['HTTP_HOST']."/admin/edit-promotor/".$this->params['promotors_id']);
			}
		} else {
			$this->alert('error', 'Nieprawidłowe bieżące hasło');

			header("Location: http://".$_SERVER['HTTP_HOST']."/admin/edit-promotor/".$this->params['promotors_id']);
		}
	}

	public function indexOrders()
	{
		$this->auth(__FUNCTION__, new Admin);
		$promotors = Promotor::all([]);

		$view = (new View($this->params, ['promotors'=>$promotors]))->render();
		return $view;
	}

	public function showOrder()
	{
		$this->auth(__FUNCTION__, new Admin);
		$order = AdminOrder::find($this->params['order_id']);
		
		$view = (new View($this->params, ['order'=>$order]))->render();
		return $view;
	}

	public function getCSV()
	{
		header('Content-Type: text/csv; charset=utf-8');
		header('Content-Disposition: attachment; filename=pakiet-'.$this->params['package_id'].'.csv');

		// create a file pointer connected to the output stream
		$output = fopen('php://output', 'w');

		// output the column headings
		fputcsv($output, array('Code'));

		// fetch the data
		$package = CodesPackage::find($this->params['package_id']);
		$codes = $package->promotionCodes();
		$data = [];
		foreach ($codes as $code) {
			array_push($data, $code->code);
		}

		fputcsv($output, $data, "\n");
	}

	public function changeOrderStatus()
	{
		$router = Config::get('router');
		$path = $router->generate('show_admin_order', ['order_id'=>$this->params['order_id']]);

		$order = AdminOrder::find($this->params['order_id']);

		$order->update(['status'=>$this->params['status']]);

		header('Location: '.$path);
	}
}