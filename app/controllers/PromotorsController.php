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

	public function stats()
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

	public function newClientsInMonth()
	{
		$promotor = $this->promotor();

		$arr = [];

        if (!isset($this->params['clients_month'])) { $this->params['clients_month'] = date("m"); }

        $days = cal_days_in_month(CAL_GREGORIAN, $this->params['clients_month'] , date("Y") );

        for ($i=1; $i <= $days; $i++) { 
           $date = date("Y-").$this->params['clients_month'].'-'.$i;
           #$date = date("Y-m-").$i; };
           $row = [(string)$i, count($promotor->newClientsInDay($date)), "Liczba klientów: ".count($promotor->newClientsInDay($date))];
           array_push($arr, $row);
		}

		return json_encode($arr);

	}

	public function codesUsedInMonth()
	{
		$promotor = $this->promotor();

		$arr = [];

        if (!isset($this->params['codes_month'])) { $this->params['codes_month'] = date("m"); }

        $days = cal_days_in_month(CAL_GREGORIAN, $this->params['codes_month'] , date("Y") );

        for ($i=1; $i <= $days; $i++) { 
           $date = date("Y-").$this->params['codes_month'].'-'.$i;
           #$date = date("Y-m-").$i; };
           $row = [(string)$i, count($promotor->codesUsedInDay($date)), "Liczba kodów: ".count($promotor->codesUsedInDay($date))];
           array_push($arr, $row);
		}

		return json_encode($arr);

	}

	public function codesUsedInYear()
	{
		$promotor = $this->promotor();

		$arr = [];

	    for ($i=1; $i <= date("m"); $i++) { 
	    	$date = date("Y-").$i.date("-d");
	        $row = [(string)PolishMonthName::NAMES[$i], count($promotor->codesUsedInMonth($date)) ,'Liczba kodów: '.count($promotor->codesUsedInMonth($date))];
	        array_push($arr, $row);
	    }

		return json_encode($arr);

	}

	public function promotor()
	{
		return Promotor::find($this->params['promotors_id']);
	}
}