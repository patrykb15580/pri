<?php
/**
* 
*/
class PromotorMailer extends AppMailer
{
	public $non_authorized = ['newAdminOrder'];

	public $attributes = [];

	public function promotorMailing($promotor, $email_data)
	{
		$this->attributes['recipients'] = $email_data['recipients'];
		$this->attributes['subject'] = $email_data['title'];
		$this->attributes['from'] = $promotor->name;
		$this->attributes['reply_to'] = $promotor->email;

		$method_name = __FUNCTION__;
		$body = (new View([], ['promotor'=>$promotor, 'method_name'=>$method_name, 'content'=>$email_data['content']], 'promotor_mailing'))->render('app/views/mailing/'.$method_name.'.php');

		$this->attributes['body'] = $body;

		$send = (new AppMailer($this->attributes))->send();

		return $send;
	}
}
