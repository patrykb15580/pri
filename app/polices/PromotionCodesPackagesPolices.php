<?php
/**
* 
*/
class PromotionCodesPackagesPolices extends Polices
{

	public function show()
	{
		$package = $this->obj;
		$promotor = $package->promotor();

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

	public function new()
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

	public function create()
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

	public function edit()
	{
		$package = $this->obj;
		$promotor = $package->promotor();

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

	public function update()
	{
		$package = $this->obj;
		$promotor = $package->promotor();

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