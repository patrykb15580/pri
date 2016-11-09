<?php
trait UserRole {

	public function isPromotor()
	{
		if (get_class($_SESSION['user']) == 'Promotor') {
			return true;
		}
	}

	public function isClient()
	{
		if (get_class($_SESSION['user']) == 'Client') {
			return true;
		}
	}

	public function isAdmin()
	{
		if (get_class($_SESSION['user']) == 'Admin') {
			return true;
		}
	}
}