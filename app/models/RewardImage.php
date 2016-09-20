<?php
use Gregwar\Image\Image;
/**
* 
*/
class RewardImage extends Model
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
		return 'RewardImages';
	}
	public function upload_images($files, $params)
	{
		for ($i=0; $i < sizeof($files['image']['name']); $i++) { 
			$file = pathinfo($files['image']['name'][$i]);
			$file_name = StringUntils::camelCaseToUnderscore($file['filename']);
			$file_name = StringUntils::replace_polish_chars($file_name);
			$file_name = StringUntils::replace_special_chars($file_name).'.'.$file['extension'];

			$image = new RewardImage(['file_name'=>$file_name, 'size'=>$files['image']['size'][$i], 'reward_id'=>$params['id']]);

			if ($files['image']['tmp_name'][$i] !== '') {
				if ($image->save()) {
					$copy_path = 'system/'.StringUntils::camelCaseToUnderscore(get_class($image)).'s/'.$image->id.'/';
					if (!file_exists($copy_path.'original/')) {
		   				mkdir($copy_path.'original/', 0777, true);
		   			}
		   			rename($files['image']['tmp_name'][$i], $copy_path.'original/'.$file_name);
		   			if (!file_exists($copy_path.'small/')) {
		   				mkdir($copy_path.'small/', 0777, true);
		   			}

		   			$this->create_small_image($copy_path.'original/'.$file_name, $copy_path.'small/'.$file_name);
				}
				else{
					$reward = new Reward($params['reward']);
					$path = 'app/views/'.StringUntils::camelCaseToUnderscore(str_replace('Controller', '', __CLASS__)).'/'.'edit.php';
					include 'app/views/layouts/app.php';
				}	
			}	
		}
	}
	public function create_small_image($input_file, $output_file)
	{
		Image::open($input_file)->resize(200, 200)->save($output_file, 'jpg', 90);
	}
}