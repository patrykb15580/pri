<?php
/**
* 
*/
class RewardsPolices extends Polices
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

	public function update()
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