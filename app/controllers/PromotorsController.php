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

		$view = (new View($this->params, ['promotor'=>$promotor]))->render();
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

		if (Password::equalPasswords($old_password, $promotor->password_degest)) {
			if (Promotor::updatePromotor($this->params)) {
				$this->alert('info', 'Profil został zaktualizowany');

				header("Location: http://".$_SERVER['HTTP_HOST']."/promotors/".$this->params['promotors_id']);
			} else {
				$this->alert('error', 'Nie udało się zaktualizować profilu<br />Spróbuj jeszcze raz');

				header("Location: http://".$_SERVER['HTTP_HOST']."/promotors/".$this->params['promotors_id']."/account");
			}
		} else {
			$this->alert('error', 'Podane hasła różnią się');

			header("Location: http://".$_SERVER['HTTP_HOST']."/promotors/".$this->params['promotors_id'].'/account');
		}
	}

	public function indexClients()
	{
		$promotor = $this->promotor();
		$this->auth(__FUNCTION__, $promotor);
	
		$view = (new View($this->params, ['promotor'=>$promotor]))->render();
		return $view;
	}

	public function indexOrders()
	{
		$promotor = $this->promotor();
		$this->auth(__FUNCTION__, $promotor);
		
		$view = (new View($this->params, ['promotor'=>$promotor]))->render();
		return $view;
	}

	public function showOrders()
	{
		$this->auth(__FUNCTION__, $this->promotor());
		$order = Order::find($this->params['order_id']);
		$image = $order->client();
		$reward = $order->reward();

		$view = (new View($this->params, ['order'=>$order, 'image'=>$image, 'reward'=>$reward]))->render();
		return $view;
	}

	public function promotor()
	{
		return Promotor::find($this->params['promotors_id']);
	}
}