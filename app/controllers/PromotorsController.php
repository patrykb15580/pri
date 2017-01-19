<?php
use Dompdf\Dompdf;
use Dompdf\Options;
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

				if (!empty($_FILES)) {
					$upload = new PromotorAvatar;
					$upload->uploadAvatar($_FILES, $this->params);
				}

				header("Location: http://".$_SERVER['HTTP_HOST']."/promotors/".$this->params['promotors_id']);
			} else {
				$this->alert('error', 'Nie udało się zaktualizować profilu, spróbuj jeszcze raz');

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
		$reward = $order->reward();
		$image = $reward->singleImage();

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

	public function newClientsInYear()
	{
		$promotor = $this->promotor();

		$arr = [];

	    for ($i=1; $i <= date("m"); $i++) { 
	    	$date = date("Y-").$i.date("-d");
	        $row = [(string)PolishMonthName::NAMES[$i], count($promotor->newClientsInMonth($date)) ,'Liczba klientów: '.count($promotor->newClientsInMonth($date))];
	        array_push($arr, $row);
	    }

		return json_encode($arr);

	}

	public function newClientsInRange()
	{
		$promotor = $this->promotor();

		if (!isset($this->params['clients_from'])) { 
        	$this->params['clients_from'] = date("Y-m-d", strtotime("-1 week"));
        }

        if (!isset($this->params['clients_to'])) { 
        	$this->params['clients_to'] = date("Y-m-d"); 
        }

        if ($this->params['clients_from'] > $this->params['clients_to']) {
        	$this->params['clients_from'] = $this->params['clients_to'];
        }
		$from = $this->params['clients_from'];
		$to = $this->params['clients_to'];

		$dates_arr = [];
		while ($from <= $to) {
			array_push($dates_arr, $from);
			$from = date('Y-m-d', strtotime($from."+1 day"));
		}

		$arr = [];
		foreach ($dates_arr as $date) {

			$clients_number = count($promotor->newClientsInDay($date));

			$label = '';
			if (count($dates_arr) <= 14) { 
				$label = date("d.m", strtotime($date)); 
			}

			$row = [$label, $clients_number ,'Liczba klientów dnia '.date("d.m.Y", strtotime($date)).': '.$clients_number];
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

	public function codesUsedInRange()
	{
		$promotor = $this->promotor();

		if (!isset($this->params['codes_from'])) { 
        	$this->params['codes_from'] = date("Y-m-d", strtotime("-1 week"));
        }

        if (!isset($this->params['codes_to'])) { 
        	$this->params['codes_to'] = date("Y-m-d"); 
        }

        if ($this->params['codes_from'] > $this->params['codes_to']) {
        	$this->params['codes_from'] = $this->params['codes_to'];
        }
		$from = $this->params['codes_from'];
		$to = $this->params['codes_to'];

		$dates_arr = [];
		while ($from <= $to) {
			array_push($dates_arr, $from);
			$from = date('Y-m-d', strtotime($from."+1 day"));
		}

		$arr = [];
		foreach ($dates_arr as $date) {

			$codes_number = count($promotor->codesUsedInDay($date));

			$label = '';
			if (count($dates_arr) <= 14) { 
				$label = date("d.m", strtotime($date)); 
			}
			$row = [$label, $codes_number,'Liczba kodów dnia '.date("d.m.Y", strtotime($date)).': '.$codes_number];
	        array_push($arr, $row);
		}

		return json_encode($arr);

	}

	public function mailing()
	{
		$promotor = $this->promotor();
		$this->auth(__FUNCTION__, $promotor);

		$view = (new View($this->params, ['promotor'=>$promotor]))->render();
		return $view;
	}

	public function sendMailing()
	{
		$promotor = $this->promotor();
		$this->auth(__FUNCTION__, $promotor);

		$router = Config::get('router');

		if (!$promotor->canSendEmail()) {
			$this->alert('error', 'Nie można wysłać więcej wiadomości w tym tygodniu');

			header('Location: '.$router->generate('promotors_mailing', ['promotors_id'=>$promotor->id]));

			return false;
		}

		if ($this->params['group'] == 0) {
			$action_id = 0;
		} else {
			$action_id = $this->params['action'];
		}

		$recipients = $this->getEmailAddresses($action_id, $promotor);

		$mail = new Mail(['promotor_id' => $promotor->id, 'subject' => $this->params['title'], 'recipients' => implode(', ', $recipients['id']), 'content' => $this->params['content'], 'mailed' => date(Config::get('mysqltime'))]);

		if ($mail->save()) {

			$send = (new PromotorMailer)->promotorMailing($promotor, ['title'=>$mail->subject, 'content'=>$mail->content, 'recipients'=>$recipients['emails']]);

			$send = json_decode($send);

			if ($send->message == 'success') {
				
				$this->alert('info', 'Twója wiadomość została wysłany do wybranych klientów');
			} else {
				$mail->destroy();

				$this->alert('error', 'Nieudało się wysłać wiadomości, spróbuj jeszcze raz');
			}
		} else {
			$this->alert('error', 'Nieudało się wysłać wiadomości, spróbuj jeszcze raz');		
		}
		
		header('Location: '.$router->generate('promotors_mailing', ['promotors_id'=>$promotor->id]));

	}

	public function getEmailAddresses($action_id, $promotor)
	{	
		$recipients = [];

		if ($action_id == 0) {
			$clients = $promotor->clients();

			$recipients = $this->listEmails($clients);
		}
		if ($action_id > 0) {
			$action = Action::find($action_id);

			$clients = $action->clients();

			$recipients = $this->listEmails($clients);
		}

		return $recipients;
	}

	public function listEmails($clients)
	{
		$id = [];
		$emails = [];

		foreach ($clients as $client) {

			array_push($id, $client->id);
			array_push($emails, $client->email);
		}

		$recipients['id'] = $id;
		$recipients['emails'] = $emails;

		return $recipients;
	}

	public function getReport()
	{	
		header('Content-Type: application/pdf; charset=utf-8');
		header('Content-Disposition: attachment; filename=raport.pdf');
		
		$promotor = $this->promotor();
		
		$view = (new View($this->params, ['promotor'=>$promotor], 'pdf'))->render();

		$options = new Options();
		$options->set('defaultFont', 'DejaVu Serif');
		$options->set('isRemoteEnabled', TRUE);
		$options->set('debugKeepTemp', TRUE);
		$options->set('isHtml5ParserEnabled', true);

		$dompdf = new Dompdf($options);
		$dompdf->loadHtml($view, 'UTF-8');

		// (Optional) Setup the paper size and orientation
		$dompdf->setPaper('A4', 'portrait');

		// Render the HTML as PDF
		$dompdf->render();

		// Output the generated PDF to Browser
		$dompdf->stream();
	}

	public function promotor()
	{
		return Promotor::find($this->params['promotors_id']);
	}
}