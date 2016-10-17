<?php
/**
* 
*/
class History extends Model
{
	public $id, $client_id, $points, $created_at, $updated_at, $balance_before, $balance_after, $description;	

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
									   'validations' => ['required', 'max_length:11']],
			'points'				=>['type' => 'string',
									   'default' => null,
									   'validations' => ['required', 'max_length:190']],
			'created_at'			=>['type' => 'datetime',
									   'default' => null],
			'updated_at'			=>['type' => 'datetime',
									   'default' => null],
			'balance_before'		=>['type' => 'integer',
									   'default' => null,
									   'validations' => ['required', 'max_length:11']],
			'balance_after'			=>['type' => 'integer',
									   'default' => null,
									   'validations' => ['required', 'max_length:11']],
			'description'			=>['type' => 'string',
									   'default' => null,
									   'validations' => ['required']],
			
		];
	}
	public static function pluralizeClassName()
	{
		return 'Histories';
	}
	public function client()
	{
		return Client::find($this->client_id);
	}
	public static function addHistoryRecord($client_id, $balance_after, $action_value, $description, $action)
	{
		if ($action == 'buy') {
			$balance_before = $balance_after+$action_value;
			$points = '-'.$action_value;
		}
		else if ($action == 'add') {
			$balance_before = $balance_after-$action_value;
			$points = '+'.$action_value;
		}
		$history = new History(['client_id'=>$client_id, 'points'=>$points, 'balance_before'=>$balance_before, 'balance_after'=>$balance_after, 'description'=>$description]);

		if (!$history->save()) {
			die(print_r('Error'));
		}
	}
}