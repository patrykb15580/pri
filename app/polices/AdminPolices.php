<?php
/**
* 
*/
class AdminPolices extends Polices
{

	public function show()
	{
		if ($this->user->isPromotor()) {
			return false;
		}

		if ($this->user->isClient()) {
			return false;
		}

		if ($this->user->isAdmin()) {
			return true;
		}
	}

	public function showPromotor()
	{
		if ($this->user->isPromotor()) {
			return false;
		}

		if ($this->user->isClient()) {
			return false;
		}

		if ($this->user->isAdmin()) {
			return true;
		}
	}

	public function showPromotorAction()
	{
		if ($this->user->isPromotor()) {
			return false;
		}

		if ($this->user->isClient()) {
			return false;
		}

		if ($this->user->isAdmin()) {
			return true;
		}
	}

	public function showPromotorStats()
	{
		if ($this->user->isPromotor()) {
			return false;
		}

		if ($this->user->isClient()) {
			return false;
		}

		if ($this->user->isAdmin()) {
			return true;
		}
	}

	public function showPromotorPackage()
	{
		if ($this->user->isPromotor()) {
			return false;
		}

		if ($this->user->isClient()) {
			return false;
		}

		if ($this->user->isAdmin()) {
			return true;
		}
	}

	public function showPromotorReward()
	{
		if ($this->user->isPromotor()) {
			return false;
		}

		if ($this->user->isClient()) {
			return false;
		}

		if ($this->user->isAdmin()) {
			return true;
		}
	}

	public function showPromotorOrder()
	{
		if ($this->user->isPromotor()) {
			return false;
		}

		if ($this->user->isClient()) {
			return false;
		}

		if ($this->user->isAdmin()) {
			return true;
		}
	}

	public function newPromotor()
	{
		if ($this->user->isPromotor()) {
			return false;
		}

		if ($this->user->isClient()) {
			return false;
		}

		if ($this->user->isAdmin()) {
			return true;
		}
	}

	public function createPromotor()
	{
		if ($this->user->isPromotor()) {
			return false;
		}

		if ($this->user->isClient()) {
			return false;
		}

		if ($this->user->isAdmin()) {
			return true;
		}
	}

	public function editPromotor()
	{
		if ($this->user->isPromotor()) {
			return false;
		}

		if ($this->user->isClient()) {
			return false;
		}

		if ($this->user->isAdmin()) {
			return true;
		}
	}

	public function updatePromotor()
	{
		if ($this->user->isPromotor()) {
			return false;
		}

		if ($this->user->isClient()) {
			return false;
		}

		if ($this->user->isAdmin()) {
			return true;
		}
	}

	public function indexOrders()
	{
		if ($this->user->isPromotor()) {
			return false;
		}

		if ($this->user->isClient()) {
			return false;
		}

		if ($this->user->isAdmin()) {
			return true;
		}
	}

	public function showOrder()
	{
		if ($this->user->isPromotor()) {
			return false;
		}

		if ($this->user->isClient()) {
			return false;
		}

		if ($this->user->isAdmin()) {
			return true;
		}
	}
}