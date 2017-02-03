<?php
/**
* 
*/
class AdminMailer extends AppMailer
{
	public $non_authorized = ['newAdminOrder', 'contact_email', 'application_email'];

	public $attributes = [];

	public function newAdminOrder($admin, $order)
	{
		$this->attributes['recipients'] = [$admin];
		$this->attributes['subject'] = 'Zamówienie nr '.$order->id;

		$method_name = __FUNCTION__;
		$body = (new View([], ['admin_email'=>$admin, 'method_name'=>$method_name, 'order'=>$order], 'mail'))->render('app/views/mailing/'.$method_name.'.php');

		$this->attributes['body'] = $body;

		$send = (new AppMailer($this->attributes))->send();
	}

	public function contactEmail($contact, $name='', $text)
	{
		$this->attributes['recipients'] = [Config::get('contact_email')];
		$this->attributes['subject'] = 'Zapytanie ze strony punktacja.pl';
		if (filter_var($contact, FILTER_VALIDATE_EMAIL)) {
			$this->attributes['reply_to'] = $contact;
		}

		$method_name = __FUNCTION__;
		$body = (new View([], ['method_name'=>$method_name, 'contact'=>$contact, 'name'=>$name, 'text'=>$text], 'contact_email'))->render('app/views/mailing/'.$method_name.'.php');

		$this->attributes['body'] = $body;

		$send = (new AppMailer($this->attributes))->send();

		if ((json_decode($send))->message == 'success') {
			return true;
		} else {
			return false;
		}
	}

	public function promotorApplication($company, $email, $name, $phone_number)
	{
		$this->attributes['recipients'] = [Config::get('application_email')];
		$this->attributes['subject'] = 'Zgłoszenie do programu Punktacja.pl';
		$this->attributes['reply_to'] = $email;

		$method_name = __FUNCTION__;
		$body = (new View([], ['method_name'=>$method_name, 'company'=>$company, 'email'=>$email, 'name'=>$name, 'phone_number'=>$phone_number], 'contact_email'))->render('app/views/mailing/'.$method_name.'.php');

		$this->attributes['body'] = $body;

		$send = (new AppMailer($this->attributes))->send();

		if ((json_decode($send))->message == 'success') {
			return true;
		} else {
			return false;
		}
	}
}
