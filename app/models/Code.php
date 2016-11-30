<?php
/**
* 
*/
class Code extends Model
{
	public $id, $code, $created_at, $updated_at, $package_id, $used, $client_id;

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
			'code'					=>['type' => 'string',
									   'default' => null,
									   'validations' => ['required', 'unique']],
			'created_at'			=>['type' => 'datetime',
									   'default' => null],
			'updated_at'			=>['type' => 'datetime',
									   'default' => null],
			'package_id'			=>['type' => 'integer',
									   'default' => null,
									   'validations' => ['required']],
			'used'					=>['type' => 'datetime',
									   'default' => null],
			'client_id'				=>['type' => 'integer',
									   'default' => null]
		];
	}
	public static function pluralizeClassName()
	{
		return 'Codes';
	}
	public function package()
	{
		return CodesPackage::find($this->package_id);
	}
	public function action()
	{
		$package = CodesPackage::find($this->package_id);

		return $package->action();
	}
	public function client()
	{
		return Client::find($this->client_id);
	}
	public function codeValue()
	{
		$package = CodesPackage::find($this->package_id);
		return $package->codes_value;
	}
	public function isUsed()
	{
		return $this->client_id !== null ? true : false;
	}
	public function isActive()
	{
		$package = $this->package();
		$action = $package->Action();
		
		if ($package->status == 'active' && $action->isActive() && $this->used == null) {
			return true;
		} else {
			return false;
		}
	}
	public function promotor()
	{
		$package = $this->package();
		$promotor = $package->promotor();

		return $promotor;
	}
}