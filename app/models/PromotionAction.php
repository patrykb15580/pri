<?php
/**
* 
*/
class PromotionAction extends Model
{
	public $id, $created_at, $updated_at, $action_id, $indefinitely, $from_at, $to_at;

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
			'action_id'				=>['type' => 'integer',
									   'default' => null,
									   'validations' => ['required']],
			'indefinitely'			=>['type' => 'boolean',
									   'default' => false],
			'from_at'				=>['type' => 'datetime',
										'default' => null],
			'to_at'					=>['type' => 'datetime',
										'default' => null],
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

	

	public function isActive()
	{
		if ($this->indefinitely == 1) {
			if ($this->status == 'active') {
				return true;
			} else {
				return false;
			}
		} else {
			if ($this->status == 'active' && date('Y-m-d', strtotime($this->to_at)) >= date('Y-m-d') && date('Y-m-d', strtotime($this->from_at)) <= date('Y-m-d')) {
				return true;
			} else {
				return false;
			}
		}	
	}
	public static function checkIfActionsActive()
	{
		$actions = PromotionAction::where('status=? AND indefinitely=? AND to_at < "'.date('Y-m-d').'"', ['status'=>'active', 'indefinitely'=>0]);

		foreach ($actions as $action) {
			$action->update(['status'=>'inactive']);
		}
	}
}