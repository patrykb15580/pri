<?php
/**
* 
*/
class RewardImagesPolices extends Polices
{

	public function delete()
	{	
		$promotor = $this->obj->promotor();

		if ($this->user->isPromotor() && $this->user->id == $promotor->id) {
			return true;
		}

		if ($this->user->isClient()) {
			return false;
		}

		if ($this->user->isAdmin()) {
			return true;
		}
	}
}