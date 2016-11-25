<?php
/**
* 
*/
class AppMailer
{
	public $recipients, $reply_to = '', $cc = '', $bcc = '', $attachments = [], $subject, $body, $alt_body = '', $error = ''; 

	function __construct($attributes = []){

		foreach ($attributes as $key => $value) {
			$this->$key = $value;
		}
	}

	function send()
	{	
		$mail = new PHPMailer;

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
		}
	}
}