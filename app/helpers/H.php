<?php
/**
* 
*/
class H
{
	static public function adminPromotorsCurrentMenu($params, $action)
	{
		if (isset($params['show']) && $params['show'] == $action) {
			return 'admin_promotors_menu_active';
		}
		if (!isset($params['show']) && $action == 'actions') {
			return 'admin_promotors_menu_active';
		}
		return 'admin_promotors_menu_inactive';
	}
	static public function adminCurrentMenu($params, $action)
	{
		$menu = '';
		if ($params['action'] == 'show') {
			$menu = 'promotors';
		}
		if ($params['action'] == 'showPromotor') {
			$menu = 'promotors';
		}
		if ($params['action'] == 'showPromotorAction') {
			$menu = 'promotors';
		}
		if ($params['action'] == 'showPromotorContest') {
			$menu = 'promotors';
		}
		if ($params['action'] == 'showPromotorStats') {
			$menu = 'promotors';
		}
		if ($params['action'] == 'showPromotorPackage') {
			$menu = 'promotors';
		}
		if ($params['action'] == 'showPromotorReward') {
			$menu = 'promotors';
		}
		if ($params['action'] == 'showPromotorOrder') {
			$menu = 'promotors';
		}
		if ($params['action'] == 'newPromotor') {
			$menu = 'promotors';
		}
		if ($params['action'] == 'editPromotor') {
			$menu = 'promotors';
		}
		if ($params['action'] == 'indexOrders') {
			$menu = 'orders';
		}
		if ($params['action'] == 'showOrder') {
			$menu = 'orders';
		}

		if ($menu == $action) {
			return 'admin_menu_active';
		}

		return 'admin_menu_inactive';
	}

	static public function promotorCurrentMenu($params, $action)
	{
		$menu = '';
		if ($params['controller'] == 'PromotorsController' && $params['action'] == 'show') {
			$menu = 'actions';
		}
		if ($params['controller'] == 'PromotionActionsController') {
			$menu = 'actions';
		}
		if ($params['controller'] == 'PromotionCodesPackagesController') {
			$menu = 'actions';
		}
		if ($params['controller'] == 'PromotorsController' && $params['action'] == 'stats') {
			$menu = 'stats';
		}
		if ($params['controller'] == 'RewardsController') {
			$menu = 'rewards';
		}
		if ($params['controller'] == 'PromotorsController' && $params['action'] == 'indexClients') {
			$menu = 'clients';
		}
		if ($params['controller'] == 'PromotorsController' && $params['action'] == 'indexOrders') {
			$menu = 'orders';
		}
		if ($params['controller'] == 'PromotorsController' && $params['action'] == 'showOrders') {
			$menu = 'orders';
		}
		if ($params['controller'] == 'PromotorsController' && $params['action'] == 'edit') {
			$menu = 'account';
		}
		if ($params['controller'] == 'ContestsController') {
			$menu = 'contests';
		}
		if ($params['controller'] == 'OpinionsController') {
			$menu = 'opinions';
		}
		if ($params['controller'] == 'PromotorsController' && $params['action'] == 'mailing') {
			$menu = 'mailing';
		}

		if ($menu == $action) {
			return 'promotor_menu_active';
		}

		return 'promotor_menu_inactive';
	}

	static public function clientCurrentMenu($params, $action)
	{
		$menu = '';
		if ($params['action'] == 'show') {
			$menu = 'actions';
		}
		if ($params['action'] == 'indexRewards') {
			$menu = 'actions';
		}
		if ($params['action'] == 'newOrder') {
			$menu = 'actions';
		}
		if ($params['action'] == 'indexContests') {
			$menu = 'contests';
		}
		if ($params['action'] == 'indexHistory') {
			$menu = 'history';
		}
		if ($params['action'] == 'indexOrders') {
			$menu = 'orders';
		}
		if ($params['action'] == 'code') {
			$menu = 'code';
		}
		if ($params['action'] == 'answer') {
			$menu = 'code';
		}
		if ($params['action'] == 'edit') {
			$menu = 'account';
		}
		

		if ($menu == $action) {
			return 'client_menu_active';
		}

		return 'client_menu_inactive';
	}
}