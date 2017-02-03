<?php
/**
* 
*/
class Contest extends Model
{
	public $id, $question, $from_at, $to_at, $action_id, $created_at, $updated_at;	

	const STATUSES = 	['active' => 'Aktywny',
						 'inactive' => 'Nieaktywny'];

	function __construct($attributes = [])
	{
		parent::__construct($attributes);
	}
	public static function fields()
	{
		return [
			'id'					=>['type' => 'integer',
									   'default' => null],
			'question'				=>['type' => 'string',
									   'default' => null,
									   'validations' => ['required']],
			'from_at'				=>['type' => 'datetime',
									   'default' => null,
									   'validations' => ['required']],
			'to_at'					=>['type' => 'datetime',
									   'default' => null,
									   'validations' => ['required']],
			'action_id'				=>['type' => 'integer',
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
		return 'Contests';
	}

	public function promotor()
	{
		return Promotor::find($this->promotor_id);
	}

	public function answers()
	{
		return ContestAnswer::where('contest_id=?', ['contest_id'=>$this->id], ['order'=>'CHAR_LENGTH(`answer`) DESC']);
	}

	public function checkContestStatus()
	{
		if ($this->status == 'active' && date('Y-m-d', strtotime($this->from_at)) <= date('Y-m-d') && date('Y-m-d', strtotime($this->to_at)) >= date('Y-m-d')) {
			return true;
		} else if ($this->status == 'inactive' && date('Y-m-d', strtotime($this->from_at)) == date('Y-m-d')) {
			$this->changeStatus();
			return true;
		} else if ($this->status == 'active' && date('Y-m-d', strtotime($this->from_at)) < date('Y-m-d')) {
			$this->changeStatus();
			return false;
		} else if ($this->status == 'active' && date('Y-m-d', strtotime($this->to_at)) > date('Y-m-d')) {
			$this->changeStatus();
			return false;
		}  else return false;
	}

	public function changeStatus()
	{
		if ($this->status == 'active') {
			$this->update(['status'=>'inactive']);
		} else {
			$this->update(['status'=>'active']);
		}
	}

	public function packages()
	{
		return ContestStickersPackage::where('contest_id=?', ['contest_id'=>$this->id]);
	}

	public function stickersNumber()
	{
		$packages = $this->packages();

		$number = 0;
		foreach ($packages as $package) {
			$number = $number + $package->quantity;
		}

		return $number;
	}
}