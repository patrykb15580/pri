<?php
/**
* 
*/
class ClientsPolices extends Polices
{

	public function show()
	{
		if ($this->user->isPromotor()) {
			return false;
		}

		if ($this->user->isClient() && $this->user->id == $this->obj->id) {
			return true;
		}

		if ($this->user->isAdmin()) {
			return true;
		}
	}

	public function indexContests()
	{
		if ($this->user->isPromotor()) {
			return false;
		}

		if ($this->user->isClient() && $this->user->id == $this->obj->id) {
			return true;
		}

		if ($this->user->isAdmin()) {
			return true;
		}
	}

	public function indexRewards()
	{
		if ($this->user->isPromotor()) {
			return false;
		}

		if ($this->user->isClient() && $this->user->id == $this->obj->id) {
			return true;
		}

		if ($this->user->isAdmin()) {
			return true;
		}
	}

	public function showRewards()
	{
		if ($this->user->isPromotor()) {
			return false;
		}

		if ($this->user->isClient() && $this->user->id == $this->obj->id) {
			return true;
		}

		if ($this->user->isAdmin()) {
			return true;
		}
	}

	public function indexHistory()
	{
		if ($this->user->isPromotor()) {
			return false;
		}

		if ($this->user->isClient() && $this->user->id == $this->obj->id) {
			return true;
		}

		if ($this->user->isAdmin()) {
			return true;
		}
	}

	public function newOrder()
	{
		if ($this->user->isPromotor()) {
			return false;
		}

		if ($this->user->isClient() && $this->user->id == $this->obj->id) {
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

		if ($this->user->isClient() && $this->user->id == $this->obj->id) {
			return true;
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

		if ($this->user->isClient() && $this->user->id == $this->obj->id) {
			return true;
		}

		if ($this->user->isAdmin()) {
			return true;
		}
	}

	public function code()
	{
		if ($this->user->isPromotor()) {
			return false;
		}

		if ($this->user->isClient() && $this->user->id == $this->obj->id) {
			return true;
		}

		if ($this->user->isAdmin()) {
			return true;
		}
	}

	public function insertCode()
	{
		if ($this->user->isPromotor()) {
			return false;
		}

		if ($this->user->isClient() && $this->user->id == $this->obj->id) {
			return true;
		}

		if ($this->user->isAdmin()) {
			return true;
		}
	}

	public function answer()
	{
		if ($this->user->isPromotor()) {
			return false;
		}

		if ($this->user->isClient() && $this->user->id == $this->obj->id) {
			return true;
		}

		if ($this->user->isAdmin()) {
			return true;
		}
	}

	public function giveAnswer()
	{
		if ($this->user->isPromotor()) {
			return false;
		}

		if ($this->user->isClient() && $this->user->id == $this->obj->id) {
			return true;
		}

		if ($this->user->isAdmin()) {
			return true;
		}
	}
}