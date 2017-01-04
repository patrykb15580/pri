<?php
/**
* 
*/
class CodesPackage extends Model
{
	public $id, $created_at, $updated_at, $action_id, $quantity, $generated, $codes_value, $status, $description;

	const STATUSES = 	['active' => 'Aktywne',
						 'inactive' => 'Nieaktywne'];
	const TYPES = 		[0 => 'Jednorazowe',
						 1 => 'Wielorazowe'];

	function __construct($attributes = [])
	{
		parent::__construct($attributes);
	}
	public static function fields()
	{
		return [
			'id'					=>['type' => 'integer',
									   'default' => null],
			'created_at'			=>['type' => 'datetime',
									   'default' => null],
			'updated_at'			=>['type' => 'datetime',
									   'default' => null],
			'action_id'				=>['type' => 'integer',
									   'default' => null,
									   'validations' => ['required']],
			'quantity'				=>['type' => 'integer',
									   'default' => null,
									   'validations' => ['required', 'max_length:11']],
			'generated'				=>['type' => 'integer',
									   'default' => 0],
			'codes_value'			=>['type' => 'integer',
									   'default' => null,
									   'validations' => ['required', 'max_length:11']],
			'status'				=>['type' => 'string',
									   'default' => 'active'],
			'description'			=>['type' => 'string',
									   'default' => null]
		];
	}

	public static function pluralizeClassName()
	{
		return 'CodesPackages';
	}

	public function action()
	{
		return Action::find($this->action_id);
	}

	public function promotionCodes()
	{
		return Code::where('package_id=?', ['package_id'=>$this->id]);
	}
	public function usedPromotionCodes()
	{
		return Code::where('package_id=? AND client_id IS NOT NULL', ['package_id'=>$this->id], ['order'=>'used DESC']);
	}
	public function nonUsedPromotionCodes()
	{
		return Code::where('package_id=? AND client_id IS NULL', ['package_id'=>$this->id]);
	}

	public function packageValue()
	{
		return $this->quantity * $this->codes_value;
	}

	public function clients(){
		$codes = Code::where('package_id=? AND used IS NOT NULL', ['package_id'=>$this->id]);

		$clients = [];
		foreach ($codes as $code) {
			$client = $code->client();
			$clients[$client->id] = $client;
		}
		return $clients;
	}

	public function usedCodesNumber(){
		$codes = Code::where('package_id=? AND used IS NOT NULL', ['package_id'=>$this->id]);

		return count($codes);
	}
	
	public function usedCodes()
	{	
		$date = date(Config::get('mysqltime'), strtotime("-1 week"));
		return Code::where('package_id=? AND `used` >= "'.$date.'"', ['package_id'=>$this->id], ['order'=>'used DESC']);
	}

	public function usedCodesInMonth($date)
	{	
		$month = date("m", strtotime($date));
		$codes = Code::where('package_id=? AND MONTH(`used`)=?', ['package_id'=>$this->id, 'used'=>$month], ['order'=>'used DESC']);

		$codes_arr = [];
		foreach ($codes as $code) {
			$used = $code->used;
			$year = date("Y", strtotime($used));
			if ($year == date("Y")) {
				array_push($codes_arr, $code);
			}
		}

		return $codes_arr;
	}

	public function usedCodesFromTo($from, $to)
	{	
		if (empty($from)) {
			$codes = Code::where('package_id=? AND `used` <= "'.$to.' 23:59:59"', ['package_id'=>$this->id], ['order'=>'used DESC']);
		} else if (empty($to)) {
			$codes = Code::where('package_id=? AND `used` >= "'.$from.' 00:00:00"', ['package_id'=>$this->id], ['order'=>'used DESC']);
		} else if (empty($from) && empty($to)) {
			$codes = Code::where('package_id=? AND `used` IS NOT NULL', ['package_id'=>$this->id], ['order'=>'used DESC']);
		} else {
			$codes = Code::where('package_id=? AND `used` >= "'.$from.' 00:00:00" AND `used` <= "'.$to.' 23:59:59"', ['package_id'=>$this->id], ['order'=>'used DESC']);
		}

		return $codes;
	}

	public function usedCodesInDay($date)
	{	
		return Code::where('package_id=? AND `used` >= "'.$date.' 00:00:00" AND `used` <= "'.$date.' 23:59:59"', ['package_id'=>$this->id], ['order'=>'used DESC']);
	}

	public function promotor()
	{
		$action = Action::find($this->action_id);
		return Promotor::find($action->promotor_id);
	}
}