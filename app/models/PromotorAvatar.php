<?php
use Gregwar\Image\Image;
/**
* 
*/
class PromotorAvatar extends Model
{

	public $id, $file_name, $size, $created_at, $updated_at, $promotor_id;

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
			'promotor_id'			=>['type' => 'integer',
									   'default' => null]
		];
	}
	public static function pluralizeClassName()
	{
		return 'PromotorsAvatars';
	}
	public function uploadAvatar($files, $params)
	{

		$avatar = PromotorAvatar::findBy('promotor_id', $params['promotors_id']);
		
		$file = pathinfo($files['image']['name'][0]);
		$file_name = StringUntils::camelCaseToUnderscore($file['filename']);
		$file_name = StringUntils::replacePolishChars($file_name);
		$file_name = StringUntils::replaceSpecialChars($file_name).'.'.$file['extension'];

		if (!empty($avatar)) {
			if ($avatar->update(['file_name'=>$file_name, 'size'=>$files['image']['size'][0]])) {
				$this->removeAvatarFiles($avatar);
				$this->createAvatarFiles($files, $params, $file_name, $avatar);
			} else {
				$reward = new Reward($params['reward']);
				$path = 'app/views/'.StringUntils::camelCaseToUnderscore(str_replace('Controller', '', __CLASS__)).'/'.'edit.php';
				include 'app/views/layouts/app.php';
			}	

		} else {
			$avatar = new PromotorAvatar(['file_name'=>$file_name, 'size'=>$files['image']['size'][0], 'promotor_id'=>$params['promotors_id']]);
			if ($files['image']['tmp_name'][0] !== '') {
				if ($avatar->save()) {
					$this->createAvatarFiles($files, $params, $file_name, $avatar);
				} else {
					$reward = new Reward($params['reward']);
					$path = 'app/views/'.StringUntils::camelCaseToUnderscore(str_replace('Controller', '', __CLASS__)).'/'.'edit.php';
					include 'app/views/layouts/app.php';
				}	
			}
		}	
	}

	public function createBigImage($input_file, $output_file)
	{
		Image::open($input_file)->resize(600, 600, 'white')->save($output_file, 'jpg', 90);
	}
	public function createMediumImage($input_file, $output_file)
	{
		Image::open($input_file)->resize(400, 400, 'white')->save($output_file, 'jpg', 90);
	}
	public function createSmallImage($input_file, $output_file)
	{
		Image::open($input_file)->resize(200, 200, 'white')->save($output_file, 'jpg', 90);
	}
	public function createVerySmallImage($input_file, $output_file)
	{
		Image::open($input_file)->resize(100, 100, 'white')->save($output_file, 'jpg', 90);
	}
	public function createTinyImage($input_file, $output_file)
	{
		Image::open($input_file)->resize(50, 50, 'white')->save($output_file, 'jpg', 90);
	}

	public function createAvatarFiles($files, $params, $file_name, $avatar)
	{

		$copy_path = $_SERVER['DOCUMENT_ROOT'].'/system/'.StringUntils::camelCaseToUnderscore(get_class($avatar)).'s/'.$params['promotors_id'].'/';

		if (!file_exists($_SERVER['DOCUMENT_ROOT'].'/system/')) {
			mkdir($_SERVER['DOCUMENT_ROOT'].'/system/');
		}
		if (!file_exists($copy_path)) {
			mkdir($copy_path, 0777, true);
		}
		if (!file_exists($copy_path.'original/')) {
			mkdir($copy_path.'original/', 0777, true);
		}
		if (!file_exists($copy_path.'big/')) {
			mkdir($copy_path.'big/', 0777, true);
		}
		if (!file_exists($copy_path.'small/')) {
			mkdir($copy_path.'small/', 0777, true);
		}
		if (!file_exists($copy_path.'very_small/')) {
			mkdir($copy_path.'very_small/', 0777, true);
		}
		if (!file_exists($copy_path.'tiny/')) {
			mkdir($copy_path.'tiny/', 0777, true);
		}

		rename($files['image']['tmp_name'][0], $copy_path.'original/'.$file_name);

		$this->createBigImage($copy_path.'original/'.$file_name, $copy_path.'big/'.$file_name);
		$this->createMediumImage($copy_path.'original/'.$file_name, $copy_path.'medium/'.$file_name);
		$this->createSmallImage($copy_path.'original/'.$file_name, $copy_path.'small/'.$file_name);
		$this->createVerySmallImage($copy_path.'original/'.$file_name, $copy_path.'very_small/'.$file_name);
		$this->createTinyImage($copy_path.'original/'.$file_name, $copy_path.'tiny/'.$file_name);
	}

	public function removeAvatarFiles($avatar)
	{
		$path = 'system/promotor_avatars/'.$avatar->promotor_id.'/';
		$files = FilesUntils::listFiles($path);
		
		foreach ($files as $file) {
			unlink($file);
		}
		foreach(glob($path.'/*', GLOB_ONLYDIR) as $dir) {
		    rmdir($dir);
		}
		rmdir($path);
	}
}