<?php
/**
* 
*/
class PromotionAction extends Model
{
	public $id, $created_at, $updated_at, $name, $promotors_id, $status, $indefinitely, $from_at, $to_at;

	const STATUSES = 	['active' => 'Aktywne',
						'inactive' => 'Nieaktywne'];

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
		$active_packages = [];
		foreach ($this->promotionCodesPackages() as $package) {
			if($package->status == 'active'){
				array_push($active_packages, $package);
			}
		}
		return $active_packages;
	}

	public function inactivePackages()
	{
		$inactive_packages = [];
		foreach ($this->promotionCodesPackages() as $package) {
			if($package->status == 'inactive'){
				array_push($inactive_packages, $package);
			}
		}
		return $inactive_packages;
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

	public function usedCodes()
	{
		$packages = $this->promotionCodesPackages();
		$used_codes = 0;
		foreach ($packages as $package) {
			$used_codes = $used_codes + count($package->usedCodes());
		}
		
		return $used_codes;
	}
}