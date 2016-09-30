<?php
/**
* 
*/
class RewardImagesController
{

	public function delete($params)
	{
		$path = 'system/reward_images/'.$params['id'];
		$files = FilesUntils::list_files($path);
		
		#echo "<pre>";
		#die(print_r($_SERVER['HTTP_REFERER']));

		$params['reward']['id'] = $params['id'];
		$image = new RewardImage($params['reward']);
		
		if ($image->destroy()) {
			foreach ($files as $file) {
				unlink($file);
			}
			foreach(glob($path.'/*', GLOB_ONLYDIR) as $dir) {
			    rmdir($dir);
			}
			rmdir($path);
		}
		
		header('Location: '.$_SERVER['HTTP_REFERER']);
	}
}