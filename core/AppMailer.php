<?php
/**
* 
*/
class AppMailer
{
	public $recipients, $from = 'Punktacja.pl', $reply_to = '', $cc = '', $bcc = '', $attachments = [], $subject, $body, $alt_body = '', $error = ''; 

	function __construct($attributes = []){

		foreach ($attributes as $key => $value) {
			$this->$key = $value;
		}
	}

	function send()
	{	
		$url = 'https://api.sendgrid.com/';
		$user = Config::get('sendgrid_login');
		$pass = Config::get('sendgrid_password');

		$json_string = array(

		  'to' => 
		    $this->recipients
		  ,
		  'category' => 'punktacja.pl'
		);
		
		//$test = json_encode($this->recipients);

		//echo "<pre>";
		//die(print_r($test));

		$mail = array(
		    'api_user'  => $user,
		    'api_key'   => $pass,
		    'x-smtpapi' => json_encode($json_string),
		    'to'        => 'example@sendgrid.com',
		    'subject'   => $this->subject,
		    'html'      => $this->body,
		    'text'      => '',
		    'from'      => $this->from,
		    'replyto'	=> $this->reply_to,
		);

		$request =  $url.'api/mail.send.json';

		// Generate curl request
		$session = curl_init($request);
		// Tell curl to use HTTP POST
		curl_setopt ($session, CURLOPT_POST, true);
		// Tell curl that this is the body of the POST
		curl_setopt ($session, CURLOPT_POSTFIELDS, $mail);
		// Tell curl not to return headers, but do return the response
		curl_setopt($session, CURLOPT_HEADER, false);
		// Tell PHP not to use SSLv3 (instead opting for TLS)
		curl_setopt($session, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
		curl_setopt($session, CURLOPT_RETURNTRANSFER, true);

		// obtain response
		$response = curl_exec($session);
		curl_close($session);

		// print everything out
		// print_r($response);

		return $response;


		/*$mail = new PHPMailer;

		$mail->isSMTP();
		$mail->Host = Config::get('mailing_smtp');
		$mail->SMTPAuth = true;
		$mail->Username = Config::get('mailing_address');
		$mail->Password = Config::get('mailing_password');
		$mail->SMTPSecure = 'tls';
		$mail->Port = 587;
		$mail->CharSet = "UTF-8";

		$mail->setFrom(Config::get('mailing_address'), 'Punktacja.pl');
		
		foreach ($this->recipients as $recipient) {
			$mail->addAddress($recipient);
		}
		
		$mail->addReplyTo($this->reply_to);
		$mail->addCC($this->cc);
		$mail->addBCC($this->bcc);

		foreach ($this->attachments as $attachment) {
			$mail->addAttachment($attachment);
		}

		$mail->isHTML(true);

		$mail->Subject = $this->subject;
		$mail->Body    = $this->body;
		$mail->AltBody = $this->alt_body;

		if(!$mail->send()) {
		    $this->error = $mail->ErrorInfo;
		    return false;
		} else {
		    return true;
		}*/
	}
}