<?php
/**
* 
*/
class Mail extends Model
{
	public $id, $promotor_id, $subject, $recipients, $content, $mailed, $created_at, $updated_at;

	function __construct($attributes = [])
	{
		parent::__construct($attributes);
	}
	public static function fields()
	{
		return [
			'id'					=>['type' => 'integer',
									   'default' => null],
			'promotor_id'			=>['type' => 'integer',
									   'default' => null,
									   'validations' => ['required']],
			'subject'				=>['type' => 'string',
									   'default' => null,
									   'validations' => ['required', 'max_length:191']],
			'recipients'			=>['type' => 'string',
									   'default' => 'active'],
			'content'				=>['type' => 'string',
									   'default' => null],
			'mailed'				=>['type' => 'datetime',
									   'default' => null,
									   'validations' => ['required']],
			'created_at'			=>['type' => 'datetime',
									   'default' => null],
			'updated_at'			=>['type' => 'datetime',
									   'default' => null],
		];
	}

	public static function pluralizeClassName()
	{
		return 'Mails';
	}
}