<?php
/**
* 
*/
class Token extends Model
{
	public $id, $created_at, $updated_at, $client_id, $token;

	const STATUSES = 	['active' => 'Aktywna',
						 'inactive' => 'Nieaktywna'];

	function __construct($attributes = [])
	{
		parent::__construct($attributes);
	}
	public static function fields()
	{
		return [
			'id'					=>['type' => 'integer',
									   'default' => null],
			'client_id'				=>['type' => 'integer',
									   'default' => null,
									   'validations' => ['required']],
			'token'					=>['type' => 'string',
									   'default' => null,
									   'validations' => ['required', 'max_length:191']],
			'created_at'			=>['type' => 'datetime',
									   'default' => null],
			'updated_at'			=>['type' => 'datetime',
									   'default' => null],
		];
	}

	public static function pluralizeClassName()
	{
		return 'Tokens';
	}

	public static function checkIfTokensExpired()
	{
		$tokens = Token::all();

		foreach ($tokens as $token) {
			$expire = date(Config::get('mysqltime'), strtotime($token->created_at.' +1 hour'));
			if (date(Config::get('mysqltime')) > $expire) {
				$token->destroy();
			}
		}
	}

	public function client()
	{
		return Client::find($this->client_id);
	}
}