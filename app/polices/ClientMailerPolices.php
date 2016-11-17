<?php
/**
* 
*/
class ClientMailerPolices extends Polices
{

	public function createClient()
	{
		if ($this->user->isPromotor()) {
			return false;
		}

		if ($this->user->isClient()) {
			return true;
		}

		if ($this->user->isAdmin()) {
			return true;
		}
	}

	public function addPoints()
	{
		if ($this->user->isPromotor()) {
			return false;
		}

		if ($this->user->isClient()) {
			return true;
		}

		if ($this->user->isAdmin()) {
			return true;
		}
	}

	public function clientHash()
	{
		if ($this->user->isPromotor()) {
			return false;
		}

		if ($this->user->isClient()) {
			return true;
		}

		if ($this->user->isAdmin()) {
			return true;
		}
	}

	public function getReward()
	{
		if ($this->user->isPromotor()) {
			return false;
		}

		if ($this->user->isClient()) {
			return true;
		}

		if ($this->user->isAdmin()) {
			return true;
		}
	}
}