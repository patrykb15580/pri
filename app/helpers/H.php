<?php
/**
* 
*/
class H
{
	
	static public function adminCurrentMenu($params, $action)
	{
		if (isset($params['action']) && $params['action'] == $action) {
			return 'admin_menu_active';
		}
		if (!isset($params['action']) && $action == 'actions') {
			return 'admin_menu_active';
		}
		return 'admin_menu_inactive';
	}
}