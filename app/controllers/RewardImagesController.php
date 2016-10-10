<?php
/**
* 
*/
class RewardImagesController extends Controller
{

	public function delete()
	{
		$this->auth(__FUNCTION__, $this->reward());
		$path = 'system/reward_images/'.$this->params['id'];
		$files = FilesUntils::listFiles($path);
		
		#echo "<pre>";
		#die(print_r($_SERVER['HTTP_REFERER']));

		$this->params['reward']['id'] = $this->params['id'];
		$image = new RewardImage($this->params['reward']);
		
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

	public function reward()
	{
		return Reward::find($this->params['reward_id']);
	}
}