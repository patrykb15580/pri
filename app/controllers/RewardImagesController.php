<?php
/**
* 
*/
class RewardImagesController extends Controller
{

	public function delete()
	{
		$this->auth(__FUNCTION__, $this->promotor());
		$path = 'system/reward_images/'.$this->params['id'];
		$files = FilesUntils::listFiles($path);

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

	public function promotor()
	{
		return Promotor::find($this->params['promotors_id']);
	}
}