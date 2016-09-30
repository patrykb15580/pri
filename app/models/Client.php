<?php
/**
* 
*/
class Client extends Model
{
	public $id, $email, $name, $phone_number, $created_at, $updated_at;	

	function __construct($attributes = [])
	{
		parent::__construct($attributes);
	}
	public static function fields()
	{
		return [
			'id'					=>['type' => 'integer',
									   'default' => null],
			'email'					=>['type' => 'string',
									   'default' => null,
									   'validations' => ['required', 'unique', 'max_length:190']],
			'name'					=>['type' => 'string',
									   'default' => null,
									   'validations' => ['required', 'max_length:190']],
			'phone_number'			=>['type' => 'string',
									   'default' => null,
									   'validations' => ['required', 'max_length:190']],
			'created_at'			=>['type' => 'datetime',
									   'default' => null],
			'updated_at'			=>['type' => 'datetime',
									   'default' => null],
			
		];
	}
	public static function pluralizeClassName()
	{
		return 'Clients';
	}
	public function promotion_codes()
	{
		return PromotionCode::where('client_id=?', ['client_id'=>$this->id]);
	}
}