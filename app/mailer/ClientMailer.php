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
		$this->attributes['subject'] = 'Witaj w programie punktacja.pl';

		$method_name = __FUNCTION__;
		$body = (new View([], ['client'=>$client, 'method_name'=>$method_name], 'mail'))->render('app/views/mailing/'.$method_name.'.php');

		$this->attributes['body'] = $body;

		$send = (new AppMailer($this->attributes))->send();
	}

	public function addPoints($client, $code, $promotor)
	{
		$subject_text = '';
		$code_value = $code->codeValue();
		if ($code_value > 1) {
			$subject_text = 'punktów zostało dodanych';
		} else $subject_text = 'punkt został dodany';

		$this->attributes['recipients'] = ['client'=>$client->email];
		$this->attributes['subject'] = 'Gratulacje, '.$code_value.' '.$subject_text.' do Twojego konta.';

		$method_name = __FUNCTION__;
		$body = (new View([], ['client'=>$client, 'code'=>$code, 'promotor'=>$promotor, 'method_name'=>$method_name], 'mail'))->render('app/views/mailing/'.$method_name.'.php');

		$this->attributes['body'] = $body;

		$send = (new AppMailer($this->attributes))->send();
	}

	public function contest($client, $code, $promotor)
	{
		$subject_text = '';
		$code_value = $code->codeValue();

		$this->attributes['recipients'] = ['client'=>$client->email];
		$this->attributes['subject'] = 'Dziękujemy za wzięcie udziału w konkursie.';

		$method_name = __FUNCTION__;
		$body = (new View([], ['client'=>$client, 'code'=>$code, 'promotor'=>$promotor, 'method_name'=>$method_name], 'mail'))->render('app/views/mailing/'.$method_name.'.php');

		$this->attributes['body'] = $body;

		$send = (new AppMailer($this->attributes))->send();
	}

	public function clientHash($client)
	{
		$this->attributes['recipients'] = ['client'=>$client->email];
		$this->attributes['subject'] = 'Link do logowania w systemie punktacja.pl';

		$method_name = __FUNCTION__;
		$body = (new View([], ['client'=>$client, 'method_name'=>$method_name], 'mail'))->render('app/views/mailing/'.$method_name.'.php');

		$this->attributes['body'] = $body;

		$send = (new AppMailer($this->attributes))->send();
	}

	public function getReward($client, $order)
	{
		$this->attributes['recipients'] = ['client'=>$client->email];
		$this->attributes['subject'] = 'Zakup nagrody.';

		$method_name = __FUNCTION__;
		$body = (new View([], ['client'=>$client, 'order'=>$order, 'method_name'=>$method_name], 'mail'))->render('app/views/mailing/'.$method_name.'.php');

		$this->attributes['body'] = $body;

		$send = (new AppMailer($this->attributes))->send();
	}

	public function forgotPassword($client, $token)
	{
		$this->attributes['recipients'] = ['client'=>$client->email];
		$this->attributes['subject'] = 'Prośba o nowe hasło.';

		$method_name = __FUNCTION__;
		$body = (new View([], ['client'=>$client, 'token'=>$token, 'method_name'=>$method_name], 'mail'))->render('app/views/mailing/'.$method_name.'.php');

		$this->attributes['body'] = $body;

		$send = (new AppMailer($this->attributes))->send();
	}
}
