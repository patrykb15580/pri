<?php
/**
* 
*/
class AdminMailer extends AppMailer
{
	public $non_authorized = ['newAdminOrder'];
	public $attributes = [];

	public function newAdminOrder($admin, $order)
	{
		$this->attributes['recipients'] = ['admin_email'=>$admin];
		$this->attributes['subject'] = 'Zamówienie nr '.$order->id;

		$method_name = __FUNCTION__;
		$body = (new View([], ['admin_email'=>$admin, 'method_name'=>$method_name], 'mail'))->render('app/views/mailing/'.$method_name.'.php');

		$this->attributes['body'] = $body;

		$send = (new AppMailer($this->attributes))->send();
	}
}
