<?php
/**
* 
*/
class Action extends Model
{
	public $id, $created_at, $updated_at, $promotor_id, $name, $status, $description, $type;

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
			'promotor_id'			=>['type' => 'integer',
									   'default' => null,
									   'validations' => ['required']],
			'name'					=>['type' => 'string',
									   'default' => null,
									   'validations' => ['required', 'max_length:191']],
			'status'				=>['type' => 'string',
									   'default' => 'active'],
			'description'			=>['type' => 'string',
									   'default' => null],
			'type'					=>['type' => 'string',
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
		return 'Actions';
	}

	public function promotor()
	{
		return Promotor::find($this->promotor_id);
	}

	public function createAction($params)
	{
		$action = new Action([$params]);
		echo "<pre>";
		die(print_r($action));
	}

	public function isActive()
	{
		if ($this->type == 'Contests') {
			if ($this->isContestActive()) {
				return true;
			} else return false;
		} else  {
			if ($this->isPromotionActionActive()) {
				return true;
			} else return false;
		}
	}

	public function promotionAction()
	{
		return PromotionAction::findBy('action_id', $this->id);
	}

	public function codesPackages()
	{
		return CodesPackage::where('action_id=?', ['action_id'=>$this->id]);
	}

	public function contest()
	{
		return Contest::findBy('action_id', $this->id);
	}

	public function answers()
	{
		return ContestAnswer::where('action_id=?', ['action_id'=>$this->id]);
	}

	public function promotionCodesPackages()
	{
		return CodesPackage::where('action_id=?', ['action_id'=>$this->id]);
	}

	public function activePackages()
	{
		$packages = CodesPackage::where('action_id=? AND status=?', ['action_id'=>$this->id, 'status'=>'active']);
		
		return $packages;
	}

	public function inactivePackages()
	{
		$packages = CodesPackage::where('action_id=? AND status=?', ['action_id'=>$this->id, 'status'=>'inactive']);
		
		return $packages;
	}

	public function isPromotionActionActive()
	{
		$promotion_action = PromotionAction::findBy('action_id', $this->id);

		if ($promotion_action->indefinitely == 0) {
			if ($this->status == 'active' && date('Y-m-d', strtotime($promotion_action->to_at)) >= date('Y-m-d') && date('Y-m-d', strtotime($promotion_action->from_at)) <= date('Y-m-d')) {
				return true;
			}

			if ($this->status == 'active' && date('Y-m-d', strtotime($promotion_action->to_at)) <= date('Y-m-d')) {
				return false;
			}

			if ($this->status == 'active' && date('Y-m-d', strtotime($promotion_action->from_at)) >= date('Y-m-d')) {
				return false;
			}
		} else {
			if ($this->status == 'inactive') {
				return false;
			} else {
				return true;
			}
		}
	}

	public function isContestActive()
	{
		$contest = Contest::findBy('action_id', $this->id);

		if ($this->status == 'active') {
			return true;
		}

		if ($this->status == 'active' && date('Y-m-d', strtotime($contest->to_at)) >= date('Y-m-d') && date('Y-m-d', strtotime($contest->from_at)) <= date('Y-m-d')) {
			return true;
		}

		if ($this->status == 'active' && date('Y-m-d', strtotime($contest->to_at)) <= date('Y-m-d')) {
			return false;
		}

		if ($this->status == 'active' && date('Y-m-d', strtotime($contest->from_at)) >= date('Y-m-d')) {
			return false;
		}

		if ($this->status == 'inactive') {
			return false;
		}
	}

	public function codes()
	{
		$codes = [];

		foreach ($this->codesPackages() as $package) {
			foreach ($package->promotionCodes() as $code) {
				array_push($codes, $code);
			}
		}

		return $codes;
	}

	public function usedCodes()
	{
		$packages = $this->codesPackages();

		$used_codes = [];
		foreach ($packages as $package) {
			foreach ($package->usedPromotionCodes() as $code) {
				array_push($used_codes, $code);
			}
		}
		
		return $used_codes;
	}

	public function usedCodesInMonth($date)
	{
		$packages = $this->codesPackages();
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
		$packages = $this->codesPackages();
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
		$packages = $this->codesPackages();
		$used_codes = [];
		foreach ($packages as $package) {
			foreach ($package->usedCodesInDay($date) as $code) {
				array_push($used_codes, $code);
			}
		}
		
		return $used_codes;
	}

	public function codesNumber()
	{
		$packages = $this->codesPackages();
		$codes_number = 0;
		foreach ($packages as $package) {
			$codes_number = $codes_number + $package->quantity;
		}

		return $codes_number;
	}

	public function usedCodesNumber()
	{
		$packages = $this->codesPackages();
		$used_codes = 0;
		foreach ($packages as $package) {
			$used_codes = $used_codes + $package->usedCodesNumber();
		}
		
		return $used_codes;
	}

	public static function checkIfActionsActive()
	{
		$actions = Action::where('status=?', ['status'=>'active']);

		foreach ($actions as $action) {
			if ($action->type == 'PromotionActions') {
				$promotion_action = PromotionAction::findBy('action_id', $action->id);
				if ($promotion_action->indefinitely == 0 && date('Y-m-d', strtotime($promotion_action->to_at)) < date('Y-m-d')) {
					$action->update(['status'=>'inactive']);
				}
			} else {
				$contest = Contest::findBy('action_id', $action->id);
				if (date('Y-m-d', strtotime($contest->to_at)) < date('Y-m-d')) {
					$action->update(['status'=>'inactive']);
				}
			}
		}
	}

	public function changeStatus()
	{
		if ($this->status == 'active') {
			$this->update(['status'=>'inactive']);
		} else {
			$this->update(['status'=>'active']);
		}
	}
}