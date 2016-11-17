<?php
/**
* 
*/
class AdminMailerPolices extends Polices
{

	public function newAdminOrder()
	{
		if ($this->user->isPromotor()) {
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