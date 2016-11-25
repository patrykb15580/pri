<?php
/**
* 
*/
class PromotionCodesPackagesPolices extends Polices
{

	public function show()
	{
		$promotion_action = $this->obj->promotionAction();
		$promotor = $promotion_action->promotor();

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
		$promotion_action = $this->obj->promotionAction();
		$promotor = $promotion_action->promotor();

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
		$promotion_action = $this->obj->promotionAction();
		$promotor = $promotion_action->promotor();

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