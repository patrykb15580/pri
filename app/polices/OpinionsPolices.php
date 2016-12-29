<?php
/**
* 
*/
class OpinionsPolices extends Polices
{
	public function index()
	{
		if ($this->user->isPromotor() && $this->user->id == $this->obj->id) {
			return true;
		}

		if ($this->user->isClient()) {
			return false;
		}

		if ($this->user->isAdmin()) {
			return true;
		}
	}

	public function show()
	{
		if ($this->user->isPromotor() && $this->user->id == $this->obj->id) {
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