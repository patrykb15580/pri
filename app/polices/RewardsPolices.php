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

	public function update()
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

	public function delete()
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