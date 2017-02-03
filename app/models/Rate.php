<?php
/**
* 
*/
class Rate extends Model
{
	public $id, $client_id, $action_id, $created_at, $updated_at, $rate;

	function __construct($attributes = [])
	{
		parent::__construct($attributes);
	}
	public static function fields()
	{
		return [
			'id'					=>['type' => 'integer',
									   'default' => null],
			'client_id'				=>['type' => 'string',
									   'default' => null,
									   'validations' => ['required']],
			'action_id'				=>['type' => 'integer',
									   'default' => null,
									   'validations' => ['required']],
			'created_at'			=>['type' => 'datetime',
									   'default' => null],
			'updated_at'			=>['type' => 'datetime',
									   'default' => null],
			'rate'					=>['type' => 'integer',
									   'default' => null,
									   'validations' => ['required']]
		];
	}

	public function client()
	{
		return Client::find($this->client_id);
	}

	public function action()
	{
		return Action::find($this->action_id);
	}

	public static function pluralizeClassName()
	{
		return 'Rates';
	}
}