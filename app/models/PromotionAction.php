<?php
/**
* 
*/
class PromotionAction extends Model
{
	public $id, $created_at, $updated_at, $name, $promotors_id, $status, $indefinitely, $from_at, $to_at, $description;

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
			'created_at'			=>['type' => 'datetime',
									   'default' => null],
			'updated_at'			=>['type' => 'datetime',
									   'default' => null],
			'name'					=>['type' => 'string',
									   'default' => null,
									   'validations' => ['required', 'max_length:190']],
			'promotors_id'			=>['type' => 'integer',
									   'default' => null,
									   'validations' => ['required']],
			'status'				=>['type' => 'string',
									   'default' => 'active'],
			'indefinitely'			=>['type' => 'boolean',
										'default' => false],
			'from_at'				=>['type' => 'datetime',
										'default' => null],
			'to_at'					=>['type' => 'datetime',
										'default' => null],
			'description'			=>['type' => 'string',
									   'default' => null]
		];
	}

	public static function pluralizeClassName()
	{
		return 'PromotionActions';
	}

	public function promotor()
	{
		return Promotor::find($this->promotors_id);
	}

	public function promotionCodesPackages()
	{
		return PromotionCodesPackage::where('action_id=?', ['action_id'=>$this->id]);
	}

	public function activePackages()
	{
		$packages = PromotionCodesPackage::where('action_id=? AND status=?', ['action_id'=>$this->id, 'status'=>'active']);;
		
		return $packages;
	}

	public function inactivePackages()
	{
		$packages = PromotionCodesPackage::where('action_id=? AND status=?', ['action_id'=>$this->id, 'status'=>'inactive']);;
		
		return $packages;
	}

	public function codesNumber()
	{
		$packages = $this->promotionCodesPackages();
		$codes_number = 0;
		foreach ($packages as $package) {
			$codes_number = $codes_number + $package->quantity;
		}

		return $codes_number;
	}

	public function usedCodesNumber()
	{
		$packages = $this->promotionCodesPackages();
		$used_codes = 0;
		foreach ($packages as $package) {
			$used_codes = $used_codes + $package->usedCodesNumber();
		}
		
		return $used_codes;
	}

	public function usedCodes()
	{
		$packages = $this->promotionCodesPackages();
		$used_codes = [];
		foreach ($packages as $package) {
			foreach ($package->usedCodes() as $code) {
				array_push($used_codes, $code);
			}
		}
		
		return $used_codes;
	}

	public function usedCodesInMonth($date)
	{
		$packages = $this->promotionCodesPackages();
		$used_codes = [];
		foreach ($packages as $package) {
			foreach ($package->usedCodesInMonth($date) as $code) {
				array_push($used_codes, $code);
			}
		}
		
		return $used_codes;
	}

	public function usedCodesFromTo($from, $to)
	{
		$packages = $this->promotionCodesPackages();
		$used_codes = [];
		foreach ($packages as $package) {
			foreach ($package->usedCodesFromTo($from, $to) as $code) {
				array_push($used_codes, $code);
			}
		}
		
		return $used_codes;
	}

	public function usedCodesInDay($date)
	{
		$packages = $this->promotionCodesPackages();
		$used_codes = [];
		foreach ($packages as $package) {
			foreach ($package->usedCodesInDay($date) as $code) {
				array_push($used_codes, $code);
			}
		}
		
		return $used_codes;
	}

	public function isActive()
	{
		if ($this->indefinitely == 1) {
			if ($this->status == 'active') {
				return true;
			} else {
				return false;
			}
		} else {
			if ($this->status == 'active' && $this->indefinitely !== 0 && $this->to_at >= date('Y-m-d') && $this->from_at <= date('Y-m-d')) {
				return true;
			} else {
				return false;
			}
		}	
	}
	public function checkIfActionsActive()
	{
		$actions = PromotionAction::where('status=? AND indefinitely=? AND to_at < "'.date('Y-m-d').'"', ['status'=>'active', 'indefinitely'=>0]);

		foreach ($actions as $action) {
			$action->update(['status'=>'inactive']);
		}
	}
}