<?php
/**
* 
*/
class Opinion extends Model
{
	public $id, $question, $action_id, $created_at, $updated_at;

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
		return 'Opinions';
	}

	public function action()
	{
		return Action::find($this->action_id);
	}

	public function promotor()
	{
		$action = $this->action();

		return $action->promotor();
	}
}