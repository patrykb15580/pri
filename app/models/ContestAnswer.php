<?php
/**
* 
*/
class ContestAnswer extends Model
{
	public $id, $action_id, $client_id, $answer, $created_at, $updated_at;	


	function __construct($attributes = [])
	{
		parent::__construct($attributes);
	}
	public static function fields()
	{
		return [
			'id'					=>['type' => 'integer',
									   'default' => null],
			'action_id'			=>['type' => 'integer',
									   'default' => null,
									   'validations' => ['required']],
			'client_id'				=>['type' => 'integer',
									   'default' => null,
									   'validations' => ['required']],
			'answer'				=>['type' => 'string',
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
		return 'ContestsAnswers';
	}

	public function action()
	{
		return Action::find($this->action_id);
	}

	public function client()
	{
		return Client::find($this->client_id);
	}
}