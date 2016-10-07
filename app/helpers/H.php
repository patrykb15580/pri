<?php
/**
* 
*/
class H
{
	
	static public function adminCurrentMenu($params, $action)
	{
		if (isset($params['show']) && $params['show'] == $action) {
			return 'admin_menu_active';
		}
		if (!isset($params['show']) && $action == 'actions') {
			return 'admin_menu_active';
		}
		return 'admin_menu_inactive';
	}
}