<?php
/**
* 
*/
class PromotionCodesPackage extends Model
{
	public $id, $name, $created_at, $updated_at, $action_id, $reusable, $quantity, $generated, $codes_value, $status;

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
			'name'					=>['type' => 'string',
									   'default' => null,
									   'validations' => ['required', 'max_length:190']],
			'created_at'			=>['type' => 'datetime',
									   'default' => null],
			'updated_at'			=>['type' => 'datetime',
									   'default' => null],
			'action_id'				=>['type' => 'integer',
									   'default' => null,
									   'validations' => ['required']],
			'reusable'				=>['type' => 'boolean',
									   'default' => 0],
			'quantity'				=>['type' => 'integer',
									   'default' => null,
									   'validations' => ['required', 'max_length:11']],
			'generated'				=>['type' => 'integer',
									   'default' => 0],
			'codes_value'			=>['type' => 'integer',
									   'default' => null,
									   'validations' => ['required', 'max_length:11']],
			'status'				=>['type' => 'string',
									   'default' => 'active']
		];
	}

	public static function pluralizeClassName()
	{
		return 'PromotionCodesPackages';
	}

	public function promotionAction()
	{
		return PromotionAction::find($this->action_id);
	}

	public function promotionCodes()
	{
		return PromotionCode::where('package_id=?', ['package_id'=>$this->id]);
	}

	public function packageValue()
	{
		return $this->quantity * $this->codes_value;
	}

	public function usedCodes()
	{	
		$date = date(Config::get('mysqltime'), strtotime("-1 week"));
		return PromotionCode::where('package_id=? AND `used` > "'.$date.'"', ['package_id'=>$this->id], ['order'=>'used DESC']);
	}

	public function usedCodesInMonth($month)
	{	
		$date = date(Config::get('mysqltime'), strtotime("-1 week"));
		return PromotionCode::where('package_id=? AND MONTH(`used`)=?', ['package_id'=>$this->id, 'used'=>$month], ['order'=>'used DESC']);
	}

	public function promotor()
	{
		$action = PromotionAction::find($this->action_id);
		return Promotor::find($action->promotors_id);
	}
}