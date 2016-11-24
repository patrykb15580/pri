<?php
/**
* 
*/
class ClientMailer extends AppMailer
{
	public $non_authorized = ['createClient', 'addPoints', 'clientHash', 'getReward'];

	public $attributes = [];

	public function createClient($client)
	{
		$this->attributes['recipients'] = ['client'=>$client->email];
		$this->attributes['subject'] = 'Rejestracja w serwisie Punktacja.pl';

		$method_name = __FUNCTION__;
		$body = (new View([], ['client'=>$client, 'method_name'=>$method_name], 'mail'))->render('app/views/mailing/'.$method_name.'.php');

		$this->attributes['body'] = $body;

		$send = (new AppMailer($this->attributes))->send();
	}

	public function addPoints($client, $code, $promotor)
	{
		$this->attributes['recipients'] = ['client'=>$client->email];
		$this->attributes['subject'] = 'Dodanie punktów';

		$method_name = __FUNCTION__;
		$body = (new View([], ['client'=>$client, 'code'=>$code, 'promotor'=>$promotor, 'method_name'=>$method_name], 'mail'))->render('app/views/mailing/'.$method_name.'.php');

		$this->attributes['body'] = $body;

		$send = (new AppMailer($this->attributes))->send();
	}

	public function clientHash($client)
	{
		$this->attributes['recipients'] = ['client'=>$client->email];
		$this->attributes['subject'] = 'Link do logowania w serwisie Punktacja.pl';

		$method_name = __FUNCTION__;
		$body = (new View([], ['client'=>$client, 'method_name'=>$method_name], 'mail'))->render('app/views/mailing/'.$method_name.'.php');

		$this->attributes['body'] = $body;

		$send = (new AppMailer($this->attributes))->send();
	}

	public function getReward($client, $order)
	{
		$this->attributes['recipients'] = ['client'=>$client->email];
		$this->attributes['subject'] = 'Zakup nagrody';

		$method_name = __FUNCTION__;
		$body = (new View([], ['client'=>$client, 'order'=>$order, 'method_name'=>$method_name], 'mail'))->render('app/views/mailing/'.$method_name.'.php');

		$this->attributes['body'] = $body;

		$send = (new AppMailer($this->attributes))->send();
	}
}
