<?php
/**
* 
*/
class Image extends Model
{
	public $id, $file_name, $size, $created_at, $updated_at, $reward_id;

	function __construct($attributes = [])
	{
		parent::__construct($attributes);
	}
	public static function fields()
	{
		return [
			'id'					=>['type' => 'integer',
									   'default' => null],
			'file_name'				=>['type' => 'string',
									   'default' => null,
									   'validations' => ['required', 'max_length:190']],
			'size'					=>['type' => 'integer',
									   'default' => null],
			'created_at'			=>['type' => 'datetime',
									   'default' => null],
			'updated_at'			=>['type' => 'datetime',
									   'default' => null],
			'reward_id'				=>['type' => 'integer',
									   'default' => null]
		];
	}
	public static function pluralizeClassName()
	{
		return 'Images';
	}
	public function upload_images($files, $params)
	{
		for ($i=0; $i < sizeof($files['image']['name']); $i++) { 
			$file_name = $files['image']['name'][$i];

			$image = new Image(['file_name'=>$file_name, 'size'=>$files['image']['size'][$i], 'reward_id'=>$params['id']]);
			#die(print_r($image));
			$copy_path = 'system/'.StringUntils::camelCaseToUnderscore(get_class($image)).'s/';
			if ($image->save()) {
				if (!file_exists($copy_path)) {
	   				mkdir($copy_path, 0777, true);
	   			}
	   			rename($files['image']['tmp_name'][$i], $copy_path.$file_name);
			}
			else{
				$reward = new Reward($params['reward']);
				$path = 'app/views/'.StringUntils::camelCaseToUnderscore(str_replace('Controller', '', __CLASS__)).'/'.'edit.php';
				include 'app/views/layouts/app.php';
			}		
		}
	}
}